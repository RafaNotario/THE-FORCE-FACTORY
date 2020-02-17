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
        AND CONCAT(nombre,' ',apellidos) LIKE '".$consultaBusqueda."%' ORDER BY a.nombre DESC
        ";

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
echo json_encode($response);

}else{
	$response['status'] = 200;
	$response['message'] = "Invalid Request!";
	echo json_encode($response);
}
?>