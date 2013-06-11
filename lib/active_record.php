<?php
if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300)
    die('PHP ActiveRecord requires PHP 5.3 or higher');

define('PHP_ACTIVERECORD_VERSION_ID','1.0');

require 'active_record/Singleton.php';
require 'active_record/Config.php';
require 'active_record/Utils.php';
require 'active_record/DateTime.php';
require 'active_record/Model.php';
require 'active_record/Table.php';
require 'active_record/ConnectionManager.php';
require 'active_record/Connection.php';
require 'active_record/SQLBuilder.php';
require 'active_record/Reflections.php';
require 'active_record/Inflector.php';
require 'active_record/CallBack.php';
require 'active_record/Exceptions.php';

spl_autoload_register('activerecord_autoload');

function activerecord_autoload($class_name)
{
    $path = ActiveRecord\Config::instance()->get_model_directory();
    $root = realpath(isset($path) ? $path : '.');

    if (($namespaces = ActiveRecord\get_namespaces($class_name)))
    {
        $class_name = array_pop($namespaces);
        $directories = array();

        foreach ($namespaces as $directory)
            $directories[] = $directory;

        $root .= DIRECTORY_SEPARATOR . implode($directories, DIRECTORY_SEPARATOR);
    }

    $file = "$root/$class_name.php";

    if (file_exists($file))
        require $file;
}
?>
