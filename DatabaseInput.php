<?php
// Some variables for the connection to the database
session_start();
$user = "secureapp2";
$pass = "P@ssword123";
$database = "secureapp2";
// this code takes the info from the form and turns it into variables
$BookingName = $_POST['BookingName'];
$email = $_SESSION["username"];
$Room = $_POST['Room'];
$Time = $_POST['Time'];
//database connection
$mysqli = new mysqli("den1.mysql5.gear.host", $user, $pass, $database);
mysqli_select_db($mysqli, $database) or die( "Unable to select database2");
//
$sql = "INSERT INTO RoomBooking VALUES('$BookingName','$email','$Time')";

$mysqli->query($sql);
$mysqli->close();
header("Location: booked.php");
exit();
?>