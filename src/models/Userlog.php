<?php
/**
 * Created by PhpStorm.
 * hospital
 * By: Olamiposi
 * 26/06/2020
 * 2020
 **/


namespace Src\models;


use Src\databaseHelper\DatabaseObject;
use Src\helper\Notification;

class Userlog extends DatabaseObject
{
    static protected $table_name = "userlog";
    static protected $columns = ['uid', 'username', 'userip', 'status'];

    public $uid;
    public $username;
    public $userip;
    public $status;

    public function __construct($uid, $username, $userip, $status)
    {
        $this->uid = $uid;
        $this->username = $username;
        $this->userip = $userip;
        $this->status = $status;
    }


    public static function continue_from ($sql){
       $stmt = self::$database->query($sql);
       if ($stmt){
           Notification::message('Logged out');
       }else {
           $error = "Cannot logout";
       }
    }

}