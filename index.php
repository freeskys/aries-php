<?php
use Lib\Config as Config;
require_once('lib/vendor/lessc.php');

//Show error or not
error_reporting(-1);
ini_set('display_errors', 1);

//Initializing folder
define('CONTROLLERS_DIR', realpath(__DIR__.'/app/controllers').DIRECTORY_SEPARATOR);
define('MODELS_DIR', realpath(__DIR__.'/app/controllers').DIRECTORY_SEPARATOR);
define('VIEWS_DIR', realpath(__DIR__.'/app/views').DIRECTORY_SEPARATOR);
define('LIB_DIR', realpath(__DIR__.'/lib').DIRECTORY_SEPARATOR);
define('CSS_DIR', (__DIR__.'/public/css').DIRECTORY_SEPARATOR);
define('IMG_DIR', \Lib\Config::getConfig('base').'public/img'.DIRECTORY_SEPARATOR);
define('JS_DIR', (__DIR__.'/public/js').DIRECTORY_SEPARATOR);
define('LESS_DIR', realpath(__DIR__.'/public/less').DIRECTORY_SEPARATOR);

//Load all required class
function __autoload($classname) {
    $classname = str_replace('\\', '/', $classname) . '.php';
    require_once($classname);
}

//Running the router
$router = new \Lib\Router();

//Compiling LessCSS
$lessFile = glob('public/less/*.less');
if (sizeof($lessFile) > 0) {
    $less = new lessc;
    foreach ($lessFile as $value) {
        $filenames = explode('/', $value);
        $filename = $filenames[2];
        $less->checkedCompile($value, strstr($value, '/', true).'/css/'.substr($filename, 0, strpos($filename, '.')).'.css');
    }
}

//Call caches header
if (Config::getConfig('cache') == 'true') {
    $router->headerCache();
}
//Call controller
$router->route();
//Call caches footer
if (Config::getConfig('cache') == 'true') {
    $router->footerCache();
}
?>