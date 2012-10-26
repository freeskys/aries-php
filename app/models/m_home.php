<?php

namespace App\Models;

class M_Home extends \Lib\Model {

    /**
     * This is example of ORM Setting in AriesPHP
     * You can change it to meet your need.
     */
    var $table = 'test';
    var $field = Array(
        'id',
        'name'
    );
    var $primary = 'id';

}

?>