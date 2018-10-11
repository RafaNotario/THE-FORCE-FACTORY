<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">

        $(".botonVerP").click(function() {
            var valores = "";
        // Obtenemos todos los valores contenidos en los <td> de la fila
        // seleccionada
            $(this).parents("tr").find(".numero").each(function() {
            valores += $(this).html() + "\n";
        });

        //CODIGO NUEVO
        $.post("Modales/paquetesLL.php",{param:valores},
            function(data,status){

            var paq = JSON.parse(data);

            $("#clav").val(paq.id_concepto);
            $("#desc").val(paq.descripcion);
            $("#cost").val(paq.costo);

            //  console.log(data); 
            }
          );

        $("#update_user_modal").modal("show");

      });


        function ActualizaPaq(){
            var cla = $("#clav").val();

            var des = $("#desc").val();
            var cos = $("#cost").val();

            $.post("Modales/actualizaPaq.php",{
                claP:cla,
                desP:des,
                cosP:cos 
            },
                function(data,status){
                
                    $("#update_user_modal").modal("hide");
                    toastr.info('ID :'+cla+'.', 'DATOS ACTUALIZADOS', {timeOut: 5000})
                }
            );
        }

 
    function DeleteUser(id) {
      var conf = confirm("DESEA ELIMINAR EL PAQUETE CON ID = "+id);
      if (conf == true) {
        $.post("api/deletePaq.php", {
          id: id
        },
          function (data, status) {
            // reload Users by using readRecords();
            console.log(data +"   "+status);
            toastr.error('ID :'+id+'.', 'ELIMINADO CON EXITO', {timeOut: 5000})

            //readRecords();
          }
        );
    }
}

        $(".botonElim").click(function(){
            var val = "";
        // Obtenemos todos los valores contenidos en los <td> de la fila
        // seleccionada
            $(this).parents("tr").find(".numero").each(function() {
                val += $(this).html() + "\n";
            });

            DeleteUser(val);
       // alert("valres a aliminar"+val);
        }); 

    </script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            text-align: left;
        }
    </style>

</head>

<body>

<?php

include("../Modales/prueba1.php");

$sql2="SELECT * FROM conceptos";

if (!$result = $mysqli->query($sql2)) {
        exit(mysqli_error($mysqli));
    }
?>

<table>
<tr>
<th>CLAVE</th>
<th>DESCRIPCION</th>
<th>COSTO</th>

</tr>


<?php
while($row = mysqli_fetch_array($result)) {
?>
    <tr>
    <td class="numero"> <?php echo $row['id_concepto']; ?> </td>
    <td> <?php echo $row['descripcion'];?> </td>
    <td> <?php echo $row['costo'];?>  </td>

    <td class="botonVerP"> <button type="button" class="btn btn-primary btn-md" id="myBtnVP">Ver</button> </td>
    <td class="botonElim"> <button type="button" class="btn btn-danger btn-md" id="myBtnEP">Eliminar</button> </td>


    </tr>

<?php
}

mysqli_close($mysqli);
?>
</table>

 <!--
CODIGO PARA MODAL
-->  
  <div class="container">
 <!-- <h2>Activate Modal with JavaScript</h2>
   Trigger the modal with a button 
  <button type="button" class="btn btn-info btn-lg" id="myBtn">Open Modal</button>
-->
  <!-- Modal -->
<!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Datos del paquete de internet</h4>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label for="clav">ID</label>
                    <input type="text" id="clav" placeholder="Clave de paquete" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="desc">DESCRIPCION</label>
                    <input type="text" id="desc" placeholder="Descripcion" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="cost">COSTO</label>
                    <input type="text" id="cost" placeholder="Costo de paquete" class="form-control"/>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="ActualizaPaq()" >Actualizar</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->
</div>


</body>
</html>