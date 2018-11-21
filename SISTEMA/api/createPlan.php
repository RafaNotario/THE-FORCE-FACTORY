<?php
 
include("../Modales/prueba1.php");

$DESCRIp = $_POST['descriP'];
$COSTOp = $_POST['costoP'];
 
$res ="INSERT INTO paquete(descripcion,costo) VALUES('".$DESCRIp."','".$COSTOp."')";

$result = mysqli_query($mysqli,$res);
//$var =  mysqli_affected_rows($conex);
	if($result == "1")
	{
		//$data = mysqli_fetch_array($result);
		echo "1";
	}else{
		echo "2";
	}

 
 
?>


