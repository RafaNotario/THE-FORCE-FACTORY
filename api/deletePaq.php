<?php


 include("../Modales/prueba1.php");

 $id  = $_POST["id"];

 $sql = "DELETE FROM conceptos WHERE id_concepto = '".$id."'";

 $result = $mysqli->query($sql);
 echo json_encode([$id]);

?>

