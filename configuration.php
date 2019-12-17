<?php 

/* 
Database Information, 

*/
define('DB_SERVER','den1.mysql2.gear.host');
define('DB_USERNAME','finalprojectmark');
define ('DB_PASSWORD', 'P@Av3AVTpAmP??');
define ('DB_NAME', 'finalprojectmark');



$link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);



// This will check if the database has been connected
if($link === false){
    die("ERROR: Connection not established.".mysqli_connect_error());
}














?>