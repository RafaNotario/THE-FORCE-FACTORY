<?php
 
include("../Modales/prueba1.php");

$nombre = $_POST['nom'];
$apes = $_POST['apes'];
$nick = $_POST['nick'];
$dir = $_POST['dir'];
$cel = $_POST['cel'];
$correo = $_POST['mail'];
$rfc = $_POST['rfc'];
$fech = $_POST['datepick'];

 if ($_FILES['fot']['error']===4) {
	die('Es necesario establecer una imagen');
 }else if ($_FILES['fot']['error']===0) {

$imagenBinaria = addslashes(file_get_contents($_FILES['fot']['tmp_name']));

$res ="INSERT INTO cliente(nombre,apellidos,nick,direccion,celular,correo,rfc,fechaInicio,foto) VALUES(
	'".$nombre."','".$apes."','".$nick."','".$dir."','".$cel."','".$correo."','".$rfc."','".$fech."','".$imagenBinaria."')";

$result = mysqli_query($mysqli,$res);
//$var =  mysqli_affected_rows($conex);
	if($result == "1")
	{
		//$data = mysqli_fetch_array($result);
		echo "1";

	}else{
		echo "2";
	}

 }


 

?>


