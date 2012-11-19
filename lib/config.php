<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace Lib;

class Config {

    //==== Website configuration constanta ====
    public static $lang = 'lang';
    public static $base = 'base';
    public static $htmlCompress = 'htmlCompress';
    public static $cache = 'cache';

    //==== Database configuration constanta ====
    public static $host = 'host';
    public static $port = 'port';
    public static $databaseName = 'databaseName';
    public static $user = 'user';
    public static $password = 'password';

    //==== Security configuration constanta ====
    public static $salt = 'salt';

    public static $config = array(
        //Language. Must same with the name in languages folder. (Ex: en.php)
        'lang'          => 'en',
        //Base URL
        'base'          => 'http://localhost/aries/',
        //Compress HTML text to reduce browser load and save bandwidth. Set it true or false
        'htmlCompress'  => 'true',
        //Active cache or not
        'cache'         => 'false',

        //Database configuration
        'host'          => 'localhost',
        'port'          => '3306',
        'databaseName'  => 'aries',
        'user'          => 'root',
        'password'      => '',
		
		//AriesLogin configuration
        'salt'          => 'LAKSJD*(@U9hsaD',
    );

    /**
     * Router variable.
     * Note: if you specify router here the / after router name is the variable passed to method.
     *
     * @var array
     */
    public static $router = array(
        //First controller opened by AriesPHP
        'index'             => 'home',
    );

    /**
     * Plugin variable.
     *
     * @var array
     */
    public static $plugins = array(
        /**
         * Dynamic stylesheet engine.
         *
         * Parameter:
         * none     --> Disable dynamic stylesheet
         * lessCSS  --> LessCSS - Put your .less files in public/less folder
         */
        'css'               => 'none',
    );

    /**
     * Get plugins.
     *
     * @param $key
     * @return mixed
     */
    public static function getPlugins($key) {
        return Config::$plugins[$key];
    }

    /**
     * Get router.
     *
     * @param $key
     * @return mixed
     */
    public static function getRouter($key) {
        return Config::$router[$key];
    }

    /**
     * Get config.
     *
     * @param $key
     * @return mixed
     */
    public static function getConfig($key) {
        return Config::$config[$key];
    }

    /**
     * Set config.
     *
     * @param $key
     * @param $value
     */
    public static function setConfig($key, $value) {
        self::$config[$key] = $value;
    }

}

?>