<?php

session_start();

	//Vaciar variables principales

	$_SESSION['LOGIN_informes'] = FALSE;
	$_SESSION['USUARIO'] = '';
	$_SESSION['NOMBRE'] = '';
	$_SESSION['APELLIDOS'] = '';
	$_SESSION['CEDULA'] = '';
	$_SESSION['PERFIL'] = '';
	$_SESSION['RANGO'] = '';
	$_SESSION['CODIGO_SISTEMA'] = '';

	//recordar vaciar todas las variables de sesión.

	$_SESSION['LOGIN_ERROR'] = '';				//revisado
	$_SESSION['USUARIO_TEMP'] = '';				//revisado
	$_SESSION['CAMBIO_PASS_ERROR'] = '';		//revisado
	
	$_SESSION['ACT_ERROR'] = '';				//revisado
	$_SESSION['EDITAR_ERROR'] = '';				//revisado
	$_SESSION['REACT_ERROR'] = '';				//revisado
	$_SESSION['REABRIR_ERROR'] = '';			//revisado		
	
	$_SESSION['AVC_ERROR'] = '';
	
	$_SESSION['MSJ_ERROR'] = '';
	
	header("Location: ../index.php");

?>
