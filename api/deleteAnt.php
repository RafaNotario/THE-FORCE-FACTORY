<?php


 include("../Modales/prueba1.php");

 $id  = $_POST["id"];

 $sql = "DELETE FROM antena WHERE id_antena = '".$id."'";

 $result = $mysqli->query($sql);
 echo json_encode([$id]);

?>

