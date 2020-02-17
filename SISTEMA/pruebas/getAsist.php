
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

<body>
<?php

include("../Modales/prueba1.php");

$var = "";
if(isset($_POST['param']) && isset($_POST['param']) != "")
{

$var = $_POST['param'];

}else{
  $responseP['status'] = 200;
  $responseP['message'] = "Invalid Request!";
  }

$sql = "SELECT * FROM asistencias WHERE id_cli = '".$var."' ORDER BY fecha DESC";

if (!$result = $mysqli->query($sql)) {
        exit(mysqli_error($mysqli));
    }
    echo $result;
?>

<br>

<h3>Lista de asistencias. </h3>
<br>

<table class="table table-hover table-condensed table-striped">
  <thead class="thead-dark">
    <tr>
      <th>#</th>
      <th>ID_ASIST</th>
      <th>ID_CLI</th>
      <th>FECHA</th>
    </tr>
</thead> 
<?php
  $i =1;
while($row = mysqli_fetch_array($result)) {
?>
  <tr>
    <td> <?php echo $i++ ; ?></td>
    <td class="numero"> <?php echo  $row['id_asist']; ?> </td>
    <td> <?php echo $row['id_cli']; ?></td>
    <td> <?php echo $row['fecha']; ?> </td>
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
                  <label for="id_asist"> Id. Asistencia: </label>
                  <input type="text" name="id_asist" id="id_asist" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="id_cli">Id. Cliente: </label>
                    <input type="text" name="id_cli" id="id_cli" placeholder="Id_cliente" class="form-control" readonly>
                </div>

                <div class="form-group" id="sec">
                    <label for="fech"> Fecha:  </label>
                    <input type="date" name="fech" id="fech" placeholder="Fecha" class="form-control" value="<?php 
            date_default_timezone_set("America/Mexico_City");
            echo date('Y-m-d'); ?>" >
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

<span id="res"></span>
</body>

    <script type="text/javascript">

      $(".botonVer").click(function() {
//        console.log("1");

        var valores = "";
        // Obtenemos todos los valores contenidos en los <td> de la fila
        // seleccionada
        $(this).parents("tr").find(".numero").each(function() {
          valores += $(this).html() + "\n";
        });

//CODIGO NUEVO
        $.post("Modales/asistencLL.php",{param:valores},

            function(data,status){

              var user = JSON.parse(data);

              $("#id_asist").val(user.id_asist);//update_first_name
              $("#id_cli").val(user.id_cli);//update_last_name
              $("#fech").val(user.fecha);//update_email
            });

            $("#update_user_modal").modal("show");
      });

    function UpdateUserDetails() {
      var formData = new FormData(document.getElementById("enviaDatos2"));
 /*     param1 = $("#id_cli").val();
      console.log("oprimido"+param1);
*/
    $.ajax({
      url: "../Modales/actualizaAsist.php",
      type: "POST",
      datatype: "HTML",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    }).done(function(data,status){
     // $("#resultadoBusqueda").html("LEEGO:"+data+"<br>"+status); 
        
        if (data === "1" ) {
          $('#res').html("Datos actualizados correctamente.");
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