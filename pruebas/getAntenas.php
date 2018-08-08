<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    
        $(".botonVerA").click(function() {
            var valores = "";
        // Obtenemos todos los valores contenidos en los <td> de la fila
        // seleccionada
            $(this).parents("tr").find(".numero").each(function() {
            valores += $(this).html() + "\n";
        });

        //CODIGO NUEVO
        $.post("Modales/antenasLL.php",{param:valores},
            function(data,status){

            var ante = JSON.parse(data);
             $("#idan").val(ante.id_antena);
             $("#macm").val(ante.mac);
             $("#ipip").val(ante.ip);
             $("#tip").val(ante.tipo);

//              console.log(data); 
            }
          );
        $("#update_user_modal").modal("show");
      });

        function ActualizaAnt(){
            var idana = $("#idan").val();

            var macma = $("#macm").val();
            var ipipa = $("#ipip").val();
            var tipa = $("#tip").val();

            $.post("Modales/actualizaAnt.php",{
                idanA:idana,
                macmA:macma,
                ipipA:ipipa,
                tipA:tipa 
            },
                function(data,status){
                    $("#update_user_modal").modal("hide");
                    toastr.info('ID :'+idana+'.', 'DATOS ACTUALIZADOS', {timeOut: 5000})
                }
            );
        }

    function DeleteAntena(id) {
      var conf = confirm("DESEA ELIMINAR LA ANTENA CON ID = "+id);
      if (conf == true) {
        $.post("api/deleteAnt.php", {
          id: id
        },
          function (data, status) {
            // reload Users by using readRecords();
     //       console.log(data +"   "+status);
            toastr.error('ID :'+id+'.', 'ELIMINADO CON EXITO', {timeOut: 5000})

            //readRecords();
          }
        );
    }
}


        $(".botonElimA").click(function(){
            var val = "";
        // Obtenemos todos los valores contenidos en los <td> de la fila
        // seleccionada
            $(this).parents("tr").find(".numero").each(function() {
                val += $(this).html() + "\n";
            });

            DeleteAntena(val);
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

th {text-align: left;}
</style>
</head>
<body>

<?php

include("../Modales/prueba1.php");

$sql2="SELECT * FROM antena";

$result = mysqli_query($mysqli,$sql2);
?>

<table>
<tr>
<th>ID</th>
<th>IP</th>
<th>TIPO</th>
<th>MODIFICAR</th>

</tr>"

<?php  
while($row = mysqli_fetch_array($result)) {
?>    
    <tr>
    <td class="numero"> <?php echo $row['id_antena']; ?> </td>
    <td> <?php echo $row['ip'];  ?> </td>
    <td> <?php echo $row['tipo']; ?> </td>

<td class="botonVerA"> <button type="button" class="btn btn-primary btn-md" >Ver</button> </td>
<td class="botonElimA"> <button type="button" class="btn btn-danger btn-md" >Eliminar</button> </td>
    
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
                <h4 class="modal-title" id="myModalLabel">Datos de la antena</h4>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label for="idan">ID</label>
                    <input type="text" id="idan" placeholder="Id de la antena" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="macm">MAC</label>
                    <input type="text" id="macm" placeholder="Mac" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="ipip">IP</label>
                    <input type="text" id="ipip" placeholder="Ip" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="tip">TIPO</label>
                    <input type="text" id="tip" placeholder="Tipo" class="form-control"/>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                <button type="button" class="btn btn-primary" onclick="ActualizaAnt()" >Actualizar</button>
                
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->
</div>

</body>
</html>