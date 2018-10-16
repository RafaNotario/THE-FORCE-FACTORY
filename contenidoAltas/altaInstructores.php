<!DOCTYPE html>
<html>
<head>
	<title>Comidas</title>

    <script type="text/javascript">

    $('#altaInstr').click(function(){

          if($('#nomI').val()==""){
            var nomI = "00:00:00:00:00:00";
          }
          else{
            var nomI = $('#nomI').val();
          }


          if($('#ip').val()==""){
            var ip = "10.10.1.1";
          }
          else{
            var ip = $('#ip').val();
          }

          if($('#tipo').val()==""){
            alert("Introduce tipo de la antena");
            return false;
          }
          else{
            var tipo = $('#tipo').val();
          }

          jQuery.post("api/createInstrustor.php", {
            nombI:nomI,
            apesI:apeI,
            direccI:direcI,
            corrI:corI,
            fechainI:fechaiI,
            fechnacI:fechanaI
            
          }, function(data, textStatus){
              console.log(data);

            if(data == 1){
              $('#res').html("Datos insertados.");
              $('#res').css('color','green');
//              LimpiarCampos();

              toastr.success(' (y)', 'DATOS INSERTADOS', {timeOut: 5000})

              $("#resultadoBusqueda").load("pruebas/getAntenas.php");

            }
            else{
              $('#res').html("Ha ocurrido un error.");
              $('#res').css('color','red');
//              LimpiarCampos();
            }
          });
        });

/* 
    function LimpiarCampos(){
      document.nuevo_comida.idComida.value="";
      document.nuevo_comida.nom.value="";
      document.nuevo_comida.descri.value="";
      document.nuevo_comida.prec.value="";
      document.nuevo_comida.idComida.focus();
    }
*/

  $("#myBtnA").click(function(){
    $("#resultadoBusqueda").load("pruebas/getAntenas.php");
  });

  
  </script>

    <style type="text/css">

      #GContent{
        margin-top: 2em;
      }
    
    </style>

</head>
<body>

  <div id="GContent" class="container">

      <div class="col-md-6 col-md-offset-3 col-sm-9">
        <form name="nuevo_comida" method="post">
          <fieldset>
            <legend> Ingrese datos del instructor. </legend>

          <br>
          <div class="form-group">
            <label for="nomI"> Nombre(s): </label>
            <input type="text" name="nomI" id="nomI" placeholder="Nombre" class="form-control">       
          </div>
          <br>
          <div class="form-group">
            <label for="apeI"> Apellidos: </label>
            <input type="text" name="apeI" id="apeI" placeholder="Apellidos" class="form-control">
          </div>            
          <br>

          <div class="form-group">
            <label for="direcI"> Dirección: </label>
            <input type="text" name="direcI" id="direcI" placeholder="Dirección" class="form-control">
          </div>
          <br>
          
          <div class="form-group">
            <label for="corI"> Correo: </label>
            <input type="email" name="corI" id="corI" placeholder="Ingrese correo" class="form-control">
          </div>
          <br>

          <div class="form-group">
            <label for="fechaiI"> Fecha Inicio:</label>
            <input type="date" name="fechaiI" id="fechaiI" class="form-control">
          </div>
          <br>

          <div class="form-group">
            <label for="fechanaI"> Fecha de Nacimiento:</label>
            <input type="date" name="fechanaI" id="fechanaI" class="form-control">
          </div>
          <br>

          <div class="form-group">
            <input type="button" name="altaInstr" id="altaInstr" value="Enviar" class="btn btn-success">
          </div>

          </fieldset>
        </form>

      </div>
  </div>

  <button type="button" class="btn btn-info btn-lg" id="myBtnA">Ver Lista</button>

    <span id="res"></span>
    <div id="resultadoBusqueda"></div>

</body>
</html>