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
use Src\Validation\Validator;

class Contact extends DatabaseObject
{
    static protected $table_name = "tblcontactus";
    static protected $columns = ['fullname', 'email', 'contactno', 'message'];

    public $id;
    public $fullname;
    public $email;
    public $contactno;
    public $message;
    public $AdminRemark;
    public $IsRead;
    public $LastupdationDate;

    public function __construct($args=[])
    {
        $this->fullname = $args['fullname'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->contactno = $args['contactno'] ?? '';
        $this->message = $args['message'] ?? '';
    }

    protected function validate()
    {
        $this->errors = [];

        if(Validator::is_blank($this->fullname)){
            $this->errors[] = "Fullname field cannot be blank";
        }

        if (Validator::is_blank($this->email)){
            $this->errors[] = "Email field cannot be blank";
        }

        if (Validator::is_blank($this->message)){
            $this->errors[] = "Message field cannot be blank";
        }

        if (Validator::is_blank($this->contactno)){
            $this->errors[] = "Contact field cannot be blank";
        }

        return $this->errors;
    }
}
