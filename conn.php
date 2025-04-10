<?php
	$host = "localhost";   //ip / domain where mysql server run
	$user = "root";       // mysql server valid username
	$pass = "";			  // mysql user password
	$db   = "pg6";        // database to select
	
	//connection function using mysqli driver (3 drivers at least exist)
	//if connection fails print error and exit
	$conn = mysqli_connect($host, $user, $pass, $db) or die(mysqli_connect_error());
?>
