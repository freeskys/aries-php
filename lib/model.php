<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/
 
namespace Lib;

class Model {

    var $db = null;
    var $table = null;
    var $field = array();
    var $primary = null;

    /**
     * Open connection to the database.
     */
    public function __construct() {
        try {
            $host = Config::getConfig('host');
            $dbName = Config::getConfig('databaseName');
            $user = Config::getConfig('user');
            $password = Config::getConfig('password');

            $this->db = new \PDO("mysql:host=$host;dbname=$dbName", $user, $password);
        } catch (\PDOException $ex) {
            //@TODO : Show error Message
            echo $ex->getMessage();
        }
    }

    /**
     * Close connection to the database.
     */
    public function close() {
        $this->db = null;
    }

    /**
     * Get all data from the table.
     *
     * @return mixed
     */
    public function getAll() {
        $query = $this->db->query('SELECT * FROM '.$this->table);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        //@TODO : Pass No content found when database is null
        return $query;
    }

    /**
     * Save data to database.
     * Example:
     * $home = new M_Home();
     * $data = array(null, 'Testing');
     * $home->save($data);
     *
     * @param $values
     */
    public function save($values) {
        $sql = null;
        foreach ($values as $value) {
            $sql .= ', ?';
        }
        $sql = substr($sql, 2, strlen($sql));
        $query = $this->db->prepare('INSERT INTO '.$this->table.' VALUES ('.$sql.')');
        //@TODO : Show error when inserted value is more than field
        $query->execute($values);
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
     * @param $id
     * @param $values
     */
    public function update($id, $values) {
        $sql = null;
        $data = array();
        foreach ($values as $key => $value) {
            $sql .= ', ';
            $sql .= $key.'=?';
            array_push($data, $value);
        }
        $sql = substr($sql, 2, strlen($sql));
        $query = $this->db->prepare('UPDATE '.$this->table.' SET '.$sql.' WHERE '.$this->primary.' = '.$id);
        //@TODO : Exception handling
        $query->execute($data);
    }

    /**
     * Delete data from database.
     * Example:
     * $home = new M_Home();
     * $home->delete('3');
     *
     * @param $id
     */
    public function delete($id) {
        $data = array($id);
        $query = $this->db->prepare('DELETE FROM '.$this->table.' WHERE '.$this->primary.' = ?');
        //@TODO : Exception handling
        $query->execute($data);
    }

}

?>