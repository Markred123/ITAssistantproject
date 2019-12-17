<?php

session_start();
// Declares the variables for connection to the server
$servername = "den1.mysql2.gear.host";
$username = "plumservices";
$password = "P@ssword123";
$dbname = "plumservices";

// Create connection to the server and check if its working
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "DELETE FROM Jobs";
$conn->query($sql);
header("location: ../booked.php");

?>