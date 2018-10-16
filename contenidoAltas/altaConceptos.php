
  <style type="text/css">

    #GContent{
      margin-top: 2em;
    }

  </style>

<html>
 <div id="GContent" class="container">
    
      <div class="col-md-6 col-md-offset-3 col-sm-8">
        <form name="nuevo_contrato" method="post">
          <fieldset>
            <legend> Ingrese características del plan. </legend>


          <br>

          <div class="form-group">
            <label for="nomCon"> Nombre/Identificador del plan: </label>
            <input type="text" name="nomCon" id="nomCon" placeholder="Identificador" class="form-control">
          </div>
          <br>

          <div class="form-group">
            <label for="descri"> Descripcion: </label>
            <input type="text" name="descri" id="descri" placeholder="Descripcion del " class="form-control">
          </div>            
          <br>

          <div class="form-group">
            <label for="prec"> Costo $: </label>
            <input type="text" name="prec" id="prec" placeholder="Costo del paquete" class="form-control">
          </div>
          <br>

          <div class="form-group">
            <input type="button" name="altaContr" id="altaContr" value="Enviar" class="btn btn-success">
          </div>

          </fieldset>
        </form>
      </div>
   
  </div>

    <button type="button" class="btn btn-info btn-lg" id="myBtnP">Open Modal</button>

    <span id="res"></span>
  <div id="resultadoBusqueda"></div>

</html>

   <script type="text/javascript">

    $('#altaContr').click(function(){

          if ($('#nomCon').val()=="") {
            alert("Ingrese nombre del plan");
            return false;
          }else{
            var nomCon = $('#nomCon').val();
          }

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

          jQuery.post("api/altas.php",{
            nomConc:nomCon,
            descriP:descrip,
            costoP:costo,
            funcion:"funcion1"
          }, function(data, textStatus){
              console.log(data);

            if(data == 1){
              $('#res').html("Datos insertados.");
              $('#res').css('color','green');
//              LimpiarCampos();
              toastr.success(' (y)', 'DATOS INSERTADOS', {timeOut: 5000})
              
              //$("#resultadoBusqueda").load("pruebas/getPaquetes.php");
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