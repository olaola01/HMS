<?php
/**
 * Created by PhpStorm.
 * tourproject
 * By: Olamiposi
 * 25/06/2020
 * 2020
 **/


namespace Src\helper;



class Notification
{
    public static function display_message() {
        $output = '';
        $msg = self::message();
        if(isset($msg) && $msg != '') {
            self::clear_message();
            $output .= '<div class="alert alert-success alert-dismissible" role="alert">';
            $output .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            $output .= '<div class="alert-icon contrast-alert">';
            $output .= '<i class="fa fa-check"></i>';
            $output .= '</div>';
            $output .= '<div class="alert-message">';
            $output .= ' <span><strong>Success! </strong>' . Path::h($msg) . '</span>';
            $output .= '</div>';
            $output .= '</div>';
            return $output;
        }
    }

    public static function message($msg="") {
        if(!empty($msg)) {

            $_SESSION['message'] = $msg;
            return true;
        } else {
            return $_SESSION['message'] ?? '';
        }
    }

    protected static function clear_message() {
        unset($_SESSION['message']);
    }
}