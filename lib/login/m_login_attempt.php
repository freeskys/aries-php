<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace Lib\Login;

class m_Login_Attempt extends \Lib\Model {

    var $table = 'login_attempt';
    var $field = Array(
        'username',
        'attempt',
        'ip'
    );
    var $primary = 'username';

}
