<?php 

require_once '../clases/Conexion.php';
//$conexion = new Conexion();
/*
function conexion(){
//try{
	$conn = new PDO('mysql:host=localhost;dbname=ff','root','');
	$conn -> exec("set names utf8");
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//}catch(PDOException $e){
//	echo "ERROR: ".$e->getMessage();
//}
return $conn;
}
*/
if (isset($_POST['funcion']) && !empty($_POST["funcion"])) {
	$func=$_POST['funcion'];
}

switch ($func) {
	case 'funcion1':
		if((isset($_POST['descriP']) && !empty($_POST['descriP'])) && (isset($_POST['costoP']) && !empty($_POST['costoP']))  ){	
		$des=$_POST['descriP'];
		$cos=$_POST['costoP'];
		insertaConceptos($des,$cos);
		echo "1";
	}else{
		echo "0";
	}

		break;
	
	case 'funcion2':
		echo "RAFA";
		break;

	default:
		echo "DESCONOCIDA";
		break;
}

function insertaConceptos($descr,$coast){
try{
	$dbh = new Conexion();
	$consulta = "INSERT INTO conceptos(descripcion,costo) VALUES('".$descr."','".$coast."')";

	$dbh->exec($consulta);
		
	
}catch(PDOException $e){
	echo $e->getMessage();
}
	$dbh = null;
}
 ?>
