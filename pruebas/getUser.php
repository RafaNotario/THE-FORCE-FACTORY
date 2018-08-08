
<!DOCTYPE html>
<html lang="es">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">

      $(".botonVer").click(function() {
        var valores = "";
        // Obtenemos todos los valores contenidos en los <td> de la fila
        // seleccionada
        $(this).parents("tr").find(".numero").each(function() {
          valores += $(this).html() + "\n";
        });

//CODIGO NUEVO
        $.post("Modales/formularioLL.php",{param:valores},

            function(data,status){

            var user = JSON.parse(data);

            $("#id_cli").val(user.id_cli);//update_first_name
            $("#nomb").val(user.nombre);//update_last_name
            $("#aps").val(user.apellidos);//update_email
            $("#nck").val(user.nick);
            $("#direc").val(user.direccion);
            $("#tel").val(user.celular);
            $("#correo").val(user.correo);
            $("#rf").val(user.rfc);
            $("#fech").val(user.fechaInicio);
            $("#imgn").attr("src", "data:image/png;base64,"+user.foto);
            });

            $("#update_user_modal").modal("show");

        console.log(status);
      });

    function UpdateUserDetails() {

      var idU = $("#id_cli").val();
      // get values
      var nomU = $("#nomb").val();
      var apeU = $("#aps").val();
      var dirU = $("#direc").val();
      var telU = $("#tel").val();
      var corU = $("#correo").val();
      var rfcU = $("#rf").val();
    // Update the details by requesting to the server using ajax
      $.post("Modales/actualizaCli.php", {
        idu: idU, 
        nomu: nomU,
        apeu: apeU,
        diru: dirU,
        telu: telU,
        coru: corU,
        rfcu : rfcU
      },

      function (data, status) {
          // hide modal popup
          $("#update_user_modal").modal("hide");
          toastr.info('ID :'+idU+'.', 'DATOS ACTUALIZAOS', {timeOut: 5000})
          // reload Users by using readRecords();
//          readRecords();
        }
      );
    }

    function DeleteUser(id) {
      var conf = confirm("DESEA ELIMINAR AL USUARIO CON ID = "+id);
      if (conf == true) {
        $.post("api/delete.php", {
          id: id
        },
          function (data, status) {
            // reload Users by using readRecords();
          toastr.error('ID :'+id+'.', 'ELIMINADO CON EXITO', {timeOut: 5000})
//            console.log(status);
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

$sql2="SELECT * FROM cliente";

if (!$result = $mysqli->query($sql2)) {
        exit(mysqli_error($mysqli));
    }
//echo "$response";

?>
<table>
<tr>
<th>ID</th>
<th>NOMBRE</th>
<th>APELLIDOS</th>
<th>DIRECCION</th>
<th>OPC1</th>
</tr>
 
<?php


while($row = mysqli_fetch_array($result)) {
?>
  <tr>
    <td class="numero"> <?php echo  $row['id_cli']; ?> </td>
    <td> <?php echo  $row['nombre']; ?> </td>
    <td> <?php echo  $row['apellidos']; ?></td>
    <td> <?php echo  $row['direccion']; ?></td>
<!-- 
    <td> <?php //echo  $row['telefono']; ?></td>
    <td> <?php //echo  $row['correo']; ?></td>
    <td> <?php //echo  $row['rfc']; ?></td>
-->
    <td class="botonVer"> <button type="button" class="btn btn-primary btn-md" id="myBtnV">Ver</button> </td>
    <td class="botonElim"> <button type="button" class="btn btn-danger btn-md" id="myBtnE">Eliminar</button> </td>
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
                <h4 class="modal-title" id="myModalLabel">Datos del cliente</h4>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label for="id_cli">Id cliente</label>
                    <input type="text" id="id_cli" placeholder="Id_cliente" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="nomb">Nombre(s)</label>
                    <input type="text" id="nomb" placeholder="Nombre" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="aps">Apellido(s)</label>
                    <input type="text" id="aps" placeholder="Apellidos" class="form-control"/>
                </div>

                <div class="form-group">
                  <label for="nck"> NickName </label>
                  <input type="text" id="nck" placeholder="NickName" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="direc"> Direccion </label>
                    <input type="text" id="direc" placeholder="Direccion" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="tel"> Telefono/Celular </label>
                    <input type="text" id="tel" placeholder="Telefono" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="correo"> Correo </label>
                    <input type="text" id="correo" placeholder="Correo" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="rf"> RFC </label>
                    <input type="text" id="rf" placeholder="Rfc" class="form-control"/>
                </div>

                <div class="form-group" id="sec">
                    <label for="fech"> FECHA </label>
                    <input type="text" id="fech" placeholder="Fecha" class="form-control"/>
                </div>

                <div class="form-group">
                  <img id="imgn" width="100px" alt="SIN IMAGEN">
                </div>

              <br>        

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Actualizar</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->
</div>
</body>
</html>