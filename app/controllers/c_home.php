<?php

namespace App\Controllers;

use Lib\Controller as Controller;
use App\Models\M_Home as M_Home;

class C_Home extends Controller {

    public static function index() {
        $data = array(
            'hello' => M_Home::get_data(),
        );
        return Controller::view('home/v_index', $data);
    }

}

?>