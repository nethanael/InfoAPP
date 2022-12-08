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

    function cualMes($mes){
        switch ($mes) {
            case 1:
                return "Enero ";
                break;
            case 2:
                return "Febrero ";
                break;
            case 3:
                return "Marzo ";
                break;
            case 4:
                return "Abril ";
                break;
            case 5:
                return "Mayo ";
                break;
            case 6:
                return "Junio ";
                break;
            case 7:
                return "Julio ";
                break;
            case 8:
                return "Agosto ";
                break;
            case 9:
                return "Setiembre ";
                break;
            case 10:
                return "Octubre ";
                break;
            case 11:
                return "Noviembre ";
                break;
            case 12:
                return "Diciembre ";
                break;
        }

    }

    include 'includes/connection.php';                                           // Conexion a BD
	$query = "SELECT apellidos FROM usuarios WHERE rango = 3";                   // Consulta del campo necesario
	$resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);                     //  Hacemos consulta a la BD
    $datos_test_2D = mysqli_fetch_all($resul);                                   // Construimos el array con los datos
    $datos_test_1D = array_reduce($datos_test_2D, 'array_merge', array());       //  Convertirmos array multidimensional a uno sencillo
    
    //print("<pre>".print_r($datos_test_2D,true)."</pre>");                         //  Debugging para ver array original
    //print("<pre>".print_r($datos_test_1D,true)."</pre>");                           //  Debugging para ver array nuevo
    
    function dynamic_select($the_array, $element_name, $label = '', $init_value = '') { //funcion que crea selects dinamicos
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

        <?php include 'includes/header.php'; ?>
	    <?php include 'includes/navBar.php'; ?>
    
        <div class = "row justify-content-center mi_row">
			<div class = "col-6 mi_col">
				<!-- (row_!Centro!) -->
                <form name="" method="post" action="scripts/crear_info_desempeno_individual_admin.php"> 
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th class="mi_td" colspan="2">Crear informe Desempe&ntilde;o:</th>
                            </tr>
                        </thead>
                        <tr>
                            <td class="mi_td" colspan="2">
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
                                    echo cualMes($mes);                         //funcion de mes
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
                            <td class="mi_td" colspan="2"><input class="btn btn-warning" type="submit" name="Submit" value="Crear"></td>
                        </tr>
                        <tr>
                            <td class="mi_td" colspan="2"><a class="btn btn-info" href="index.php">Volver</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>

	</div>
</body>
</html>