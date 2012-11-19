<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace Lib;

class Controller extends Utilities {

    //==== View Setting ====
    var $path;
    var $view_extension = 'php';

    //==== Template Setting ====
    var $template_name = 'template';
    var $template_ext = 'php';

    //==== Language Setting ====
    var $language_folder = 'app/languages/';
    var $language_ext = 'php';

    //==== Reserved variable for view ====
    var $base_url = 'base';
    var $current_year = 'current_year';
    var $css = 'css';
    var $js = 'js';
    var $content = 'content';

    //==== Other Setting ====
    var $css_folder = 'public/css/';
    var $js_folder = 'public/js/';

    //Result send to browser
    var $result;

    /**
     * Generating view file.
     *
     * @param $file
     * @param null $data
     * @param null $language
     */
    public function __construct($file, $data = null, $language = null) {
        //Set path to the view file
        $this->path = realpath(VIEWS_DIR.DIRECTORY_SEPARATOR.$file.'.'.$this->view_extension);

        //Extracting data to content
        $content = '';
        ob_start();

        //Get language file.
        if (null == $language)
            include_once ($this->language_folder.Config::getConfig(Config::$lang).'.'.$this->language_ext);
        else
            include_once ($this->language_folder.$language.'.'.$this->language_ext);

        //Sent data to view
        $data[$this->base_url] = Config::getConfig(Config::$base);
        $data[$this->current_year] = Controller::getCurrentYear();
        extract($data);
        extract($lang);
        require_once($this->path);
        $content .= ob_get_clean();

        //Extracting the data to template
        ob_start();
        $t[$this->css] = Controller::cssBuilder();
        $t[$this->js] = Controller::jsBuilder();
        $t[$this->content] = $content;
        extract($data);
        extract($lang);
        extract($t);
        require_once(realpath(VIEWS_DIR.DIRECTORY_SEPARATOR.$this->template_name.'.'.$this->template_ext));
        $text = ob_get_clean();

        //Compressing html page before send it to browser
        if (Config::getConfig(Config::$htmlCompress) == 'true') {
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
     * @param null $language
     * @return Controller|mixed|string
     */
    public static function view($file, $data = null, $language = null) {
        $controller = new Controller($file, $data, $language);
        return $controller->result;
    }

    /**
     * Set language for the view.
     *
     * @param $language
     */
    public static function setLanguage($language) {
        Config::setConfig(Config::$lang, $language);
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

}

?>