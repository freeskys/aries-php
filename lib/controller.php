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

abstract class Controller {

    /**
     * Write the view to the browser window.
     *
     * @param $file
     * @param null $data
     * @return mixed|string
     */
    public static function view($file, $data = null) {
        //Open file to read
        $path       = realpath(VIEWS_DIR.'/'.$file.'.php');
        $file_open  = null;
        //Show error when can't find the file
        try {
            $file_open  = fopen($path, 'r');
        } catch (\Exception $ex) {
            echo 'We can\'t find view with name '.$file.'.php';
        }

        //Close file
        if (!empty($file_open))
            fclose($file_open);

        //Add head to view
        $css = glob('public/css/*.css');
        $js = glob('public/js/*.js');

        $head = '<html><head><title>'.Config::getConfig('title').'</title>';
        $head .= '<link rel="author" href="humans.txt" />';
        $head .= '<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width">';
        $head .= '<meta http-equiv="Content-type" content="text/html; charset=utf-8">';
        $head .= '<meta name="description" value="'.Config::getConfig('description').'">';
        $head .= '<meta name="keyword" value="'.Config::getConfig('keyword').'">';
        foreach ($css as $value) {
            $head .= '<link href="'.Config::getConfig('base').$value.'" type="text/css" rel="stylesheet"/>';
        }
        foreach ($js as $value) {
            $head .= '<script src="'.Config::getConfig('base').$value.'" type="text/javascript"></script>';
        }
        $head .= '</head><body>';

        //Add data to view
        ob_start();
        if (isset($data)) {
            $data['imgDir'] = IMG_DIR;
            extract($data);
        }
        require_once($path);
        $text = $head.ob_get_clean();

        $text .= '</body></html>';

        //Compressing html page before send it to browser
        if (Config::getConfig('htmlCompress') == 'true') {
            return Controller::htmlCompressor($text);
        } else {
            return $text;
        }
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