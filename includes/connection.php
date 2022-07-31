<?php

	include('server_params.php');	//datos para la conexión de la base de datos

	// Create connection
	$conn = new mysqli($servername, $username, $password, $myDB);
	$conn->set_charset("utf8");										//Esto permite que cuando existan ñ o tildes en la base de datos
																	//se recuperen bien o se muestren correctamente
	
	// importante recordar que la base de datos tiene que tener de valor para "Collation": utf8mb4_unicode_ci
	// eso permite que existan ñ´s y tildes dentro de la misma

	// Check connection
	if ($conn->connect_error) {
   	 	die("Connection failed: " . $conn->connect_error);
	}
		else{
			//echo "Connected successfully";
		}

?>