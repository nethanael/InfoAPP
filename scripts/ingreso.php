<?php 

session_start();

$user = $_POST["user"];
$pass = md5($_POST["pass"]);


if ($user == '' || $pass == '') 
{

	$_SESSION['LOGIN_ERROR'] = "Datos incompletos!";
	$_SESSION['USUARIO_TEMP'] = $user;
	header("Location: ../index.php");
}
else 
{
	include '../includes/connection.php';
	$query = "SELECT * FROM usuarios WHERE usuario like '$user'";
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);
	$datos = mysqli_fetch_assoc($resul);
	$user_bd = $datos["usuario"];
	$pass_bd = $datos["contrasena"];
	mysqli_free_result($resul); 

	if ($user == $user_bd) 
	{
		if ($pass == $pass_bd) 
		{
			include '../includes/session_start.php';
			$rango = $_SESSION['RANGO'];
			if ($rango == 1) 									// rango 1 = jefatura // asigna trabajo
			{
				header("Location: ../home_hi_rank.php");
			} 
			
			if ($rango == 2 || $rango == 3) 					// rango 2 = Perfil técnico // rango 3 = perfil administrativo
			{
				header("Location: ../home_lo_rank.php");
			}
			
	}
		else
		{
			$_SESSION['LOGIN_ERROR'] = "Clave Incorrecta";
			$_SESSION['USUARIO_TEMP'] = $user;
			header("Location: ../index.php");
		}
	}
	else 
	{ 
		$_SESSION['LOGIN_ERROR'] = "Usuario no registrado";
		$_SESSION['TEMP'] = '';
		header("Location: ../index.php");
	}
}

?>

