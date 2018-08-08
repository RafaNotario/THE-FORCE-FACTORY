<?php


 include("../Modales/prueba1.php");

 $id  = $_POST["id"];

 $sql = "DELETE FROM cliente WHERE id_cliente = '".$id."'";

 $result = $mysqli->query($sql);
 echo json_encode([$id]);

?>

