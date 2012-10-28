<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace Lib\Login;

class m_Login extends \Lib\Model {

    var $table = 'login';
    var $field = Array(
        'username',
        'password',
        'roles',
    );
    var $primary = 'username';

}
