
<?php  
/*ARCHIVO QUE LLENA EL MODAL DE CLIENTES*/
include("../Modales/prueba1.php");

$var = $_GET['param'];

//FILTRO ANTI XSS
$caracteres_malos = array("<",">","\"","'","","<",">","'","/");
$caracteres_buenos = array("& lt;","& gt;","& quot;","& #x27;","& #x2f;","& #062;","& #039;","& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $var);

if(isset($consultaBusqueda))
{

$query = "SELECT
			a.id_cli,a.nombre,a.apellidos,a.nick,a.direccion,a.correo,a.fechaInicio,c.id_cli,c.id_contrato,c.id_concepto,c.fecha_contrato,d.id_concepto,d.nombreConc,d.descripcion,d.costo
		FROM cliente a
		INNER JOIN contrato c
		INNER JOIN conceptos d
		ON a.id_cli = c.id_cli
		AND c.id_concepto = d.id_concepto
		AND CONCAT(nombre,' ',apellidos) LIKE '".$consultaBusqueda."%' "; 
		 

//SELECT * FROM cliente WHERE id_cli = 1 -> id_cli,nombre,apellidos,nick,direccion,celular,correo,rfc,fechaInicio,foto

$response = array();

$arra = array();
$i=0;

if (!$result = $mysqli->query($query)) die();

while($row = mysqli_fetch_array($result))
    {
    //	$row['foto'] = base64_encode($row['foto']);
        $response[$i] = $row;

        $i++;
    }
	
//CODIGO DE PRUEBA PARA AGREGAR CAMPOS AL OBJETO JSON 
//$response['query'] = $query;
//$response['foto'] = base64_encode($response['foto']);

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
?>