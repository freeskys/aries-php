<?php

namespace App\Controllers;

use Lib\Controller as Controller;
use App\Models\M_Home as M_Home;

class C_Home extends Controller {

    public static function index() {
        $home = new M_Home();
        $data = array(
            'horay' => 'Horrraaayyyy!!!',
            'features' => $home->getAll(),
        );
        return Controller::view('home/v_index', $data);
    }

    public static function update() {
        $home = new M_Home();
        $data = array(
            'name' => 'Bahagiamu'
        );
        $home->update('1', $data);
    }

    public static function delete() {
        $home = new M_Home();
        $home->delete('3');
    }

}

?>