<?php

// Some variables for the connection to the database
session_start();
$user = "finalprojectmark";
$pass = "Av3AVTpAmP??";
$database = "finalprojectmark";
// this code takes the info from the form and turns it into variables
$CompanyName = $_POST['companyname'];
$Contact = $_POST['primarycontact'];
$Phone = $_POST['phonenumber'];
$Email = $_POST['email'];

//database connection
$mysqli = new mysqli("den1.mysql2.gear.host", $user, $pass, $database);
mysqli_select_db($mysqli, $database) or die( "Unable to select database2");
//
$sql = "INSERT INTO Companies VALUES('','$CompanyName','$Contact','$Phone','$Email','')";

$mysqli->query($sql);
$mysqli->close();
header("Location: Companies.php");
exit();









?>