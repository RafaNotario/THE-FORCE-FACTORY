<!DOCTYPE html>
<html>
<head>
	<title>Comidas</title>

   <script type="text/javascript">

    $('#altaInternet').click(function(){

          if($('#descri').val()==""){
            alert("Ingrese descripcion");
            return false;
          }
          else{
            var descrip = $('#descri').val();
          }

          if($('#prec').val()==""){
            alert("Introduce el costo del paquete");
            return false;
          }
          else{
            var costo = $('#prec').val();
          }

          jQuery.post("api/createPlan.php",{
            descriP:descrip,
            costoP:costo
          }, function(data, textStatus){
              console.log(data);

            if(data == 1){
              $('#res').html("Datos insertados.");
              $('#res').css('color','green');
//              LimpiarCampos();
              toastr.success(' (y)', 'DATOS INSERTADOS', {timeOut: 5000})

              $("#resultadoBusqueda").load("pruebas/getPaquetes.php");

            }
            else{
              $('#res').html("Ha ocurrido un error.");
              $('#res').css('color','red');
//              LimpiarCampos();
            }
          });
        });

$("#myBtnP").click(function(){
  $("#resultadoBusqueda").load("pruebas/getPaquetes.php");
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
    
      <div class="col-md-6 col-md-offset-3 col-sm-8">
        <form name="nuevo_cuarto" method="post">
          <fieldset>
            <legend> Ingrese características del paquete de internet </legend>


          <br>

          <div class="form-group">
            <label for="descri"> Descripcion: </label>
            <input type="text" name="descri" id="descri" placeholder="Descripcion del paquete" class="form-control">
          </div>            
          <br>

          <div class="form-group">
            <label for="prec"> Costo $: </label>
            <input type="text" name="prec" id="prec" placeholder="Costo del paquete" class="form-control">
          </div>
          <br>

          <div class="form-group">
            <input type="button" name="altaInternet" id="altaInternet" value="Enviar" class="btn btn-success">
          </div>

          </fieldset>
        </form>
      </div>
   
  </div>

    <button type="button" class="btn btn-info btn-lg" id="myBtnP">Open Modal</button>


    <span id="res"></span>
  <div id="resultadoBusqueda"></div>


</body>
</html>