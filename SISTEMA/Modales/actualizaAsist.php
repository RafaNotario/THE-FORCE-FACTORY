
<?php  

include("prueba1.php");

	if(isset($_POST))
	{

		$clap = $_POST['id_asist'];
		$nombC = $_POST['fech'];

$query = "UPDATE asistencias SET fecha = '".$nombC."' WHERE id_asist = '".$clap."'";
//SELECT * FROM cliente WHERE id_cliente = 1


if (!$result = $mysqli->query($query)) {
        exit(mysqli_error($mysqli));
    }else{
    	echo "1";
    }
//echo "$response";
}else{
	echo "0";
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