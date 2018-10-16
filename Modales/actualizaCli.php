<?php 

include("prueba1.php");

if(isset($_POST)){
    $idU = $_POST['id_cli'];
    $nom = $_POST['nomb'];
    $apes = $_POST['aps'];
    $nick = $_POST['nck'];
    $direc = $_POST['direc'];
    $tel = $_POST['tel'];
    $correo = $_POST['correo'];
    $rf = $_POST['rf'];
    $fech = $_POST['fech'];

    if ($_FILES['fot']['error']===4) {
    //die('Es necesario establecer una imagen');
$res ="UPDATE cliente SET nombre = '".$nom."',apellidos = '".$apes."',nick = '".$nick."',direccion = '".$direc."',celular = '".$tel."',correo = '".$correo."',rfc = '".$rf."',fechaInicio = '".$fech."' WHERE id_cli = '".$idU."'";

 }else if ($_FILES['fot']['error']===0) {
 
$imagenBinaria = addslashes(file_get_contents($_FILES['fot']['tmp_name']));

$res ="UPDATE cliente SET nombre = '".$nom."',apellidos = '".$apes."',nick = '".$nick."',direccion = '".$direc."',celular = '".$tel."',correo = '".$correo."',rfc = '".$rf."',fechaInicio = '".$fech."',foto = '".$imagenBinaria."' WHERE id_cli = '".$idU."'";
 }
 
$result = mysqli_query($mysqli,$res);
//$var =  mysqli_affected_rows($conex);
    if($result == "1")
    {
        //$data = mysqli_fetch_array($result);
        echo "1";

    }else{
        echo "2";
    }
//echo "$idU <br> $nom <br> $apes <br> $nick <br> $direc <br> $tel <br> $correo <br> $rf <br> $fech";
}else{
    echo "0";
}
 ?>