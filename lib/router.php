<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace Lib;

class Router {

    /**
     * @var Controller to be called
     */
    private $controller;
    /**
     * @var Action to be called
     */
    private $action;
    /**
     * @var Value passed to action
     */
    private $value;
    /**
     * @var Cache filename
     */
    private $cacheFile;

    /**
     * Setting the variable to process.
     */
    public function __construct() {
        //Mendapatkan request halaman
        $request    = isset($_GET['request']) ? $_GET['request'] : null;
        $split      = explode('/', trim($request, '/'));
        //Memasukkan data ke dalam variabel
        $this->controller   = !empty($split[0]) ? filter_var(strtolower($split[0]), FILTER_SANITIZE_STRING) : Config::getConfig('index');
        $this->action       = !empty($split[1]) ? filter_var(strtolower($split[1]), FILTER_SANITIZE_STRING) : 'index';
        //@TODO : Filter URL input
        $this->value        = !empty($split[2]) ? strtolower($split[2]) : null;
    }

    /**
     * Call the requested controller
     */
    public function route() {
        //Memanggil controller
        if (is_callable('App\Controllers\c_'.$this->controller.'::'.$this->action)) {
            echo call_user_func('App\Controllers\c_'.$this->controller.'::'.$this->action, $this->value);
        } else {
            echo call_user_func('App\Controllers\c_not_found::index');
        }
    }

    /**
     * Make cache
     */
    public function headerCache() {
        $file = $this->controller.'-'.$this->action;
        $this->cacheFile = 'app\caches\cached-'.$file.'.html';
        $cacheTime = 18000;

        //Muat caches jika umurnya lebih muda dari $cacheTime
        if (file_exists($this->cacheFile) && time() - $cacheTime < filemtime($this->cacheFile)) {
            echo "<!-- Cached copy, generated ".date('H:i', filemtime($this->cacheFile))." -->\n";
            include($this->cacheFile);
            exit;
        }
        ob_start();
    }

    /**
     * Make cache
     */
    public function footerCache() {
        $cached = fopen($this->cacheFile, 'w');
        fwrite($cached, ob_get_contents());
        fclose($cached);
        ob_end_flush();
    }

}

?>