<?php

namespace App\Models;

class M_Test extends \Lib\Model {

    /**
     * This is example of ORM Setting in AriesPHP
     * You can change it to meet your need.
     */
    var $table = 'test';
    var $fields = Array(
        'id',
        'name'
    );
    var $primary = 'id';

}

?>