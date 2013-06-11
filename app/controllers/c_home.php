<?php

namespace App\Controllers;

use App\Models\Test;
use Lib\Controller as Controller;
use Lib\Form;
use Lib\Table;

class C_Home extends Controller {

    public static function before() {

    }

    public static function after() {

    }

    public static function index($lang) {
        if (isset($lang)) {
            Controller::setLanguage($lang);
        }

        $data = array(
            'horay' => 'Horraayyy!!!',
            'form'  => '',
            'table' => self::_table_user(),
        );
        return Controller::view('home/v_index', $data);
    }

    private static function _form_signup() {
        $form = new Form('home/success', 'Signup');
        $form->text(array('username', 'Username', 'Type for username', 'required|max_length[30]'));
        $form->password(array('password', 'Password', 'Type for password', 'required'));
        $form->radio(array('gender', 'Gender', 'Male|Female', 'male|female', 'required'));
        $form->checkbox(array('pns|swasta', 'Jobs', 'PNS|Swasta', 'pns|swasta', 'required'));
        $form->checkbox(array('agree', '', 'I Agree with terms and condition', 'agree', 'required'));
        $form->submit('Signup');
        $form->reset();

        return $form;
    }

    private static function _table_user() {
        $table = new Table(array('Username', 'Password'), 'Table User');
        $table->addData(array('admin', '*****'));
        $table->addData(array('manager', '*****'));
        $table->addData(array('user', '*****'));

        return $table->getTable();
    }

}

?>