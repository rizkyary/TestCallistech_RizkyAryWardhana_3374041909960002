<?php
	$server   = "localhost";
	$username = "root";
	$password = "";
	$database = "namacustomer";
	
	$conn = new mysqli ($server, $username, $password, $database);
	if ($conn->connect_error) {
		die("Koneksi Error ". $con->connect_error);
	}
?>