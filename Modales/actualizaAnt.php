
<?php  

include("prueba1.php");

	if(isset($_POST))
	{

		$idA = $_POST['idanA'];

		$maA =  $_POST['macmA'];
        $ipA = $_POST['ipipA'];
        $tiA = $_POST['tipA'];

$query = "UPDATE antena SET mac = '".$maA."', ip = '".$ipA."', tipo = '".$tiA."' WHERE id_antena = '".$idA."'";
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