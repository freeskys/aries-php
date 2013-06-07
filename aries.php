<?php
function createController($name) {
    $classname = strtoupper(substr($name, 0, 1)).strtolower(substr($name, 1, strlen($name)));
    $controller = "<?php \n\n";
    $controller .= "namespace App\Controllers;\n\n";
    $controller .= "use Lib\Controller as Controller;\n\n";
    $controller .= "class C_".$classname." extends Controller { \n\n";
    $controller .= "\tpublic static function index() { \n";
    $controller .= "\t\treturn Controller::view('".strtolower($name)."/v_index');\n";
    $controller .= "\t}\n\n";
    $controller .= "}\n\n";
    $controller .= "?>";

    $handle = fopen(CONTROLLERS_DIR.'c_'.$name.'.php', 'w+');
    fwrite($handle, $controller);
    fclose($handle);
}

function createModel($name, $field, $primary) {
    $classname = strtoupper(substr($name, 0, 1)).strtolower(substr($name, 1, strlen($name)));
    $model = "<?php\n\n";
    $model .= "namespace App\Models;\n\n";
    $model .= "class M_".$classname." extends \Lib\Model {\n\n";
    $model .= "\tvar ".'$table'." = '".$name."';\n";
    $model .= "\tvar ".'$fields'." = Array(\n";
    $fields = explode(',', $field);
    foreach ($fields as $f) {
        $model .= "\t'".$f."',\n";
    }
    $model .= "\t);\n";
    $model .= "\tvar ".'$primary'." = '".$primary."';\n\n";
    $model .= "}\n\n";
    $model .= "?>";

    $handle = fopen(MODELS_DIR.'m_'.$name.'.php', 'w+');
    fwrite($handle, $model);
    fclose($handle);
}

function createView($name) {
    $view = 'Hello World!';

    mkdir(VIEWS_DIR.$name);
    $handle = fopen(VIEWS_DIR.$name.DIRECTORY_SEPARATOR.'v_index.php', 'w+');
    fwrite($handle, $view);
    fclose($handle);
}

if ($argc > 1) {
    //Define controller, model, and view directory
    define('CONTROLLERS_DIR', realpath(__DIR__.'/app/controllers').DIRECTORY_SEPARATOR);
    define('MODELS_DIR', realpath(__DIR__.'/app/models').DIRECTORY_SEPARATOR);
    define('VIEWS_DIR', realpath(__DIR__.'/app/views').DIRECTORY_SEPARATOR);

    //User command
    if ($argv[1] == 'controller') {
        createController($argv[2]);
        createView($argv[2]);
        fwrite(STDOUT, 'Controller c_'.$argv[2].' and View '.$argv[2].'/v_index.php created successfully');
    } else if ($argv[1] == 'model') {
        createModel($argv[2], $argv[3], $argv[4]);
        fwrite(STDOUT, 'Model m_'.$argv[2].' created successfully');
    } else {
        fwrite(STDOUT, "Wrong command\n" );
        fwrite(STDOUT, "Here the list of command:\n".
            "1. controller <name>\n".
            "2. model <table-name> <field-list> <primary-key>\n");
    }
} else {
    //Write if user didn't specify arguments
    fwrite(STDOUT, "Please specify the arguments. You can use:\n".
           "1. controller <name>\n".
           "2. model <table-name> <field-list> <primary-key>\n");
}
?>