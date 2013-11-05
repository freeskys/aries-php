<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace lib;

use lib\vendor\markdown\Markdown;

class Controller extends Utilities {

    //==== View Setting ====
    var $path;
    var $view_extension         = 'php';

    //==== Template Setting ====
    var $template_name          = 'template';
    var $template_ext           = 'php';

    //==== Language Setting ====
    var $language_folder        = 'app/languages/';
    var $language_ext           = 'php';

    //==== Reserved variable for view ====
    var $base_url               = 'base';
    var $current_year           = 'current_year';
    var $css                    = 'css';
    var $js                     = 'js';
    var $content                = 'content';

    //==== Cache setting ====
    var $cache_time = 18000;
    var $caches_folder = 'public/caches/';

    //==== Other Setting ====
    var $css_folder             = 'public/css/';
    var $js_folder              = 'public/js/';
    var $combined_css_filename  = 'css.css';
    var $combined_js_filename   = 'js.js';

    //Result send to browser
    var $result;

    /**
     * Generating view file.
     *
     * @param $file
     * @param null $data
     * @throws Aries_Exception
     */
    public function __construct($file, $data = null, $is_markdown) {
        //Set path to the view file
        if ($is_markdown) {
            $file_location = VIEWS_DIR.$file.'.md';
        } else {
            $file_location = VIEWS_DIR.$file.'.'.$this->view_extension;
        }
        $this->path = realpath($file_location);
        //Check if file is exist
        if (!is_file($this->path)) {
            throw new Aries_Exception($file_location.' didn\'t exist');
        }

        //Extracting data to content
        $content = '';
        ob_start();

        //Get language file.
        include_once ($this->language_folder.$_SESSION[Config::$lang_session].'.'.$this->language_ext);

        //Sent data to view
        $data[$this->base_url] = Config::getConfig(Config::$base);
        $data[$this->current_year] = Controller::getCurrentYear();
        extract($data);
        extract($lang);
        if ($is_markdown) {
            echo $this->parseMarkdown($this->path);
        } else {
            require_once($this->path);
        }
        $content .= ob_get_clean();

        //Extracting the data to template
        ob_start();

        //Process auto combine and autoload
        $filename_css   = '../public/caches/css.css';
        $filename_js    = '../public/caches/js.js';
        if (Config::getConfig(Config::$cache) == 'true' && file_exists($filename_css) && file_exists($filename_js)) {
            //Do Nothing
        } else {
            //Process auto combine and autoload for CSS
            if (Config::getPlugins(Config::$combineCss) == 'true' && Config::isAutoloadExist(Config::$autoload_css)) {
                Controller::combineCss();
                $t[$this->css] = '<link href="'.Config::getConfig(Config::$base).$this->caches_folder.$this->combined_css_filename.'" type="text/css" rel="stylesheet"/>';
            } else if (Config::isAutoloadExist(Config::$autoload_css)) {
                $t[$this->css] = Controller::cssBuilder();
            } else {
                $t[$this->css] = '';
            }

            //Process auto combine and autoload for JS
            if (Config::getPlugins(Config::$combineJs) == 'true' && Config::isAutoloadExist(Config::$autoload_js)) {
                Controller::combineJs();
                $t[$this->js] = '<script src="'.Config::getConfig(Config::$base).$this->caches_folder.$this->combined_js_filename.'" type="text/javascript"></script>';
            } else if (Config::isAutoloadExist(Config::$autoload_js)) {
                $t[$this->js] = Controller::jsBuilder();
            } else {
                $t[$this->js] = '';
            }
        }

        //Insert content into template
        $t[$this->content] = $content;

        //Inject variable into template
        extract($data);
        extract($lang);
        extract($t);

        //Load template
        require_once(realpath(VIEWS_DIR.DIRECTORY_SEPARATOR.$this->template_name.'.'.$this->template_ext));
        $text = ob_get_clean();

        //Compressing html page before send it to browser
        if (Config::getPlugins(Config::$htmlCompress) == 'true') {
            $this->result = Controller::htmlCompressor($text);
        } else {
            $this->result = $text;
        }
    }

    /**
     * Get all languages files.
     *
     * @return array
     */
    public function getLanguages() {
        return glob($this->language_folder.'*.'.$this->language_ext);
    }

