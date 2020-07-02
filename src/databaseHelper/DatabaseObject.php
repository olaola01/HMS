<?php
/**
 * Created by PhpStorm.
 * tourproject
 * By: Olamiposi
 * 24/06/2020
 * 2020
 **/


namespace Src\databaseHelper;


class DatabaseObject
{
    static protected $database;
    static protected $table_name = "";
    static protected $columns = [];
    public $errors = [];




    public static function set_database($database){
        self::$database = $database;
    }

    static public function find_by_sql($sql){
        $stmt = self::$database->prepare($sql);
        if (!$stmt->execute()){
            exit("Database query failed") ;
        }

        $object_array = [];
        while ($records = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $object_array[] = static::instantiate($records);
        }

        $stmt->closeCursor();
//        $stmt->rowCount();
        return $object_array;
    }

    public static function find_by_id($id){
        $sql = "SELECT * FROM " . static::$table_name ." WHERE id ='" . $id . "'";
        $stmt = self::find_by_sql($sql);
        if (!empty($stmt)){
            return array_shift($stmt);
        }else{
            return false;
        }
    }

    public static function count_all(){
        $sql = "SELECT * FROM " . static::$table_name;
        $stmt = self::$database->query($sql);
        $count = $stmt->rowCount();

        return $count;
    }

    public static function find_all(){
        $sql = "SELECT * FROM " . static::$table_name;
        return self::find_by_sql($sql);
    }

//    public static function find_all_by_id($id){
//        $sql = "SELECT * FROM " . static::$table_name . " WHERE post_id='" . $id . "' ORDER BY id DESC";
//        return self::find_by_sql($sql);
//    }

    public static function find_all_limit($limit = ""){
        $sql = "SELECT * FROM " . static::$table_name ." LIMIT $limit";
        return self::find_by_sql($sql);
    }

    public static function find_all_by_order(){
        $sql = "SELECT * FROM " . static::$table_name ." ORDER BY id ASC LIMIT 7";
        return self::find_by_sql($sql);
    }

    public function create(){
        $this->validate();
        if (!empty($this->errors)) return false;
        $attribute = $this->attributes();
        $columns = implode(',', array_keys($attribute));
        $values = ':'.implode(', :',array_keys($attribute));
        $sql = "INSERT INTO ". static::$table_name. "({$columns}) VALUES ({$values})";
        $stmt = self::$database->prepare($sql);
        if ($stmt){
            foreach ($attribute as $key => $value){
                $stmt->bindValue(':'.$key,$value);

            }
            $stmt->execute();
            $this->id = self::$database->lastInsertId();
        }
        return $stmt;
    }

    public function update(){
        $this->validate();
        if (!empty($this->errors)) return false;
        $attributes = $this->attributes();
        $attribute_pairs = [];
        foreach ($attributes as $key => $value){
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$table_name . " SET " . join(', ',$attribute_pairs) . " WHERE id='" . $this->id . "' ";

        $stmt = self::$database->prepare($sql);
        if ($stmt){
            foreach ($attributes as $key => $value){
                $stmt->bindValue(':'.$key,$value);
            }
            $stmt->execute();
        }
        return $stmt;
    }

    public function save() {
        // A new record will not have an ID yet
        if(isset($this->id)) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    private static function instantiate($records)
    {
        $object = new static();
        foreach ($records as $property => $value){
            if (property_exists($object,$property)){
                $object->$property = $value;
            }
        }
        return $object;
    }

    protected function attributes(){
        $attributes = [];
        foreach (static::$columns as $column){
            if ($column == 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function merge_attributes($args=[]) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    protected function validate(){
        $this->errors = [];

        //ADD CUSTOM VALIDATION

        return $this->errors;
    }

    public function delete(){
        $sql = "DELETE FROM " . static::$table_name . " WHERE id='" . $this->id . "' LIMIT 1";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}