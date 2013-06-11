<?php
use \Lib\Config as Config;
use \ActiveRecord\Config as AR_Config;
require_once('lib/vendor/lessc.php');
require_once('lib/active_record.php');

//Start timer
$time_start = microtime(true);

//Load all required class
spl_autoload_register(function ($classname) {
    $filename = $classname.'.php';
    if (file_exists($filename))
        require_once($filename);
});

//Show error or not
error_reporting(-1);
ini_set('display_errors', 1);

//Initializing folder
define('BACKUP_DIR', realpath(__DIR__.'/app/backup').DIRECTORY_SEPARATOR);
define('CONTROLLERS_DIR', realpath(__DIR__.'/app/controllers').DIRECTORY_SEPARATOR);
define('MODELS_DIR', realpath(__DIR__.'/app/models').DIRECTORY_SEPARATOR);
define('VIEWS_DIR', realpath(__DIR__.'/app/views').DIRECTORY_SEPARATOR);
define('LANGUAGES_DIR', realpath(__DIR__.'/app/languages').DIRECTORY_SEPARATOR);
define('LIB_DIR', realpath(__DIR__.'/lib').DIRECTORY_SEPARATOR);
define('CSS_DIR', (__DIR__.'/public/css').DIRECTORY_SEPARATOR);
define('IMG_DIR', Config::getConfig('base').'public/img/');
define('JS_DIR', (__DIR__.'/public/js').DIRECTORY_SEPARATOR);
define('LESS_DIR', realpath(__DIR__.'/public/less').DIRECTORY_SEPARATOR);

//Set current language
if (!isset($_SESSION[Config::$lang_session]))
    $_SESSION[Config::$lang_session] = Config::getConfig(Config::$lang);

//Running the router
$router = new \Lib\Router();

//Compiling dynamic stylesheet
if (Config::getPlugins('css') == 'lessCSS') {
    $lessFile = glob('public/less/*.less');
    if (sizeof($lessFile) > 0) {
        $less = new lessc;
        foreach ($lessFile as $value) {
            $filenames = explode('/', $value);
            $filename = $filenames[2];
            $less->checkedCompile($value, strstr($value, '/', true).'/css/'.substr($filename, 0, strpos($filename, '.')).'.css');
        }
    }
}

//Call caches header
if (Config::getConfig(Config::$cache) == 'true') {
    $router->headerCache();
}

AR_Config::initialize(function ($cfg) {
    $cfg->set_model_directory('app/models');
    $cfg->set_connections(Config::getDatabases());
    $cfg->set_default_connection(Config::getConfig(Config::$default_connection));
});

//Call controller
$router->route();

//Call caches footer
if (Config::getConfig(Config::$cache) == 'true') {
    $router->footerCache();
}

//Stop timer
$time_end = microtime(true);
$time = $time_end - $time_start;

//Comment below to hide timer
//echo 'Web executed in '.$time.' seconds';
?>