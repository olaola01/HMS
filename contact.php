<?php
/**
 * Created by PhpStorm.
 * hospital
 * By: Olamiposi
 * 26/06/2020
 * 2020
 **/

include "vendor/autoload.php";
include "src/initialize.php";

use Src\helper\Path;
use Src\models\Contact;
use Src\helper\Notification;
use Src\helper\Error;

if(Path::is_post_request()) {
    $args = $_POST['Contact'];
    $contact = new Contact($args);
    $result = $contact->create();
    if ($result){
        Notification::message("Thank you for contacting us, A mail will be used to contact you");
    }
}else{
    $contact = new Contact;
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>HMS | Contact us</title>
    <link href="home/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
<!--start-wrap-->

<!--start-header-->
<div class="header">
    <div class="wrap">
        <!--start-logo-->
        <div class="logo">
            <a href="index.html" style="font-size: 30px;">Hospital Management system</a>
        </div>
        <!--end-logo-->
        <!--start-top-nav-->
        <div class="top-nav">
            <ul>
                <li><a href="index.html">Home</a></li>

                <li class="active"><a href="contact.php">contact</a></li>
            </ul>
        </div>
        <div class="clear"></div>
        <!--end-top-nav-->
    </div>
    <!--end-header-->
</div>
<div class="clear"></div>
<div class="wrap">
    <div class="contact">
        <div class="section group">
            <div class="col span_1_of_3">

                <div class="company_address">
                    <h2>Hospital Address :</h2>
                    <p>500 Lorem Ipsum Dolor Sit,</p>
                    <p>22-56-2-9 Sit Amet, Lorem,</p>
                    <p>India</p>
                    <p>Phone:(+91) 9121672365 </p>
                    <p>Fax: (+91) 9121672365 </p>
                    <p>Email: <span>support@phptraining.com</span></p>

                </div>
            </div>
            <div class="col span_2_of_3">
                <div class="contact-form">
                    <?php echo Notification::display_message(); ?>
                    <?php echo Error::display_errors($contact->errors);?>
                    <h2>Contact Us</h2>
                    <form action="<?php echo Path::url_for("contact.php"); ?>" name="contactus" method="post">
                        <div>
                            <span><label>NAME</label></span>
                            <span><input type="text" name="Contact[fullname]" required="true" value=""></span>
                        </div>
                        <div>
                            <span><label>E-MAIL</label></span>
                            <span><input type="email" name="Contact[email]" required="ture" value=""></span>
                        </div>
                        <div>
                            <span><label>MOBILE.NO</label></span>
                            <span><input type="text" name="Contact[contactno]" required="true" value=""></span>
                        </div>
                        <div>
                            <span><label>Description</label></span>
                            <span><textarea name="Contact[message]" required="true"> </textarea></span>
                        </div>
                        <div>
                            <span><input type="submit" name="submit" value="Submit"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<div class="footer">
    <div class="wrap">
        <div class="footer-left">
            <ul>
                <li><a href="index.html">Home</a></li>

                <li><a href="contact.php">contact</a></li>
            </ul>
        </div>

        <div class="clear"></div>
    </div>
</div>
<!--end-wrap-->
</body>
</html>

