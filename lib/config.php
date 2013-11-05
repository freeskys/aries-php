<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace lib;

class Config {

    //==== Website configuration constanta ====
    public static $lang                 = 'lang';
    public static $lang_session         = 'lang';
    public static $base                 = 'base';
    public static $cache                = 'cache';

    //==== Database configuration constanta ====
    public static $database             = 'database';
    public static $default_connection   = 'default_connection';

    //==== Plugins constanta ====
    public static $htmlCompress         = 'htmlCompress';
    public static $combineCss           = 'combineCss';
    public static $combineJs            = 'combineJs';

    //==== Autoload constanta ====
    public static $autoload_css         = 'css';
    public static $autoload_js          = 'js';

    //==== Database Standart constanta ====
    public static $development          = 'development';
    public static $production           = 'production';

    //==== Security configuration constanta ====
    public static $salt = 'salt';

    public static $config = array(
        //Language. Must same with the name in languages folder. (Ex: en.php)
        'lang'                  => 'en',
        //Base URL. Leave it blank and AriesPHP will guess it.
        'base'                  => '',
        //Active cache or not
        'cache'                 => 'false',

        //Used database configuration
        'database'              => 'development',
        'default_connection'    => 'development',
		
		//==== AriesLogin configuration ====
        'salt'                  => 'LAKSJD*(@U9hsaD',
    );

    public static $databases = array(
        /**
         * Example of Database Configuration:
         *
         * 'mysql'         => 'mysql://username:password@localhost/dbName'
         * 'pgsql'         => 'pgsql://username:password@localhost/dbName'
         * 'sqlite'        => 'sqlite://my_database.db'
         * 'oci'           => 'oci://username:passsword@localhost/xe'
         */
        'development'   => 'mysql://root@localhost/test',
        'production'    => 'mysql://root:db_password@localhost/production_db',
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
        'htmlCompress'  => 'false',

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

    public static function getDatabases() {
        return Config::$databases;
    }

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
        if ($key == Config::$base && '' == Config::$config[Config::$base]) {
            Config::$config[Config::$base] = Config::get_base_url();
        }
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

    public static function get_base_url() {
        /* First we need to get the protocol the website is using */
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https://' ? 'https://' : 'http://';

        /* returns /myproject/index.php */
        $path = $_SERVER['PHP_SELF'];

        /*
         * returns an array with:
         * Array (
         *  [dirname] => /myproject/
         *  [basename] => index.php
         *  [extension] => php
         *  [filename] => index
         * )
         */
        $path_parts = pathinfo($path);
        $directory = $path_parts['dirname'];
        /*
         * If we are visiting a page off the base URL, the dirname would just be a "/",
         * If it is, we would want to remove this
         */
        $directory = ($directory == "/") ? "" : $directory;

        /* Returns localhost OR mysite.com */
        $host = $_SERVER['HTTP_HOST'];

        /*
         * Returns:
         * http://localhost/mysite
         * OR
         * https://mysite.com
         */
        return $protocol.$host.$directory.'/';
    }

}

?>