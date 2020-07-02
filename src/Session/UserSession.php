<?php
/**
 * Created by PhpStorm.
 * tourproject
 * By: Olamiposi
 * 24/06/2020
 * 2020
 **/


namespace Src\Session;


use Src\databaseHelper\DatabaseObject;

class UserSession extends DatabaseObject
{
    private $user;
    private $last_login;
    private $user_type;

    public const MAX_LOGIN_AGE = 604800 * 4;

    public function __construct()
    {

        $this->check_stored_login();
    }

    public function get_session_id(){
        return $this->user;
    }

    public function get_session_user_type(){
        return $this->user_type;
    }

    public function store($user){
        if($user){
            session_regenerate_id();
            $this->user = $_SESSION['user'] = $user->id;
            $this->user_type = $_SESSION['user_type'] = $user->user_type;
            $this->last_login = $_SESSION['last_login'] = time();
        }
        return true;
    }

    public function is_logged_in(){
        return isset($this->user) && isset($this->user_type);
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

    public function logout() {
        unset($_SESSION['user_type']);
        unset($_SESSION['user']);
        unset($_SESSION['last_login']);
        unset($this->user);
        unset($this->user_type);
        unset($this->last_login);
        return true;
    }

    private function check_stored_login() {
        if(isset($_SESSION['user'])) {
            $this->user = $_SESSION['user'];
            $this->user_type = $_SESSION['user_type'];
            $this->last_login = $_SESSION['last_login'];
        }
    }

    public function message($msg="") {
        if(!empty($msg)) {
            // Then this is a "set" message
            $_SESSION['message'] = $msg;
            return true;
        } else {
            // Then this is a "get" message
            return $_SESSION['message'] ?? '';
        }
    }

    public function clear_message() {
        unset($_SESSION['message']);
    }
}