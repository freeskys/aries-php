<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace Lib;


class Table {

    var $markup;

    /**
     * Build the table.
     *
     * @param $titles
     * @param string $caption
     * @param bool $is_striped
     * @param bool $is_hover
     */
    public function __construct($titles, $caption = '', $is_striped = true, $is_hover = true) {
        $striped    = ' table-striped';
        $hover      = ' table-hover';

        if ($is_striped == false)
            $striped = '';
        if ($is_hover == false)
            $hover = '';

        $this->markup .= '<table class="table'.$striped.$hover.'">';
        if ('' != $caption)
            $this->markup .= '<caption>'.$caption.'</caption>';

        $this->markup .= '<thead><tr>';
        foreach ($titles as $title) {
            $this->markup .= '<th>'.$title.'</th>';
        }
        $this->markup .= '</tr></thead>';

        $this->markup .= '<tbody>';
    }

    /**
     * Add data to the table.
     *
     * @param $datas
     * @param array $datas_title
     */
    public function addData($datas, $datas_title = array()) {
        //If data is from database
        if (count($datas_title) > 0) {
            foreach ($datas as $data) {
                $this->markup .= '<tr>';
                foreach ($datas_title as $data_title) {
                    $this->markup .= '<td>'.$data_title.'</td>';
                }
                $this->markup .= '</tr>';
            }
        //If data is static
        } else {
            $this->markup .= '<tr>';
            foreach ($datas as $data) {
                $this->markup .= '<td>'.$data.'</td>';
            }
            $this->markup .= '</tr>';
        }
    }

    /**
     * Get table.
     *
     * @return string
     */
    public function getTable() {
        $this->markup .= '</tbody></table>';

        return $this->markup;
    }

}