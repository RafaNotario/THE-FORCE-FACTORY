<?php
session_start();

include("conexion.php");

if (isset($_POST["user"]) && isset($_POST["pass"])) 
{
	$user = mysqli_real_escape_string($conex, $_POST["user"]);
	$pass = mysqli_real_escape_string($conex, $_POST["pass"]);

	$sql = "SELECT nick_user FROM user WHERE (nick_user = '$user' or correo = '$user' ) AND contra ='$pass' ";

	$result = mysqli_query($conex,$sql);

	$num_row = mysqli_num_rows($result);

	if($num_row == "1")
	{
		$data = mysqli_fetch_array($result);
		$_SESSION["user"] = $data["nick_user"];//$M
		echo "1";

	}else{
		echo "Error no se encontró";
	}

}else{
	echo "Error de parámetros";
}
?>