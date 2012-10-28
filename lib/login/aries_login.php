<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace Lib\Login;

use Lib\Login\m_Login as Login;
//@TODO : Add login attempt
//use Lib\Login\m_Login_Attempt as LoginAttempt;
use Lib\Config as Config;

class Aries_Login {

    public static function login($username, $password) {
        $data = Array($username, md5($password.Config::getConfig('salt')));
        $login = new Login;
        $query = $login->getDb()->prepare('SELECT * FROM login WHERE username = ? AND password = ?');
        $query->execute($data);
        $row = $query->fetch(\PDO::FETCH_ASSOC);
        if ($query->rowCount() > 0) {
            session_start();
            $_SESSION['username'] = $row['username'];
            $_SESSION['roles'] = $row['roles'];
            $_SESSION['login'] = 'true';
            return true;
        } else {
            return false;
        }
    }

    public static function logout() {
        session_start();
        $_SESSION['username'] = '';
        $_SESSION['roles'] = '';
        $_SESSION['login'] = '';
        session_destroy();
    }

    public static function isLogged() {
        session_start();
        return ($_SESSION['login'] == 'true');
    }

    public static function register($username, $password, $roles) {
        $login = new Login;
        $data = Array($username, md5($password.Config::getConfig('salt')), $roles);
        $login->save($data);
    }

    public static function checkAttempt() {

    }

}
