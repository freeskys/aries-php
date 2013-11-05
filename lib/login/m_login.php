<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace lib\Login;

class m_Login extends \lib\Model {

    var $table = 'login';
    var $field = Array(
        'username',
        'password',
        'roles',
    );
    var $primary = 'username';

}
