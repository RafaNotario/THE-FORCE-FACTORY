<?php
session_start();

include("conexion.php");

if ( isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["response"]) )  
{
	$user = mysqli_real_escape_string($conex, $_POST["user"]);
	$pass = mysqli_real_escape_string($conex, $_POST["pass"]);

		$secret = "6Ld6bp0UAAAAABepSbmuIz_S3Q2rP-QftEr3zKE2";
//		6Ld6bp0UAAAAABepSbmuIz_S3Q2rP-QftEr3zKE2
		$ip = $_SERVER["REMOTE_ADDR"];

		$captcha = $_POST["response"];

		$result = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
		$array = json_decode($result,TRUE);

	$sql = "SELECT nick_user FROM user WHERE (nick_user = '$user' or correo = '$user' ) AND contra ='$pass' ";

	$result = mysqli_query($conex,$sql);

	$num_row = mysqli_num_rows($result);

	if($num_row == "1" && $array["success"] )
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