<?php 
	require_once '../clases/Conexion.php';

	$response = array();

	if (isset($_GET['funcion']) && !empty($_GET["funcion"]))
	{
		$func=$_GET['funcion'];
		//date_default_timezone_set("America/Mexico_City");
      	//$actual = date('Y-m-d'); 

		switch ($func) {
			case 'mensualidad':
				$actual = $_GET["mensual"];
				$unmes = date("Y-m-d",strtotime($actual."+ 1 month"));
				$response["status"]="OK";
				$response["proxFech"]=$unmes;
				echo json_encode($response);
			break;

			case '6meses':
				$actual = $_GET["mensual"];
				$sixmes = date("Y-m-d",strtotime($actual."+ 6 month"));
				$response["status"]="OK";
				$response["proxFech"]=$sixmes;
				echo json_encode($response);
			break;

			case 'anualidad':
				$actual = $_GET["mensual"];
				$anual = date("Y-m-d",strtotime($actual."+ 1 year"));
				$response["status"]="OK";
				$response["proxFech"]=$anual;
				echo json_encode($response);
			break;
			
			default:
			$response["llego"]="Default Unknown Option";
			echo json_encode($response);
				break;
		}

	}else{
		$response["status"]=200;
		$response["message"]="Var funcion is Empty funciones.p";
		echo json_encode($response);
	}

 ?>