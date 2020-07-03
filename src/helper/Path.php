<?php
/**
 * Created by PhpStorm.
 * hospital
 * By: Olamiposi
 * 27/06/2020
 * 2020
 **/


namespace Src\helper;


class Path
{
    public static function url_for($script_path) {

        if($script_path[0] != '/') {
            $script_path = "/" . $script_path;
        }
        return WWW_ROOT . $script_path;
    }

    public static function is_post_request() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public static function is_get_request() {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    public static function h($string="") {
        return htmlspecialchars($string);
    }

    public static function u($string="") {
        return urlencode($string);
    }

    public static function redirect_to($location) {
        header("Location: " . $location);
        exit;
    }
}