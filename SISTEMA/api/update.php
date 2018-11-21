<?php
  include("/conexion.php");


  $id  = $_POST["id"];

  $post = $_POST;


  $sql = "UPDATE items SET title = '".$post['title']."'

    ,description = '".$post['description']."' 

    WHERE id = '".$id."'";


  $result = $conex->query($sql);


  $sql = "SELECT * FROM items WHERE id = '".$id."'"; 


  $result = $conex->query($sql);


  $data = $result->fetch_assoc();


  echo json_encode($data);


?>