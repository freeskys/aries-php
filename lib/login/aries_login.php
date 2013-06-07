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
use Lib\Config as Config;

class Aries_Login {

    //==== Login Setting ====
    public static $inactive_length = 1800;

    //==== Session Setting ====
    public static $session_username = 'username';
    public static $session_roles = 'roles';
    public static $session_login = 'login';
    public static $session_attempt = 'attempt';
    public static $session_inactive = 'inactive';

    public static function login($username, $password) {
        $data = Array($username, md5($password.Config::getConfig('salt')));
        $login = new Login;
        $query = $login->getDb()->prepare('SELECT * FROM login WHERE username = ? AND password = ?');
        $query->execute($data);
        $row = $query->fetch(\PDO::FETCH_ASSOC);
        if ($query->rowCount() > 0) {
            session_start();
            $_SESSION[self::$session_username] = $row['username'];
            $_SESSION[self::$session_roles] = $row['roles'];
            $_SESSION[self::$session_login] = 'true';
            return true;
        } else {
            return false;
        }
    }

    public static function logout() {
        @session_start();
        $_SESSION[self::$session_username] = '';
        $_SESSION[self::$session_roles] = '';
        $_SESSION[self::$session_login] = '';
        session_destroy();
    }

    public static function isLogged() {
        @session_start();
        if (!isset($_SESSION[self::$session_login]))
            return false;
        else
            return ($_SESSION[self::$session_login] == 'true');
    }

    public static function register($username, $password, $roles) {
        $login = new Login;
        $data = Array($username, md5($password.Config::getConfig(Config::$salt)), $roles);
        $login->save($data);
    }

    //@TODO: Check login attempt
    public static function checkAttempt() {
        @session_start();
        if (!isset($_SESSION[self::$session_attempt])) {
            $_SESSION[self::$session_attempt] = '1';
            $attempt = $_SESSION[self::$session_attempt];
        } else {
            $attempt = $_SESSION[self::$session_attempt]++;
        }
        return $attempt;
    }

    //@TODO: Check if user is innactive for several times
    public static function isInactive() {
        @session_start();
        $current_time = strtotime('now');
        if (!isset($_SESSION[self::$session_inactive])) {
            $_SESSION[self::$session_inactive] = $current_time;
        } else {
            if (((strtotime('now') - $_SESSION[self::$session_inactive]) > self::$inactive_length) && self::isLogged()) {
                self::logout();
                header('Location:'.Config::getConfig(Config::$base));
            } else {
                $_SESSION[self::$session_inactive] = $current_time;
            }
        }
    }

}
