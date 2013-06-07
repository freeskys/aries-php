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

class Utilities {

    //==== Captcha Setting ====
    public static $session_captcha = 'img_number';

    /**
     * Generate permalinks URL.
     *
     * @param $str
     * @param array $replace
     * @param string $delimiter
     * @return mixed
     */
    public static function permalinks($str, $replace=array(), $delimiter='-') {
        if( !empty($replace) ) {
            $str = str_replace((array)$replace, ' ', $str);
        }

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }

    /**
     * Clean input to prevent SQL Injection.
     *
     * @param $input
     * @return mixed
     */
    function cleanInput($input) {
        $search = array(
            '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );
        $output = preg_replace($search, '', $input);
        return $output;
    }

    /**
     * Get client browser language
     *
     * @param $availableLanguages
     * @param string $default
     * @return string
     */
    function get_client_language($availableLanguages, $default='en') {
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $langs=explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
            foreach ($langs as $value) {
                $choice=substr($value,0,2);
                if(in_array($choice, $availableLanguages)) {
                    return $choice;
                }
            }
        }
        return $default;
    }

    /**
     * Return current year in full format.
     * Example: 2012
     *
     * @return string
     */
    public static function getCurrentYear() {
        return date('Y');
    }

    /**
     * Calculate age from her / his birthday.
     *
     * @param $birthday
     * @return string
     */
    public static function calculateAge($birthday) {
        list($year,$month,$day) = explode("-",$birthday);
        $year_diff  = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff   = date("d") - $day;
        if ($day_diff < 0 || $month_diff < 0)
            $year_diff--;
        return $year_diff;
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

    /**
     * Getting base URL.
     *
     * @return mixed
     */
    public static function getBaseUrl() {
        return Config::getConfig(Config::$base);
    }

    /**
     * Check if the file is Image.
     *
     * @param $img
     * @return bool
     */
    function isImage($img) {
        if(!getimagesize($img)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Check if inputed string is match captcha.
     *
     * @param $input
     * @return bool
     */
    public static function checkCaptcha($input) {
        session_start();
        return $_SESSION[self::$session_captcha] == $input;
    }

}
