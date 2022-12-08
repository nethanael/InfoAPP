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
                <form name="" method="post" action="scripts/crear_info_desempeno.php"> 
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