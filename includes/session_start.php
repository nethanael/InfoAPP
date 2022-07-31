<?php

	$_SESSION['LOGIN_informes'] = TRUE;
	$_SESSION['USUARIO'] = $datos["usuario"];
	$_SESSION['NOMBRE'] = $datos["nombre"];
	$_SESSION['APELLIDOS'] = $datos["apellidos"];
	$_SESSION['CEDULA'] = $datos["cedula"];
	$_SESSION['PERFIL'] = $datos["descripcion"];
	$_SESSION['CODIGO_SISTEMA'] = $datos["codigo_usuario"];
	$_SESSION['RANGO'] = $datos["rango"];

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
	
?>