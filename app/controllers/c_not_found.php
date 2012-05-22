<?php

namespace App\Controllers;

use Lib\Controller as Controller;

class C_Not_Found extends Controller {

    public static function index() {
        return "Error 404";
    }

}

?>