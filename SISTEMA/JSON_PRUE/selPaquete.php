
<HTML>

<select  id = "diagnostico">

<option value=" ">Eliga Diagnostico Principal</option>

<style type="text/css">

select{
	position: fixed;
}

</style>	

<?php	
	//$link = mysqli_connect("localhost","u670069086_root","espe06");
	//mysqli_select_db($link,"u670069086_hospi");

	include("../Modales/prueba1.php");

	$busq = "";

	$busq="SARA";	

	$resultado=mysqli_query($mysqli,"select nombre,apellidos from cliente");

	//echo "$resultado";

	$filas = mysqli_num_rows($resultado);
	
	if($filas != 0){
	//no es necesario
	//$resultado=mysqli_query($link,"select nombre,paterno from paciente where nombre like '%$ap%'");
		
		while($row=mysqli_fetch_array($resultado))
		{
			
				$codigo=$row['nombre'];
				$titulo=$row['apellidos'];
	
      			$c=trim($codigo);
      			$t=trim($titulo);
      
			//Output
      		$mensaje.="<option value='$c.$t'>".$c." ".$t."</option>";
		
		}
	}else{
		$mensaje.="<span> SIN DATOS </span>";
	}

	//Devolvemos el mensaje que tomará jQuery
	echo $mensaje;
?>

</select>

</HTML>
