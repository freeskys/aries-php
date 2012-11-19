<?php

namespace App\Controllers;

use Lib\Controller as Controller;

class C_Home extends Controller {

    public static function index($lang) {
		if (!empty($lang)) {
			Controller::setLanguage($lang);
		}
        $data = array(
            'horay' => 'Horrraaayyyy!!!',
        );
        return Controller::view('home/v_index', $data);
    }

}

?>