<?php
/**
 * Created by PhpStorm.
 * hospital
 * By: Olamiposi
 * 01/07/2020
 * 2020
 **/


namespace Src\models;


use Src\databaseHelper\DatabaseObject;

class Admin extends DatabaseObject
{
    static protected $table_name = "admin";
    static protected $columns = ['username', 'password', 'updationDate'];

    public $id;
    public $username;
    public $password;
    public $updationDate;

    public function fullname(){
        return $this->username;
    }

    public function already_stored(){
        return $this->password;
    }

    static public function find_by_username($username)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE username='" . $username . "'";
        $result = static::find_by_sql($sql);
        if (!empty($result)) {
            return array_shift($result);
        } else {
            return false;
        }
    }
}