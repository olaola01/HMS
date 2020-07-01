<?php 
//require_once("include/config.php");
use Src\models\Patient;

include "vendor/autoload.php";
include "src/initialize.php";

$patient = new Patient;

if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    $check = $patient->is_email_exists($email);
    if ($check) {
        echo "<span style='color:red'> Email already exists .</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } else {

        echo "<span style='color:green'> Email available for Registration .</span>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }

}
?>
