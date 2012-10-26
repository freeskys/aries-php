<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace Lib;

class Autoloader {

    public static $loader;

    /**
     * Menginisialisasi autoloader
     *
     * @static
     * @return mixed
     */
    public static function init() {
        if (self::$loader == NULL) {
            self::$loader = new self();
        }
        return self::$loader;
    }

    /**
     * Meload seluruh controllers, models, atau views
     */
    public function __construct() {
        spl_autoload_register(array($this, 'controllers'));
        spl_autoload_register(array($this, 'models'));
        spl_autoload_register(array($this, 'views'));
        spl_autoload_register(array($this, 'lib'));
    }

    /**
     * Konfigurasi untuk meload controller
     *
     * @param $class
     */
    private function controllers($class) {
        set_include_path(CONTROLLERS_DIR);
        spl_autoload_extensions('.php');
        spl_autoload($class);
    }

    /**
     * Konfigurasi untuk meload models
     *
     * @param $class
     */
    private function models($class) {
        set_include_path(MODELS_DIR);
        spl_autoload_extensions('.php');
        spl_autoload($class);
    }

    /**
     * Konfigurasi untuk meload views
     *
     * @param $class
     */
    private function views($class) {
        set_include_path(VIEWS_DIR);
        spl_autoload_extensions('.php');
        spl_autoload($class);
    }

    /**
     * Konfigurasi untuk meload library
     *
     * @param $class
     */
    private function lib($class) {
        set_include_path(LIB_DIR);
        spl_autoload_extensions('.php');
        spl_autoload($class);
    }

}

?>