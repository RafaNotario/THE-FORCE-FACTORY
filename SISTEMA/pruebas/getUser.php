<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>

table {
    width: 100%;
    border-collapse: collapse;
}
th {
    text-align: left;
  }
</style>
</head>

<body>
<?php
include("../Modales/prueba1.php");
//$sql2="SELECT * FROM cliente";

$sql = "SELECT a.id_cli,a.nombre,a.apellidos,a.direccion,b.id_contrato,c.id_contrato,c.fecha_pago,c.fecha_proxPagoM
        FROM cliente a
        INNER JOIN contrato b
        INNER JOIN pagos c
        ON a.id_cli = b.id_cli
        AND b.id_contrato = c.id_contrato
        ORDER BY c.id_pago DESC
        ";

if (!$result = $mysqli->query($sql)) {
        exit(mysqli_error($mysqli));
    }
?>

<table class="table table-hover table-condensed table-striped">
  <thead class="thead-dark">
    <tr>
    <th>#</th>
    <th>ID</th>
    <th>NOMBRE</th>
    <th>APELLIDOS</th>
    <th>DIRECCION</th>
    <th>ULTIMO</th>
    <th>PROXIMO</th>
    </tr>
</thead> 
<?php
  $i =1;
while($row = mysqli_fetch_array($result)) {
?>
  <tr>
    <td> <?php echo $i++ ; ?></td>
    <td class="numero"> <?php echo  $row['id_cli']; ?> </td>
    <td> <?php echo $row['nombre']; ?> </td>
    <td> <?php echo $row['apellidos']; ?></td>
    <td> <?php echo $row['direccion']; ?></td>
    <td> <?php echo $row['fecha_pago']; ?></td>
    <td> <?php echo $row['fecha_proxPagoM']; ?></td>
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
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Datos del cliente</h4>
            </div>
<form accept-charset="utf-8" name="enviaDatos2" id="enviaDatos2" method="post" enctype="multipart/form-data">

            <div class="modal-body">
    
                <div class="form-group">
                  <img id="imgn" width="100px" alt="SIN IMAGEN">
                </div>

                <div class="form-group">
                    <label for="id_cli">Id cliente</label>
                    <input type="text" name="id_cli" id="id_cli" placeholder="Id_cliente" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="nomb">Nombre(s)</label>
                    <input type="text" name="nomb" id="nomb" placeholder="Nombre" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="aps">Apellido(s)</label>
                    <input type="text" name="aps" id="aps" placeholder="Apellidos" class="form-control"/>
                </div>

                <div class="form-group">
                  <label for="nck"> NickName </label>
                  <input type="text" name="nck" id="nck" placeholder="NickName" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="direc"> Direccion </label>
                    <input type="text" name="direc" id="direc" placeholder="Direccion" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="tel"> Telefono/Celular </label>
                    <input type="text" name="tel" id="tel" placeholder="Telefono" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="correo"> Correo </label>
                    <input type="text" name="correo" id="correo" placeholder="Correo" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="rf"> RFC </label>
                    <input type="text" name="rf" id="rf" placeholder="Rfc" class="form-control"/>
                </div>

                <div class="form-group" id="sec">
                    <label for="fech"> FECHA </label>
                    <input type="text" name="fech" id="fech" placeholder="Fecha" class="form-control"/>
                </div>

<!-- NUEVA IMAGEN-->
              <div class="form-group">
                <label for="fot"> NUEVA IMAGEN:</label>
                <input type="file" name="fot" id="fot" class="btn-info">
              </div>

              <br>        
            </div> <!-- modal-body -->

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

              <button type="button" data-backdrop="false" class="btn btn-primary"   onclick="UpdateUserDetails();" > Actualizar </button>
              <input type="hidden" id="hidden_user_id">
            </div>
      </form>
        </div><!-- modal-content -->
    </div>
</div>
<!-- // Modal -->
</div>
</body>

    <script type="text/javascript">

      $(".botonVer").click(function() {
        console.log("1");

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

        console.log("getUser"+status);
      });

    function UpdateUserDetails() {
      var formData = new FormData(document.getElementById("enviaDatos2"));
 /*     param1 = $("#id_cli").val();
      console.log("oprimido"+param1);
*/
    $.ajax({
      url: "Modales/actualizaCli.php",
      type: "POST",
      datatype: "HTML",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    }).done(function(data,status){
     // $("#resultadoBusqueda").html("LEEGO:"+data+"<br>"+status); 
        
        if (data != "1" ) {
          toastr.success(' (y)', 'DATOS INSERTADOS', {timeOut: 5000});
         
        }else{
          $('#res').html("Ha ocurrido un error.");
          $('#res').css('color','red');
        }

        $("#update_user_modal").modal("hide");

//codigo por que el modal-backdrop se quedaba fijo
        if ($('.modal-backdrop').is(':visible')) {
          $('body').removeClass('modal-open'); 
          $('.modal-backdrop').remove(); 
        };

    });
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

</html>