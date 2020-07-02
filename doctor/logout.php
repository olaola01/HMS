<?php
include "../vendor/autoload.php";
include "../src/initialize.php";

use Src\helper\Path;
//use Src\helper\Notification;
$doctor_session_id = $doctor_session->get_session_id();
// Log out the Doctor
date_default_timezone_set('Africa/Lagos');
$ldate = date( 'd-m-Y h:i:s A', time() );
$sql = "UPDATE doctorslog SET logout='$ldate' WHERE uid= '$doctor_session_id' ORDER BY id DESC LIMIT 1";
\Src\models\Doctorlog::continue_from($sql);
$doctor_session->logout();

Path::redirect_to(Path::url_for('doctor/index.php'));