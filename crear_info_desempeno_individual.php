<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();

    if ($_SESSION['LOGIN_informes'] == ''){header("Location: index.php");}
    else {
		if ($_SESSION['RANGO'] == 2) header("Location: home_lo_rank.php");
	}
        
        $mes = date("m");
        $ano = date("y");

    include 'includes/funciones.php';
    include 'includes/connection.php';   // DB Connection
                                            
	$query = "SELECT apellidos FROM usuarios WHERE rango = 2";                   // Necessary field
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);                     // DB query
    $datos_test_2D = mysqli_fetch_all($resul);                                   // Built the array with data
    $datos_test_1D = array_reduce($datos_test_2D, 'array_merge', array());       //  Convert multidim array to 1 dimension array
    
    //print("<pre>".print_r($datos_test_2D,true)."</pre>");                      //  Debugging original array
    //print("<pre>".print_r($datos_test_1D,true)."</pre>");                      //  Debugging new array
    
    function dynamic_select($the_array, $element_name, $label = '', $init_value = '') { //dinamic select creation
        $menu = '';
        if ($label != '') $menu .= '
            <label for="'.$element_name.'">'.$label.'</label>';
        $menu .= '
            <select name="'.$element_name.'" id="'.$element_name.'">';
        if (empty($_REQUEST[$element_name])) {
            $curr_val = $init_value;
        } else {
            $curr_val = $_REQUEST[$element_name];
        }
        foreach ($the_array as $key => $value) {
            $menu .= '
                <option value="'.$value.'"';
            if ($key == $curr_val) $menu .= ' selected="selected"';
            $menu .= '>'.$value.'</option>';
        }
        $menu .= '
            </select>';
        return $menu;
    }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/test_borders.css">
		<title>Sistema de Informes</title>
	</head>
<body>
	<div class = "container mi_cont">

    <div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col bg-info text-white">
					<!--(row_!Titulo!)-->
					<p class="text-center h1">Sistema de Informes</p>
			</div>
		</div>
			
		<div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col">
			<!-- (row_!nav!) -->
			<p class="text-center font-weight-light">
				<a href="index.php" class="btn btn-secondary" role="button">Inicio</a>
				<a href="includes/session_kill.php" class="btn btn-secondary" role="button">Cerrar Sesi&oacute;n</a> 
				<a href="cambio_pass.php" class="btn btn-secondary" role="button">Cambiar Contraseña</a><br>
				Usuario: <?php echo $_SESSION['USUARIO'];?>
			</p>
			</div>
		</div>
          
        <div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col">
				<!-- (row_!Centro!) -->
                <form name="" method="post" action="scripts/crear_info_desempeno_individual.php"> 
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2">Crear informe Desempe&ntilde;o:</th>
                            </tr>
                        </thead>
                        <tr>
                            <td></td>
                            <td>
                                <img src="imgs/crear_info.png"><br>
                                    <span class="text-danger">
                                        <?php echo $_SESSION['INFO_ERROR'];?>
                                    </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Mes:</td>
                            <td>      
								<?php                                  
                                    echo cualMes($mes);                         // call month function
								?> 
                            </td>
                        </tr>
                        <tr>
                            <td>Año:</td>
                            <td>    
                            <?php echo $ano;?>   
                            </td>
                        </tr>
                        <tr>
                            <td>Colaborador:</td>
                            <td><?php echo dynamic_select($datos_test_1D, 'colaborador', '', 'some_var');?></td>
                        </tr>
                        <tr>
                                <td colspan="2"><input type="submit" name="Submit" value="Crear"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><a href="index.php">Volver</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
		<div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col blockquote-footer">
				<!--(row_!abajo!)-->
				<p class="text-center">- Desarrollado por Laboratorio I + D - 2020 - </p>
			</div>
		</div>

	</div>
</body>
</html>