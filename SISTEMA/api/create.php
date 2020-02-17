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

$compuesto = strtoupper(limpia_espacios($nombre.$apes));

$busca = "SELECT nombre,apellidos FROM cliente WHERE UPPER(TRIM(CONCAT(REPLACE(nombre,space(1),space(0)),REPLACE(apellidos,space(1),space(0) ) ) ) ) = '".$compuesto."' ";

//busca nombre y apellido
$resultado = $mysqli->query($busca);
$const = $resultado->num_rows;

if ($const == 0 ) {
	if ($_FILES['fot']['error']===4) {
		die('Es necesario establecer una imagen');
	}else if ($_FILES['fot']['error']===0) {

	$imagenBinaria = addslashes(file_get_contents($_FILES['fot']['tmp_name']));

	$res ="INSERT INTO cliente(nombre,apellidos,nick,direccion,celular,correo,rfc,fechaInicio,foto) VALUES(
		'".$nombre."','".$apes."','".limpia_espacios($nick)."','".$dir."','".limpia_espacios($cel)."','".limpia_espacios($correo)."','".limpia_espacios($rfc)."','".limpia_espacios($fech)."','".$imagenBinaria."')";

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

}else{
	echo "5";
}

$resultado->close();

function limpia_espacios($cadena){
	$cadena = str_replace(' ','',$cadena);
	return $cadena;
}

?>


