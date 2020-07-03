<?php
include "../vendor/autoload.php";
include "../src/initialize.php";

use Src\helper\Error;
use Src\helper\Path;
use Src\models\Doctor;
use Src\helper\Notification;
use Src\models\Specialization;

Error::require_doctor_login();
$doctor_id = $doctor_session->get_session_id();
$doctor = Doctor::find_by_id($doctor_id);

if (Path::is_post_request()){
    $args = $_POST['Doctor'];
    $doctor->merge_attributes($args);
    $result = $doctor->save();
    if ($result){
        $doctor_session->message("Profile has been updated successfully");
        Path::redirect_to(Path::url_for('doctor/edit-profile.php'));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Doctor | Edit Doctor Details</title>
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
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />


	</head>
	<body>
		<div id="app">
            <?php include (SHARED_PATH . '/doctor/sidebar.php')?>
			<div class="app-content">
                <?php include (SHARED_PATH . '/doctor/header.php')?>
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Doctor | Edit Doctor Details</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Doctor</span>
									</li>
									<li class="active">
										<span>Edit Doctor Details</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
                                    <h5 style="color: green; font-size:18px; ">
                                    <?php  echo Notification::display_message();?> </h5>
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Edit Doctor</h5>
												</div>
												<div class="panel-body">
<h4><?php echo Path::h($doctor->doctorName);?>'s Profile</h4>
<p><b>Profile Reg. Date: </b><?php echo Path::h($doctor->creationDate);//htmlentities($data['creationDate']);?></p>
<?php if($doctor->updationDate){?>
<p><b>Profile Last Updation Date: </b><?php echo Path::h($doctor->updationDate);?></p>
<?php } ?>
<hr />
													<form role="form" action="" name="adddoc" method="post" onSubmit="return valid();">
														<div class="form-group">
															<label for="DoctorSpecialization">
																Doctor Specialization
															</label>
							<select name="Doctor[specilization]" class="form-control" required="required">
					<option value="<?php echo Path::h($doctor->specilization);?>">
					<?php echo Path::h($doctor->specilization);?></option>
<?php
$special = Specialization::find_all();
foreach ($special as $as){

?>
																<option value="<?php echo Path::h($as->specilization); ?>">
																	<?php echo Path::h($as->specilization);?>
																</option>
																<?php } ?>

															</select>
														</div>

<div class="form-group">
															<label for="doctorname">
																 Doctor Name
															</label>
	<input type="text" name="Doctor[doctorName]" class="form-control" value="<?php echo Path::h($doctor->doctorName); ?>" >
														</div>


<div class="form-group">
															<label for="address">
																 Doctor Clinic Address
															</label>
					<textarea name="Doctor[address]" class="form-control"><?php echo Path::h($doctor->address);?></textarea>
														</div>
<div class="form-group">
															<label for="fess">
																 Doctor Consultancy Fees
															</label>
		<input type="text" name="Doctor[docFees]" class="form-control" required="required"  value="<?php echo Path::h($doctor->docFees);?>" >
														</div>
	
<div class="form-group">
									<label for="fess">
																 Doctor Contact no
															</label>
					<input type="text" name="Doctor[contactno]" class="form-control" required="required"  value="<?php echo Path::h($doctor->contactno);?>">
														</div>

<div class="form-group">
									<label for="fess">
																 Doctor Email
															</label>
					<input type="email" name="Doctor[docEmail]" class="form-control"  readonly="readonly"  value="<?php echo Path::h($doctor->docEmail);?>">
														</div>



														
														<?php //} ?>
														
														
														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Update
														</button>
													</form>
												</div>
											</div>
										</div>
											
											</div>
										</div>
									
								</div>
							
						<!-- end: BASIC EXAMPLE -->
			
					
					
						
						
					
						<!-- end: SELECT BOXES -->
						
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
                <?php include (SHARED_PATH . '/doctor/footer.php')?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
                <?php include (SHARED_PATH . '/doctor/setting.php')?>
			<>
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
