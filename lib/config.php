<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using ARIES FRAMEWORK for PHP
 *****************************************************************/

namespace Lib;

class Config {

    public static $config = array(
        //Konfigurasi website
        'title'         => 'Aries Framework',
        'keyword'       => 'aries, framework',
        'description'   => 'Aries framework is a PHP microframework.',

        //Base URL
        'base'          => 'http://localhost/aries/',
        //File index awal. Tulis nama controller tanpa mengikutkan "c_"
        'index'         => 'home',
    );

    public static function getConfig($key) {
        return Config::$config[$key];
    }

}

?>