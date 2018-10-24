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
		$nomC=$_POST['nomConc'];
		$des=$_POST['descriP'];
		$cos=$_POST['costoP'];
		insertaConceptos($nomC,$des,$cos);
		echo "1";
	}else{
		echo "0";
	}

		break;
	
	case 'funcion2':
	if(isset($_POST['idcli'])){
		$idc = $_POST['idcli'];
		echo "1";
	}else{
		echo "05";
	}
		
		break;

	default:
		echo "DESCONOCIDA";
		break;
}

function insertaConceptos($nomC,$descr,$coast){
try{
	$dbh = new Conexion();
	$consulta = "INSERT INTO conceptos(nombreConc,descripcion,costo) VALUES('".$nomC."','".$descr."','".$coast."')";

	$dbh->exec($consulta);
		
	
}catch(PDOException $e){
	echo $e->getMessage();
}
	$dbh = null;
}


function insertaCont(){

	
 ?>
}
