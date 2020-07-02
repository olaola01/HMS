<?php
use Src\models\Doctor;

include "../vendor/autoload.php";
include "../src/initialize.php";

$doctor = new Doctor;

if (!empty($_POST['emailid'])) {
	$email = $_POST['emailid'];
	$check = $doctor->is_email_exists($email);
	if ($check) {
		echo "<span style='color:red'> Email already exists .</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	} else {

		echo "<span style='color:green'> Email available for Registration .</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}

}
//require_once("include/config.php");
//if(!empty($_POST["emailid"])) {
//	$email= $_POST["emailid"];
//
//		$result =mysqli_query($con,"SELECT docEmail FROM doctors WHERE docEmail='$email'");
//		$count=mysqli_num_rows($result);
//if($count>0)
//{
//echo "<span style='color:red'> Email already exists .</span>";
// echo "<script>$('#submit').prop('disabled',true);</script>";
//} else{
//
//	echo "<span style='color:green'> Email available for Registration .</span>";
// echo "<script>$('#submit').prop('disabled',false);</script>";
//}
//}


?>
