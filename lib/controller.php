<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using ARIES FRAMEWORK for PHP
 *****************************************************************/

namespace Lib;

abstract class Controller {

    public static function view($file, $data = null) {
        //Membuka file untuk dibaca
        $path       = realpath(VIEWS_DIR.'/'.$file.'.php');
        $file_open  = fopen($path, 'r');

        //Menutup file
        fclose($file_open);

        //Menambahkan head ke view
        $css = glob('public/css/*.css');
        $js = glob('public/js/*.js');

        $head = '<html><head><title>'.Config::getConfig('title').'</title>';
        foreach ($css as $value) {
            $head .= '<link href="'.Config::getConfig('base').$value.'" type="text/css" rel="Stylesheet"/>';
        }
        foreach ($js as $value) {
            $head .= '<script src="'.Config::getConfig('base').$value.'" type="text/javascript"></script>';
        }
        $head .= '</head><body>';

        //Template Engine
        ob_start();
        if (isset($data)) {
            $data['imgDir'] = IMG_DIR;
            extract($data);
        }
        require_once($path);
        $text = $head.ob_get_clean();

        $text .= '</body></html>';

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

}

?>