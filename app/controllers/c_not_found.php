<?php

namespace app\controllers;

use lib\Controller as Controller;

class c_not_found extends Controller {

    public static function index() {
        return Controller::view('home/v_notfound');
    }

}

?>