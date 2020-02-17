
<?php  
/*ARCHIVO DE PRUEBA PARA OBTENER LAS ASISTENCIAS*/
include("../Modales/prueba1.php");

$var = $_GET['parampagos'];

//FILTRO ANTI XSS
$caracteres_malos = array("<",">","\"","'","","<",">","'","/");
$caracteres_buenos = array("& lt;","& gt;","& quot;","& #x27;","& #x2f;","& #062;","& #039;","& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $var);

if(isset($consultaBusqueda))
{

//$query = "SELECT * FROM asistencias WHERE id_cli = '".$consultaBusqueda."' ORDER BY fecha DESC";
    $query = "SELECT p.*,c.id_cli,a.id_cli
        FROM pagos p
        INNER JOIN contrato c
        INNER JOIN cliente a
        ON c.id_cli = a.id_cli
        AND c.id_contrato = p.id_contrato
        AND a.id_cli = '".$consultaBusqueda."' 
        ORDER BY p.id_pago DESC
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