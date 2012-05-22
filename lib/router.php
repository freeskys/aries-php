<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using ARIES FRAMEWORK for PHP
 *****************************************************************/

namespace Lib;

class Router {

    public $controller, $action, $value;

    public function __construct() {
        Autoloader::init();

        //Mendapatkan request halaman
        $request    = isset($_GET['request']) ? $_GET['request'] : null;
        $split      = explode('/', trim($request, '/'));

        //Memasukkan data ke dalam variabel
        $this->controller   = !empty($split[0]) ? filter_var(strtolower($split[0]), FILTER_SANITIZE_STRING) : Config::getConfig('index');
        $this->action       = !empty($split[1]) ? filter_var(strtolower($split[1]), FILTER_SANITIZE_STRING) : 'index';
        $this->value        = !empty($split[2]) ? strtolower($split[2]) : null;
    }

    public function route() {
        //Memanggil controller
        if (is_callable('App\Controllers\c_'.$this->controller.'::'.$this->action)) {
            echo call_user_func('App\Controllers\c_'.$this->controller.'::'.$this->action, $this->value);
        } else {
            echo call_user_func('App\Controllers\c_not_found::index');
        }
    }

}

?>