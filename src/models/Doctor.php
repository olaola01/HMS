<?php
/**
 * Created by PhpStorm.
 * hospital
 * By: Olamiposi
 * 01/07/2020
 * 2020
 **/


namespace Src\models;


use PDO;
use Src\databaseHelper\DatabaseObject;

class Doctor extends DatabaseObject
{
    static protected $table_name = "doctors";
    static protected $columns = ['specilization', 'doctorName', 'address', 'docFees', 'contactno', 'docEmail', 'password'];

    public $id;
    public $specilization;
    public $doctorName;
    public $address;
    public $docFees;
    public $contactno;
    public $docEmail;
    public $creationDate;
    public $updationDate;
    public $password;
    public $password_original;


    public function __construct($args = [])
    {
        $this->specilization = $args['specilization'] ?? '';
        $this->doctorName = $args['doctorName'] ?? '';
        $this->address = $args['address'] ?? '';
        $this->docEmail = $args['docEmail'] ?? '';
        $this->docFees= $args['docFees'] ?? '';
        $this->gender = $args['gender'] ?? '';
        $this->contactno = $args['contactno'] ?? '';
        $this->password_original = $args['password'] ?? '';
        $this->confirm_password = $args['confirm_password'] ?? '';
    }

    public function fullname()
    {
        return $this->doctorName;
    }

    protected function set_hashed_password()
    {
        $this->password = password_hash($this->password_original, PASSWORD_BCRYPT);
    }

    public function already_stored(){
        return $this->password;

    }

    public function create()
    {
        $this->set_hashed_password();
        return parent::create(); // TODO: Change the autogenerated stub
    }


    public static function use_for_ipp($docEmail){
        $sql = "SELECT * FROM doctors WHERE docEmail=:docEmail LIMIT 1";
        $stmt = self::$database->prepare($sql);
        $stmt->bindValue(':docEmail',$docEmail, PDO::PARAM_STR);
//        $stmt->bindValue(':pass_worD',$password);
        $stmt->execute();
        $result = $stmt->rowcount();
        if ($result==1){
            // echo "GOOD";
            return $found_account = $stmt->fetch(); // To be used to fetch, check while loop
        }else{
            // echo "BAD";
            return null;
        }
    }

    static public function find_by_email($docEmail)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE docEmail='" . $docEmail . "'";
        $result = static::find_by_sql($sql);
        if (!empty($result)) {
            return array_shift($result);
        } else {
            return false;
        }
    }

    public function is_email_exists($docEmail)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE `docEmail` = :docEmail";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(":docEmail", $docEmail, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) return true; else return false;
    }
}