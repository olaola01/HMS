<?php
/**
 * Created by PhpStorm.
 * tourproject
 * By: Olamiposi
 * 24/06/2020
 * 2020
 **/


namespace Src\Validation;


class Validator
{
    public static function is_blank($value) {
        return !isset($value) || trim($value) === '';
    }

    public static function has_valid_email_format($value) {
        $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
        return preg_match($email_regex, $value) === 1;
    }

    public static function is_equal($first_value,$second_value){
        if ($first_value == $second_value) return true; else return false;
    }
}