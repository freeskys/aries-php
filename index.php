<?php

use Lib\Controller as Controller;

//Mengeset apakaah menampilkan pesan error
error_reporting(-1);
ini_set('display_errors', 1);

//Inisialisasi folder
define('CONTROLLERS_DIR', realpath(__DIR__.'/app/controllers').DIRECTORY_SEPARATOR);
define('MODELS_DIR', realpath(__DIR__.'/app/controllers').DIRECTORY_SEPARATOR);
define('VIEWS_DIR', realpath(__DIR__.'/app/views').DIRECTORY_SEPARATOR);
define('LIB_DIR', realpath(__DIR__.'/lib').DIRECTORY_SEPARATOR);
define('CSS_DIR', (__DIR__.'/public/css').DIRECTORY_SEPARATOR);
define('IMG_DIR', \Lib\Config::getConfig('base').'public/img'.DIRECTORY_SEPARATOR);
define('JS_DIR', (__DIR__.'/public/js').DIRECTORY_SEPARATOR);

//Meload class - class yang dibutuhkan
function __autoload($classname) {
    $classname = str_replace('\\', '/', $classname) . '.php';
    require_once($classname);
}

//Menjalankan router
$router     = new \Lib\Router();

//Memanggil controller
$result = $router->route();

?>