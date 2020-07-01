<?php	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "smartagroproyecto";

	// Create connection
	$conexion = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conexion->connect_error) 
	{
	    die("Error de conexion a la base de datos");
	} 

?>