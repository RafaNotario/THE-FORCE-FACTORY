<?php


 include("../Modales/prueba1.php");

 $id  = $_POST["id"];

 $sql = "DELETE FROM paquete WHERE clave = '".$id."'";

 $result = $mysqli->query($sql);
 echo json_encode([$id]);

?>

