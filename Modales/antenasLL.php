
<?php  

include("prueba1.php");

if(isset($_POST['param']) && isset($_POST['param']) != "")
{

$var = $_POST['param'];

$query = "SELECT * FROM antena where id_antena = '".$var."' ";
//SELECT * FROM cliente WHERE id_cliente = 1

$response = array();

if($resultado = $mysqli->query($query)) {

//     $formulario = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
	$response = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
}

//****Con esto se puede verificar el query, y otras cosas con JSON en la consola y la trasa de las peticiones POST $response['query'] = $query;

echo json_encode($response);
//foreach ($formulario as $key ) {
	//echo "<br> $key";
//}
}else{
	$responseP['status'] = 200;
	$responseP['message'] = "Invalid Request!";
  }

?>