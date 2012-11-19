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

}
