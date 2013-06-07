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
    public static $lang             = 'lang';
    public static $lang_session     = 'lang';
    public static $base             = 'base';
    public static $cache            = 'cache';

    //==== Database configuration constanta ====
    public static $driver           = 'driver';
    public static $file             = 'file';
    public static $host             = 'host';
    public static $port             = 'port';
    public static $databaseName     = 'databaseName';
    public static $user             = 'user';
    public static $password         = 'password';

    //==== Driver constanta ====
    public static $mysql            = 'mysql';
    public static $postgree         = 'postgree';
    public static $sqlite           = 'sqlite';

    //==== Plugins constanta ====
    public static $htmlCompress     = 'htmlCompress';
    public static $combineCss       = 'combineCss';
    public static $combineJs        = 'combineJs';

    //==== Autoload constanta ====
    public static $autoload_css     = 'css';
    public static $autoload_js      = 'js';

    //==== Security configuration constanta ====
    public static $salt = 'salt';

    public static $config = array(
        //Language. Must same with the name in languages folder. (Ex: en.php)
        'lang'          => 'en',
        //Base URL
        'base'          => 'http://localhost/aries/',
        //Active cache or not
        'cache'         => 'false',

        //Database configuration
        /******************************
         * Database Driver List:
         *
         * - mysql
         * - postgree
         *****************************/
        'driver'        => 'mysql',

        //==== Input this if you use SQLite database ====
        'file'          => '',
        'host'          => 'localhost',
        /******************************
         * Default port for database:
         *
         * - mysql      --> 3306
         * - postgree   --> 5432
         *****************************/
        'port'          => '3306',

        'databaseName'  => 'aries',
        'user'          => 'root',
        'password'      => '',
		
		//==== AriesLogin configuration ====
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

        /**
         * Compress the HTML.
         *
         * Parameter:
         * true
         * false
         */
        'htmlCompress'  => 'true',

        /**
         * Combine CSS files into one file and save it to caches folder under public.
         * If set true AriesPHP automatically load combined files.
         * Please add css to autoload to make the plugin work.
         *
         * Parameter:
         * true
         * false
         */
        'combineCss'  => 'true',

        /**
         * Combine JS files into one file and save it to caches folder under public.
         * If set true AriesPHP automatically load combined files.
         * Please add js to autoload to make the plugin work.
         *
         * Parameter:
         * true
         * false
         */
        'combineJs'  => 'true',
    );

    /**
     * Autoload variable.
     * The available choice:
     * - css
     * - js
     *
     * @var array
     */
    public static $autoload = array (
        'css',
        'js',
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

    /**
     * Check if autoload is actived or not.
     *
     * @param $key
     * @return mixed
     */
    public static function isAutoloadExist($key) {
        return in_array($key, Config::$autoload);
    }

}

?>