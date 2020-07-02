<?php
/**
 * Created by PhpStorm.
 * hospital
 * By: Olamiposi
 * 01/07/2020
 * 2020
 **/


namespace Src\Session;


use Src\databaseHelper\DatabaseObject;

class AdminSession extends DatabaseObject
{

    private $admin;
    private $username;

    public const MAX_LOGIN_AGE = 604800 * 4;

    public function __construct()
    {

        $this->check_stored_login();
    }

    public function get_session_id()
    {
        return $this->admin;
    }

//    public function get_session_user_type()
//    {
//        return $this->admin_type;
//    }

    public function store($admin)
    {
        if ($admin) {
            session_regenerate_id();
            $this->admin = $_SESSION['admin'] = $admin->id;
            $this->username = $_SESSION['username'] = $admin->username;
        }
        return true;
    }

    public function is_logged_in()
    {
        return isset($this->admin) && isset($this->username);
    }

//    private function last_login_is_recent() {
//        if(!isset($this->last_login)) {
//            return false;
//        } elseif(($this->last_login + self::MAX_LOGIN_AGE) < time()) {
//            return false;
//        } else {
//            return true;
//        }
//    }

    public function logout()
    {
        unset($_SESSION['admin']);
        unset($_SESSION['username']);
        unset($this->admin);
        unset($this->username);
        return true;
    }

    private function check_stored_login()
    {
        if (isset($_SESSION['admin'])) {
            $this->admin = $_SESSION['admin'];
            $this->username = $_SESSION['username'];
        }
    }

    public function message($msg = "")
    {
        if (!empty($msg)) {
            // Then this is a "set" message
            $_SESSION['message'] = $msg;
            return true;
        } else {
            // Then this is a "get" message
            return $_SESSION['message'] ?? '';
        }
    }

    public function clear_message()
    {
        unset($_SESSION['message']);
    }
}