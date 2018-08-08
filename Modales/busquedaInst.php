<?php  

$parametro = $_GET['term'];


$msj ="";

$msj .='
		<p> '.$parametro.' </p>
';

echo $msj;
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