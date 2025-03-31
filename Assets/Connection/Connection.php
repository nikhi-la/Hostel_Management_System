<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$ServerName="localhost";
$User="root";
$password="";
$Database="db_hms";
$con=mysqli_connect($ServerName,$User,$password,$Database);
if(!$con)
{
	echo"Database Connection Error";	
}
?>