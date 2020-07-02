<?php
/**
 * Created by PhpStorm.
 * tourproject
 * By: Olamiposi
 * 25/06/2020
 * 2020
 **/

namespace Src\helper;


class Error
{
    public static function display_errors($errors=array()) {
        $output = '';
        if(!empty($errors)) {
            $output .= "<div class=\"errors\">";
            $output .= "<h3>";
            $output .= "Warning";
            $output .= "</h3>";
            $output .= "<ul>";
            foreach($errors as $error) {
                $output .= "<li>" . Path::h($error) . "</li>";
            }
            $output .= "</ul>";
            $output .= "</div>";
        }
        return $output;
    }

    public static function customized_display_error($errors){
        $output = '';
        if (!empty($errors)){
            $output .= '<div class="alert alert-danger alert-dismissible" role="alert">';
            $output .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            $output .= '<div class="alert-icon contrast-alert">';
            $output .= '<i class="fa fa-remove"></i>';
            $output .= '</div>';
            $output .= '<div class="alert-message">';
            $output .= ' <span><strong>Warning! </strong>' . Path::h($errors) . '</span>';
            $output .= '</div>';
            $output .= '</div>';
        }

        return $output;
    }

    public static function require_user_login(){
        global $user_session;
        if(!$user_session->is_logged_in()) {
            Path::redirect_to(Path::url_for('user-login.php'));
        } else {
            // Do nothing, let the rest of the page proceed
        }
    }

    public static function require_doctor_login(){
        global $doctor_session;
        if(!$doctor_session->is_logged_in()) {
            Path::redirect_to(Path::url_for('doctor/index.php'));
        } else {
            // Do nothing, let the rest of the page proceed
        }
    }

    public static function require_admin_login(){
        global $admin_session;
        if(!$admin_session->is_logged_in()) {
            Path::redirect_to(Path::url_for('admin/index.php'));
        } else {
            // Do nothing, let the rest of the page proceed
        }
    }

    public static function allow_entry(){
        global $user_session;
        if($user_session->is_logged_in()) {
            Path::redirect_to(Path::url_for('dashboard.php'));
        } else {
            // Do nothing, let the rest of the page proceed
        }
    }

    public static function doctor_allow_entry(){
        global $doctor_session;
        if($doctor_session->is_logged_in()) {
            Path::redirect_to(Path::url_for('doctor/dashboard.php'));
        } else {
            // Do nothing, let the rest of the page proceed
        }
    }

    public static function admin_allow_entry(){
        global $admin_session;
        if($admin_session->is_logged_in()) {
            Path::redirect_to(Path::url_for('admin/dashboard.php'));
        } else {
            // Do nothing, let the rest of the page proceed
        }
    }

}