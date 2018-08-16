
<?php  
/*ARCHIVO QUE LLENA EL MODAL DE CLIENTES*/
include("../Modales/prueba1.php");

if(isset($_POST['param']) && isset($_POST['param']) != "")
{
$var = $_GET['param'];

$query = "SELECT id_cli,nombre,apellidos,nick,direccion FROM cliente WHERE nombre LIKE '".$var."%' ";
//SELECT * FROM cliente WHERE id_cli = 1 -> id_cli,nombre,apellidos,nick,direccion,celular,correo,rfc,fechaInicio,foto

$response = array();

$arra = array();
$i=0;

if(!$result = $mysqli->query($query)) die();

while($row = mysqli_fetch_array($result))
    {
    
        $response[$i] = $row;
        $i++;
    }
	
//CODIGO DE PRUEBA PARA AGREGAR CAMPOS AL OBJETO JSON 
//$response['query'] = $query;
//$response['foto'] = base64_encode($response['foto']);

echo json_encode($response);

/*
//CODIGO QUE MUESTRA EL USO DE JSON NOTATION ,ARRAYS

echo $encod;
echo "<br><br>";
$arra = json_decode($encod);
print_r($arra);


echo "<br><br><br>";

foreach ($arra as $key) {
	$id = $key -> id_cli;
	$nom = $key -> nombre;
	$ape = $key -> apellidos;
	$nic = $key -> nick;
	$dir = $key -> direccion;
	echo $id." ".$nom." ".$ape." ".$nic." ".$dir;
	echo "
	";
}
*/
}else{
	$response['status'] = 200;
	$response['message'] = "Invalid Request!";
	echo json_encode($response);

}
//}
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