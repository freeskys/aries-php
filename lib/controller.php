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

        return $text;

        //TODO: Mengkompress isi file
        //$text = str_replace('  ', ' ', $text);
        //$text = str_replace('\n', ' ', $text);
    }

}

?>