    /**
     * Generating css for the header.
     *
     * @return null|string
     */
    public function cssBuilder() {
        $css = glob($this->css_folder.'*.css');
        $result = null;
        foreach ($css as $value) {
            $result .= '<link href="'.Config::getConfig(Config::$base).$value.'" type="text/css" rel="stylesheet"/>';
        }
        return $result;
    }

    /**
     * Generating js for the header.
     *
     * @return null|string
     */
    public function jsBuilder() {
        $js = glob($this->js_folder.'*.js');
        $result = null;
        foreach ($js as $value) {
            $result .= '<script src="'.Config::getConfig(Config::$base).$value.'" type="text/javascript"></script>';
        }
        return $result;
    }

    /**
     * Write the view to the browser window.
     *
     * @param $file
     * @param null $data
     * @return string
     */
    public static function view($file, $data = null) {
        $controller = new Controller($file, $data, false);

        return $controller->result;
    }

    public static function markdown($file, $data = null) {
        $controller = new Controller($file, $data, true);

        return $controller->result;
    }

    public static function parseMarkdown($file) {
        $fh         = fopen($file, 'r');
        $content    = fread($fh, filesize($file));
        fclose($fh);

        return Markdown::defaultTransform($content);
    }

    /**
     * Set language for the view.
     *
     * @param $language
     */
    public static function setLanguage($language) {
        $_SESSION[Config::$lang_session] = $language;
    }

    /**
     * Compress HTML text to reduce browser load and save bandwidth.
     *
     * @param $html
     * @return mixed
     */
    public static function htmlCompressor($html) {
        preg_match_all('!(<(?:code|pre|script).*>[^<]+</(?:code|pre|script)>)!', $html, $pre);
        $html = preg_replace('!<(?:code|pre).*>[^<]+</(?:code|pre)>!', '#pre#', $html);
        $html = preg_replace('#<!–[^\[].+–>#', '', $html);
        $html = preg_replace('/[\r\n\t]+/', ' ', $html);
        $html = preg_replace('/\s+/', ' ', $html);
        $html = preg_replace('/[\s]+/', ' ', $html);
        if (!empty($pre[0])) {
            foreach ($pre[0] as $tag) {
                $html = preg_replace('!#pre#!', $tag, $html, 1);
            }
        }
        return $html;
    }

    /**
     * Combine javascript into one file.
     */
    public function combineJs() {
        Controller::combine($this->caches_folder.$this->combined_js_filename, $this->js_folder.'*.js');
    }

    /**
     * Combine css into one file.
     */
    public function combineCss() {
        Controller::combine($this->caches_folder.$this->combined_css_filename, $this->css_folder.'*.css');
    }

    /**
     * Combining multiple files into one file.
     *
     * @param $filename
     * @param $folder
     */
    public function combine($filename, $folder) {
        //Get all js files
        $files = glob($folder);
        if (!$files)
            exit();

        $fw = fopen($filename, 'w');
        $fcontents = "/* Cached copy, generated ".date('H:i', filemtime($filename))." */\n";

        foreach ($files as $file) {
                if ($fr = fopen($file, 'r')) {
                    $fcontents .= fread($fr, filesize($file))."\n";
                    fclose($fr);
                }
                if ($fcontents) {
                    /* Remove comments */
//                    $fcontents = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $fcontents);
                    /* Remove tabs, spaces, newlines, etc. */
                    $fcontents = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $fcontents);
                    $fcontents = str_replace('{ ', '{', $fcontents);
                    $fcontents = str_replace(' }', '}', $fcontents);
                    $fcontents = str_replace('; ', ';', $fcontents);
                    $fcontents = str_replace(', ', ',', $fcontents);
                    $fcontents = str_replace(' {', '{', $fcontents);
                    $fcontents = str_replace('} ', '}', $fcontents);
                    $fcontents = str_replace(': ', ':', $fcontents);
                    $fcontents = str_replace(' ,', ',', $fcontents);
                    $fcontents = str_replace(' ;', ';', $fcontents);
                    fwrite($fw, $fcontents, strlen($fcontents));
                }
        }
        fclose($fw);
    }

}

?>