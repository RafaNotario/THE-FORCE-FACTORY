<?php

include ("conexion.php");

$query = "SELECT * FROM habitacion";
$result = $conex->query($query);
?>
<!-- <select> -->   
    <?php    
    while ( $row = $result->fetch_array() )    
    {
        ?>
        <option value=" <?php echo $row['num_habitacion'] ?> " >
        <?php echo $row['descripcion']; ?>
        </option>
        <?php
    }    
    ?>       
<!-- </select> -->   
<?php
?>