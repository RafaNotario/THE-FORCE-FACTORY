
<?php  

include("prueba1.php");



	if(isset($_POST))
	{

		$idU = $_POST['idu'];
		$nomU =  $_POST['nomu'];
        $apeU = $_POST['apeu'];
        $dirU = $_POST['diru'];
        $telU = $_POST['telu'];
        $corU = $_POST['coru'];
        $rfcU = $_POST['rfcu'];

$query = "UPDATE cliente SET nombre = '".$nomU."', apellidos = '".$apeU."', direccion = '".$dirU."',telefono = '".$telU."', correo = '".$corU."',rfc = '".$rfcU."' WHERE id_cliente = '".$idU."'";
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