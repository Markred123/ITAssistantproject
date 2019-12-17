<?php
$from = "info@ps.ie";
$to = "arnaskarciauskas@gmail.com";
$name = Trim(stripslashes($_POST['name']));
$email = Trim(stripslashes($_POST['email']));
$message = Trim(stripslashes($_POST['message']));

$subject = "Plum services enquiry";
$body ="";
$body .="Name: ";
$body .=$name;
$body .="\n";
$body .="Email: ";
$body .=$email;
$body .="\n";
$body .="Message: ";
$body .=$message;
$body .="\n";

$go = mail($to, $subject, $body, "From:<$from>");

if($go){
	header("Location: ../thankyou.php");
}
else{
	echo("Message could not be sent, please try again.");
}


?>

