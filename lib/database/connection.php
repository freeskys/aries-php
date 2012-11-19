<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace Lib\Database;

class Connection {

    private static $db = null;

    /**
     * Make connection to the database.
     *
     * @param $host
     * @param $dbName
     * @param $user
     * @param $password
     */
    public static function init($host, $dbName, $user, $password) {
        self::$db = new \PDO("mysql:host=$host;dbname=$dbName", $user, $password);
    }

    /**
     * Close database connection.
     */
    public static function closeConnection() {
        self::$db = null;
    }

    /**
     * Check if database is connected.
     *
     * @return bool
     */
    public static function isConnect() {
        return null != self::$db;
    }

    /**
     * Get database connection.
     *
     * @return Connection Database connection
     */
    public static function getConnection() {
        return self::$db;
    }

}
