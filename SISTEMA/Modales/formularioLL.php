
<?php  
/*ARCHIVO QUE LLENA EL MODAL DE CLIENTES*/
include("prueba1.php");

if(isset($_POST['param']) && isset($_POST['param']) != "")
{

$var = $_POST['param'];

$query = "SELECT * FROM cliente where id_cli = '".$var."' ";
//SELECT * FROM cliente WHERE id_cli = 1 -> id_cli,nombre,apellidos,nick,direccion,celular,correo,rfc,fechaInicio,foto

$response = array();

if($resultado = $mysqli->query($query)) {
//     $formulario = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
	$response = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
}
	
//CODIGO DE PRUEBA PARA AGREGAR CAMPOS AL OBJETO JSON 
//$response['query'] = $query;
$response['foto'] = base64_encode($response['foto']);

echo json_encode($response);
//foreach ($formulario as $key ) {
//
	//echo "<br> $key";
//}
}else{
	$response['status'] = 200;
	$response['message'] = "Invalid Request!";
	echo json_encode($response);
  }
//echo "$response";

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