<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace Lib;

use Lib\Vendor\Mobile_Detect as Agent;

class Controller {

    /**
     * @var HTML docType
     */
    var $docType = '<!DOCTYPE HTML>';
    /**
     * @var Path of the view
     */
    var $path;
    /**
     * @var View file extension
     */
    var $extension = 'php';
    /**
     * @var Controller Result
     */
    var $result;

    /**
     * Generating view file.
     *
     * @param $file
     * @param null $data
     */
    public function __construct($file, $data = null) {
        //@TODO:Do something before view load (Before Method)

        //Set path to the view file
        $this->path = realpath(VIEWS_DIR.'/'.$file.'.'.$this->extension);
        //Create header
        $head = $this->headerBuilder();
        //Extracting the data
        ob_start();
        $data['base'] = Config::getConfig('base');
        extract($data);
        require_once($this->path);
        $text = $head.ob_get_clean();
        //Create footer
        $text .= $this->footerBuilder();
        //@TODO: Do something after view load (After method)

        //Compressing html page before send it to browser
        if (Config::getConfig('htmlCompress') == 'true') {
            //return Controller::htmlCompressor($text);
            $this->result = Controller::htmlCompressor($text);
        } else {
            $this->result = $text;
        }
    }

    /**
     * Generating header for the view.
     *
     * @return string
     */
    public function headerBuilder() {
        $head = $this->docType;
        $head .= '<html><head><title>'.Config::getConfig('title').'</title>';
        $head .= $this->metaBuilder();
        $head .= '<link rel="author" href="humans.txt" />';
        $head .= $this->cssBuilder();
        $head .= $this->jsBuilder();
        $head .= '</head><body>';
        return $head;
    }

    /**
     * Generating meta for the header.
     *
     * @return string
     */
    public function metaBuilder() {
        $meta = '<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width">';
        $meta .= '<meta http-equiv="Content-type" content="text/html; charset=utf-8">';
        $meta .= '<meta name="description" value="'.Config::getConfig('description').'">';
        $meta .= '<meta name="keyword" value="'.Config::getConfig('keyword').'">';
        return $meta;
    }

    /**
     * Generating css for the header.
     *
     * @return null|string
     */
    public function cssBuilder() {
        $css = glob('public/css/*.css');
        $result = null;
        foreach ($css as $value) {
            $result .= '<link href="'.Config::getConfig('base').$value.'" type="text/css" rel="stylesheet"/>';
        }
        return $result;
    }

    /**
     * Generating js for the header.
     *
     * @return null|string
     */
    public function jsBuilder() {
        $js = glob('public/js/*.js');
        $result = null;
        foreach ($js as $value) {
            $result .= '<script src="'.Config::getConfig('base').$value.'" type="text/javascript"></script>';
        }
        return $result;
    }

    /**
     * Generating footer for the view.
     *
     * @return string
     */
    public function footerBuilder() {
        $footer = '</body></html>';
        return $footer;
    }

    /**
     * Write the view to the browser window.
     *
     * @param $file
     * @param null $data
     * @return mixed|string
     */
    public static function view($file, $data = null) {
        $controller = new Controller($file, $data);
        return $controller->result;
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
     * Getting base URL.
     *
     * @return mixed
     */
    public static function getBaseUrl() {
        return Config::getConfig('base');
    }

    /**
     * Check if browser is desktop or not.
     *
     * @return bool
     */
    public static function isDesktop() {
        $agent = new Agent();
        return (!$agent->isTablet() && !$agent->isMobile());
    }

    /**
     * Check if browser is tablet or not.
     *
     * @return bool
     */
    public static function isTablet() {
        $agent = new Agent();
        return $agent->isTablet();
    }

    /**
     * Check if browser is mobile or not.
     *
     * @return bool
     */
    public static function isMobile() {
        $agent = new Agent();
        return $agent->isTablet();
    }

}

?>