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
        'title'         => 'AriesPHP',
        'keyword'       => 'aries, framework, ariesphp',
        'description'   => 'AriesPHP is a MVC framework without the PAIN.',

        //Base URL
        'base'          => 'http://localhost/aries/',
        //File index awal. Tulis nama controller tanpa mengikutkan "c_"
        'index'         => 'home',
        //Compress HTML text to reduce browser load and save bandwidth. Set it true or false
        'htmlCompress'  => 'true',
    );

    public static function getConfig($key) {
        return Config::$config[$key];
    }

}

?>