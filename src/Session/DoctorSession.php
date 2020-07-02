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

class DoctorSession extends DatabaseObject
{
    private $doctor;
    private $docEmail;
    private $doctor_type;

    public const MAX_LOGIN_AGE = 604800 * 4;

    public function __construct()
    {

        $this->check_stored_login();
    }

    public function get_session_id()
    {
        return $this->doctor;
    }

    public function get_session_user_type()
    {
        return $this->doctor_type;
    }

    public function store($doctor)
    {
        if ($doctor) {
            session_regenerate_id();
            $this->doctor = $_SESSION['doctor'] = $doctor->id;
            $this->doctor_type = $_SESSION['doctor_type'] = $doctor->doctor_type;
            $this->docEmail = $_SESSION['docEmail'] = $doctor->docEmail;
        }
        return true;
    }

    public function is_logged_in()
    {
        return isset($this->doctor) && isset($this->docEmail);
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
        unset($_SESSION['doctor_type']);
        unset($_SESSION['doctor']);
        unset($_SESSION['docEmail']);
        unset($this->doctor);
        unset($this->doctor_type);
        unset($this->docEmail);
        return true;
    }

    private function check_stored_login()
    {
        if (isset($_SESSION['doctor'])) {
            $this->doctor = $_SESSION['doctor'];
            $this->doctor_type = $_SESSION['doctor_type'];
            $this->docEmail = $_SESSION['docEmail'];
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
