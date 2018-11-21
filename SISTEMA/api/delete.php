<?php


 include("../Modales/prueba1.php");

 $id  = $_POST["id"];

 $sql = "DELETE FROM cliente WHERE id_cli = '".$id."'";

 $result = $mysqli->query($sql);
 echo json_encode([$id]);

?>

