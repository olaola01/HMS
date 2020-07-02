<?php
include "../vendor/autoload.php";
include "../src/initialize.php";


use Src\helper\Error;
use Src\helper\Path;
use Src\models\Doctor;
use Src\models\Doctorlog;
use Src\helper\Notification;

$errors = '';
Error::doctor_allow_entry();
if(Path::is_post_request()){
    $docEmail = $_POST['username'];
    $password = $_POST['password'];
    $md5_this = md5($password);
    $found_account = Doctor::use_for_ipp($docEmail);
    if(empty($errors)){
        $doctor = Doctor::find_by_email($docEmail);

    }
    if ($found_account && $doctor->already_stored() == $md5_this){
        $doctor_session->store($doctor);
        $doctor_session_id = $doctor_session->get_session_id();
        $mail_to_get_id = $found_account['id'];
        $email_itself = $found_account['docEmail'];
        $host = $_SERVER['HTTP_HOST'];
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 1;
        $doctor_log = new Doctorlog($mail_to_get_id, $email_itself, $uip, $status);
        $doctor_log->create();
        Path::redirect_to(Path::url_for('doctor/dashboard.php?doctor_id=' . $doctor_session_id));
    }else{
        $mail_to_get_id = 'NULL';
        $email_itself = $docEmail;
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 0;
        $doctor_log = new Doctorlog($mail_to_get_id, $email_itself, $uip, $status);
        $doctor_log->create();
        $errors = "Incorrect Credentials";}
}
else {
    $doctor = new Doctor;
}


?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Doctor Login</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body class="login">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
				<a href="../index.html">	<h2> HMS | Doctor Login</h2></a>
				</div>

				<div class="box-login">
					<form class="form-login" method="post" action="<?php echo Path::url_for('doctor/index.php');?>">
						<fieldset>
							<legend>
								Sign in to your account
							</legend>
							<p>
								Please enter your name and password to log in.<br />
								<span style="color:red;">
                                    <?php echo Error::customized_display_error($errors) ?>
                                    <?php echo Notification::display_message(); ?></span>
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="username" placeholder="Username">
									<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" placeholder="Password">
									<i class="fa fa-lock"></i>
									 </span>
									 <a href="forgot-password.php">
									Forgot Password ?
								</a>
							</div>
							<div class="form-actions">
								
								<button type="submit" class="btn btn-primary pull-right" name="submit">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							
						
						</fieldset>
					</form>

					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> HMS</span>. <span>All rights reserved</span>
					</div>
			
				</div>

			</div>
		</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	
		<script src="assets/js/main.js"></script>

		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	
	</body>
	<!-- end: BODY -->
</html>