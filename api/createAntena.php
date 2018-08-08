<?php
 
include("../Modales/prueba1.php");

$mc = $_POST['MC'];
$ip = $_POST['IP'];
$tip = $_POST['TIP'];
 
$res ="INSERT INTO antena(mac,ip,tipo) VALUES('".$mc."','".$ip."','".$tip."')";

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


