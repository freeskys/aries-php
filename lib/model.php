<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/
 
namespace Lib;

use \Lib\Database\Connection as Connection;
use \Lib\Database\Query_Builder as Query_Builder;

class Model extends Connection {

    var $table = null;
    var $fields = array();
    var $primary = null;

    private $last_query = null;

    /**
     * Open connection to the database.
     */
    public function __construct() {
        if (!parent::isConnect()) {
            try {
                $host = Config::getConfig(Config::$host);
                $dbName = Config::getConfig(Config::$databaseName);
                $user = Config::getConfig(Config::$user);
                $password = Config::getConfig(Config::$password);
                Connection::init($host, $dbName, $user, $password);
            } catch (\PDOException $ex) {
                echo 'AriesPHP can\'t connect to database. Please check your database connection.';
            }
        }
    }

    /**
     * Close connection to the database.
     */
    public function close() {
        Connection::closeConnection();
    }

    /**
     * Get database connection.
     *
     * @return Database\Connection
     */
    public function getDb() {
        return parent::getConnection();
    }

    /**
     * Get last executed Query.
     *
     * @return null
     */
    public function getQuery() {
        return $this->last_query;
    }

    /**
     * Get all data from the table.
     *
     * @return mixed
     */
    public function getAll() {
        $query = parent::getConnection()->query('SELECT * FROM '.$this->table);
        return $query;
    }

    /**
     * Save data to database.
     *
     * Example:
     * $home = new M_Home();
     * $data = array(null, 'Testing');
     * $home->save($data);
     *
     * @throws Aries_Exception
     * @param $values
     */
    public function save($values) {
        if (count($values) > count($this->fields)) {
            //@TODO: Add exception code later.
            throw New Aries_Exception('Aries Database Exception: Your inputed value is more than the fields');
        }
        $query = parent::getConnection()->prepare(Query_Builder::insert($this->table, $values));
        if (!$query->execute($values)) {
            $error_info = $query->errorInfo();
            throw new Aries_Exception($error_info[2]);
        }
        $this->last_query = $query->queryString;
    }

    /**
     * Update data from database.
     * Example:
     * $home = new M_Home();
     * $data = array(
     * 'name' => 'Testing'
     * );
     * $home->update('1', $data);
     *
     * @throws Aries_Exception
     * @param $id
     * @param $values
     */
    public function update($id, $values) {
        $query = parent::getConnection()->prepare(Query_Builder::update($this->table, $values, $this->primary, $id));
        if (!$query->execute(Query_Builder::$data)) {
            $error_info = $query->errorInfo();
            throw new Aries_Exception($error_info[2]);
        }
        $this->last_query = $query->queryString;
    }

    /**
     * Delete data from database.
     * Example:
     * $home = new M_Home();
     * $home->delete('3');
     *
     * @throws Aries_Exception
     * @param $id
     */
    public function delete($id) {
        $data = array($id);
        $query = parent::getConnection()->prepare(Query_Builder::delete($this->table, $this->primary));
        if (!$query->execute($data)) {
            $error_info = $query->errorInfo();
            throw new Aries_Exception($error_info[2]);
        }
    }

    /**
     * Drop current table.
     *
     * @throws Aries_Exception
     */
    public function dropTable() {
        $query = parent::getConnection()->prepare(Query_Builder::dropTable($this->table));
        if (!$query->execute()) {
            $error_info = $query->errorInfo();
            throw new Aries_Exception($error_info[2]);
        }
    }

    /**
     * Empty the content of table.
     *
     * @throws Aries_Exception
     */
    public function truncateTable() {
        $query = parent::getConnection()->prepare(Query_Builder::truncateTable($this->table));
        if (!$query->execute()) {
            $error_info = $query->errorInfo();
            throw new Aries_Exception($error_info[2]);
        }
    }

    /**
     * Get the table name.
     *
     * @return null|string
     */
    public function getTableName() {
        return static::$table;
    }

    /**
     * Backup your current table.
     *
     * @param bool $dropTable
     */
    public function backupTable($dropTable = false) {
        $return = '';

        //Generate create table query
        $queryCreate = parent::getConnection()->prepare('SHOW CREATE TABLE '.$this->table);
        $queryCreate->execute();
        $create = $queryCreate->fetch(\PDO::FETCH_BOTH)[1];

        //Get all data from database
        $query = $this->getAll();

        $theField = '';
        foreach ($this->fields as $field) {
            $theField .= ', '.$field;
        }
        $theField = substr($theField, 2, strlen($theField));

        if ($dropTable)
            $return .= 'DROP TABLE '.$this->table.';\n\n';
        $return .= $create.' ;';
        $return .= "\n \n";
        $return .= 'INSERT INTO '.$this->table.' ( '.$theField.' ) VALUES ';
        foreach ($query->fetchAll(\PDO::FETCH_BOTH) as $insert) {
            $return .= '(';
            $theInsert = '';
            for ($i=0; $i<(count($insert)/2); $i++) {
                $data = $insert[$i];
                if (is_string($data)) {
                    $theInsert .= ' ,\''.$insert[$i].'\'';
                } else {
                    $theInsert .= ' ,'.$insert[$i];
                }
            }
            $theInsert = substr($theInsert, 2, strlen($theInsert));
            $return .= $theInsert;
            $return .= '), ';
        }
        $return .= ' ';
        $return = substr($return, 0, strlen($return) - 3);
        $return .= ';';

        $handle = fopen(BACKUP_DIR.'table-'.$this->table.'-'.date('d-m-Y').'-'.time().'.sql','w+');
        fwrite($handle, $return);
        fclose($handle);
    }

}

?>