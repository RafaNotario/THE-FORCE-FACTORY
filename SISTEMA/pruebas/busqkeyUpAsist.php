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

$query = "SELECT a.id_cli,a.nombre,a.apellidos,a.direccion,a.nick,a.fechaInicio,b.id_contrato,b.id_cli
        FROM cliente a
        INNER JOIN contrato b
        
        ON a.id_cli = b.id_cli
        
        AND CONCAT(nombre,' ',apellidos) LIKE '".$consultaBusqueda."%'
        ";
				
//$sql = "SELECT a.id_cli,a.nombre,a.apellidos,a.direccion,b.id_contrato,c.id_contrato,c.fecha_pago,c.fecha_proxPagoM
//        FROM cliente a
//        INNER JOIN contrato b
//        INNER JOIN pagos c
//        ON a.id_cli = b.id_cli
//        AND b.id_contrato = c.id_contrato
//        ORDER BY a.id_cli
//        ";

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