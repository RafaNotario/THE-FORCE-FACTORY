
<?php  

include("prueba1.php");

	if(isset($_POST))
	{

		$clap = $_POST['claP'];
		$nombC = $_POST['nomCo'];
		$desp =  $_POST['desP'];
        $cosp = $_POST['cosP'];

$query = "UPDATE conceptos SET nombreConc = '".$nombC."',descripcion = '".$desp."', costo = '".$cosp."' WHERE id_concepto = '".$clap."'";
//SELECT * FROM cliente WHERE id_cliente = 1

if (!$result = $mysqli->query($query)) {
        exit(mysqli_error($mysqli));
    }
//echo "$response";
}
/*
$resultado=$mysqli->query($query);
print("<table>");
while ($rows = $resultado->fetch_assoc()) {
print("<tr>");
print("<td>".$rows["id_cliente"]."</td>");
print("<td>".$rows["nombre"]."</td>");
print("<td>".$rows["apellidos"]."</td>");
print("</tr>");
}
print("</table>");
$resultado->free();
*/
?>