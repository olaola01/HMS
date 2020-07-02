<?php
include "vendor/autoload.php";
include "src/initialize.php";

use Src\helper\Path;
//use Src\helper\Notification;
$user_session_id = $user_session->get_session_id();
// Log out the user
date_default_timezone_set('Africa/Lagos');
$ldate = date( 'd-m-Y h:i:s A', time() );
$sql = "UPDATE userlog SET logout='$ldate' WHERE uid= '$user_session_id' ORDER BY id DESC LIMIT 1";
\Src\models\Userlog::continue_from($sql);
$user_session->logout();

Path::redirect_to(Path::url_for('user-login.php'));