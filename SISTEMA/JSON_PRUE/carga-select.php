
<?php  
/*ARCHIVO QUE LLENA EL MODAL DE CLIENTES*/
include("../Modales/prueba1.php");

$query = "SELECT * FROM conceptos ORDER BY nombreConc DESC";
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

ALTER TABLE contrato ADD CONSTRAINT contrato_ibfk_1 FOREIGN KEY (id_cli) REFERENCES cliente (id_cli) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE cliente ADD CONSTRAINT 'cliente_ibfk_1' FOREIGN KEY(id_cli) REFERENCES contrato(id_cli);

*/
?>