<?php
/**
 * Created by PhpStorm.
 * hospital
 * By: Olamiposi
 * 03/07/2020
 * 2020
 **/


namespace Src\models;


use PDO;
use Src\databaseHelper\DatabaseObject;
use Src\Validation\Validator;

class Specialization extends DatabaseObject
{
    protected static $table_name = "doctorspecilization";
    protected static $columns = ['specilization'];

    public $id;
    public $specilization;
    public $creationDate;
    public $updationDate;

    public function __construct($args = [])
    {
        $this->specilization =  $args['specilization'] ?? '';
    }

    protected function validate()
    {
        $this->errors = [];

        if (Validator::is_blank($this->specilization)){
            $this->errors[] = "Specialization field cannot be empty";
        }
        return $this->errors;
    }

    public function already_exists($specialization)
    {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE `specilization` = :specilization";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(":specilization", $specialization, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) return true; else return false;
    }

}