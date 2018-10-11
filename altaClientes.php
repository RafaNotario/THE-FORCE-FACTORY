<!DOCTYPE html>
<html>
<head>
  <title>Clientes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript">

    $('#login').click(function(){
          
          if($('#nom').val()==""){
            alert("Introduce el nombre");
            return false;
          }
          else{
            var nombre = $('#nom').val();
          }

          if($('#apes').val()==""){
            alert("Introduce los apellidos");
            return false;
          }
          else{
            var apes = $('#apes').val();
          }

          if($('#dir').val()==""){
            alert("Introduce la dirección");
            return false;
          }
          else{
            var dir = $('#dir').val();
          }          

          if($('#cel').val()==""){
            alert("Introduce número de celular");
            return false;
          }
          else{
            var cel = $('#cel').val();
          }

          if($('#mail').val()==""){
            var correo = "ejemplo@hotmail.com";
          }
          else{
            var correo = $('#mail').val();
          }

          if($('#rfc').val()==""){
            var rfc = "rfcprueba123";
          }
          else{
            var rfc = $('#rfc').val();
          }

          jQuery.post("api/create.php", {
            name:nombre,
            apes:apes,
            dir:dir,
            cel:cel,
            correo:correo,
            rfc:rfc
          }, function(data, textStatus){

          //    console.log(data);

            if(data == 1){
              $('#res').html("Datos insertados.");
              $('#res').css('color','green');
            //  LimpiarCampos();
              toastr.success(' (y)', 'DATOS INSERTADOS', {timeOut: 5000})
              $("#resultadoBusqueda").load("pruebas/getUser.php");
            }
            else{
              $('#res').html("Ha ocurrido un error.");
              $('#res').css('color','red');
            }
          });
        });
/*
    function LimpiarCampos(){
      document.nuevo_cliente.idCli.value="";
      document.nuevo_cliente.rfc.value="";
      document.nuevo_cliente.nom.value="";
      document.nuevo_cliente.apes.value="";
      document.nuevo_cliente.cel.value="";
      document.nuevo_cliente.mail.value="";
      document.nuevo_cliente.idCli.focus();
    }
*/
$("#myBtn").click(function(){
  $("#resultadoBusqueda").load("pruebas/getUser.php");
});

  function volteaFech(fech){
    var day = fech[0]+fech[1];
    var month = fech[3]+fech[4];
    var year= fech[6]+fech[7]+fech[8]+fech[9] ;
    
   return year+"-"+month+"-"+day;
}


</script>

  <style type="text/css">
    
  

    #GContent{
      margin-top: 2em;
    }

  </style>

</head>

<body>

  <p id="demo"></p>

    <div id="GContent" class="container">
      
      <div class="col-md-6 col-md-offset-3 col-sm-10">
        <form name="nuevo_cliente" method="post" enctype="multipart/form-data">
          <fieldset>
            <legend> Ingrese los datos del cliente. </legend>
        <br>
          <div class="form-group">
            <label for="nom"> Nombre(s):</label>
            <input type="text" name="nom" id="nom" placeholder="Nombre" class="form-control">      
          </div>

        <br>
          <div class="form-group">
            <label for="apes"> Apellidos :</label>
            <input type="text" name="apes" id="apes" placeholder="Apellidos" class="form-control">
          </div>            
        <br>
          <div class="form-group">
            <label for="dir"> Dirección:</label>
            <input type="text" name="dir" id="dir" placeholder="Ingrese la dirección del cliente" class="form-control">
          </div>
        <br>
          <div class="form-group">
            <label for="cel"> # Celular:</label>
            <input type="text" name="cel" id="cel" placeholder="Celular" class="form-control">
          </div>
        <br>
  
          <div class="form-group">
            <label for="mail"> Correo: </label>
            <input type="email" name="mail" id="mail" placeholder="Correo" class="form-control">
          </div>
        <br>
          <div class="form-group">
            <label for="rfc"> RFC:</label>
            <input type="text" name="rfc" id="rfc" placeholder="Ingrese RFC" class="form-control">
          </div>
        <br>

          <div class="form-group">
            <label for="img"> IMAGEN:</label>
            <input type="file" name="fot" id="fot">
          </div>
        
        <br>        
          
          <div class="form-group">
            <input type="button" name="login" id="login" value="Enviar" class="btn btn-success">
          </div>


            </fieldset>
        </form>
      </div>
  </div>

  <button type="button" class="btn btn-info btn-lg" id="myBtn">Ver Lista</button>

  <span id="res"></span>
    
  <div id="resultadoBusqueda"></div>
  
</body>
</html>





