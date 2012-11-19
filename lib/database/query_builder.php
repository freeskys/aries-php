<?php

namespace Lib\Database;

class Query_Builder {

    public static $data = null;

    /**
     * Generate INSERT query.
     *
     * @param $table
     * @param $values
     * @return string
     */
    public static function insert($table, $values) {
        $sql = null;
        foreach ($values as $value) {
            $sql .= ', ?';
        }
        $sql = substr($sql, 2, strlen($sql));
        $query = 'INSERT INTO '.$table.' VALUES ('.$sql.')';
        return $query;
    }

    /**
     * Generate UPDATE query.
     *
     * @param $table
     * @param $values
     * @param $primary
     * @param $id
     * @return string
     */
    public static function update($table, $values, $primary, $id) {
        $sql = null;
        $data = array();
        foreach ($values as $key => $value) {
            $sql .= ', ';
            $sql .= $key.'=?';
            array_push($data, $value);
        }
        $sql = substr($sql, 2, strlen($sql));
        $query = 'UPDATE '.$table.' SET '.$sql.' WHERE '.$primary.' = '.$id;
        self::$data = $data;
        return $query;
    }

    /**
     * Generate DELETE query.
     *
     * @param $table
     * @param $primary
     * @return string
     */
    public static function delete($table, $primary) {
        $query = 'DELETE FROM '.$table.' WHERE '.$primary.' = ?';
        return $query;
    }

    /**
     * Generate DROP TABLE query.
     *
     * @param $table
     * @return string
     */
    public static function dropTable($table) {
        $query = 'DROP TABLE '.$table;
        return $query;
    }

    /**
     * Generate TRUNCATE TABLE query.
     *
     * @param $table
     * @return string
     */
    public static function truncateTable($table) {
        $query = 'TRUNCATE TABLE '.$table;
        return $query;
    }

}
