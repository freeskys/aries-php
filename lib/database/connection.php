<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace lib\Database;

use lib\Config;
use lib\Aries_Exception as AriesException;

class Connection {

    private static $db = null;

    /**
     * Make connection to the database.
     */
    public static function init() {
        $host = Config::getConfig(Config::$host);
        $port = Config::getConfig(Config::$port);
        $dbName = Config::getConfig(Config::$databaseName);
        $user = Config::getConfig(Config::$user);
        $password = Config::getConfig(Config::$password);
        $file = Config::getConfig(Config::$file);

        if ('' == $host) {
            throw new AriesException('Your host config is null.');
        } else if ('' == $port) {
            throw new AriesException('Your port config is null.');
        } else if ('' == $dbName) {
            throw new AriesException('Your dbName config is null.');
        } else if ('' == $user) {
            throw new AriesException('Your user config is null.');
        }

        if (Config::getConfig(Config::$driver) == Config::$mysql) {
            self::$db = new \PDO("mysql:host=$host;port=$port;dbname=$dbName", $user, $password);
        } else if (Config::getConfig(Config::$driver) == Config::$postgree) {
            self::$db = new \PDO("pgsql:host=$host;port=$port;dbname=$dbName", $user, $password);
        } else if (Config::getConfig(Config::$driver) == Config::$sqlite) {
            if ('' == $file) {
                throw new AriesException('Your file config is null.');
            }
            self::$db = new \PDO("sqlite:$file", $user, $password);
        }
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
