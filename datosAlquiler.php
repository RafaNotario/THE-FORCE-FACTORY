  <!DOCTYPE html>
  <html lang="es">
  <head>
    <title> Ventana de altas </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>-->

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">

    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $.ajax({
          type: "POST",
          url: "pruebas/getCuartos.php",
          success: function(response)
          {
            $('.selector-pais select').html(response).fadeIn();
          }
        });
          console.log("Esta listo");
      });

//EVENTO DEL BOTON GUARDAR
      $("#altaComid").click(function(){
        toastr.success("alerta de exito", "Exito de boton", {timeOut: 2500})
      });
    
  </script>
  </head>

  <body>
    <h3>Elija el tipo de alquiler e ingrese los datos para posteriormente emitir el recibo. </h3> <br>

    <div class="container">
      <div class="row">
          <div class="col-md-6 col-md-offset-3">

          <form method="post">
          <br>
              <div class="form-group">
                <label for="idComida"> Recibi de:</label>
                <input type="text" name="idComida" id="idComida" placeholder="Id Comida" class="form-control"> 
              </div>
          <br>
              <div class="form-group">
                <label for="nom"> La cantidad: </label>
                <input type="text" name="nom" id="nom" placeholder="Nombre" class="form-control">       
              </div>
          <br>
              <div class="form-group">
                <label for="descri"> Concepto: </label>
                <input type="text" name="descri" id="descri" placeholder="Descripcion" class="form-control">
              </div>            
          <br>

              <label class="radio-inline col-xs-6 col-md-4">
                <input type="radio" name="optradio">Option 1
              </label>
              
              <label class="radio-inline col-xs-6 col-md-4">
                <input type="radio" name="optradio">Option 2
              </label>            

          <br>
              <div class="form-group">
                <label for="autorizo"> Autorizo: </label>
                <input type="text" name="autorizo" id="autorizo" placeholder="Autorizo:" class="form-control">
              </div>            
          <br>

              <div class="form-group">
                <input type="button" name="altaComid" id="altaComid" value="Enviar" class="btn btn-success" >
              </div>
        </form>
      </div>
    </div>
  </div>


      <div class="row">
        <div class="col-xs-6 col-md-4">.col-xs-12 .col-md-8</div>
        <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
      </div>

    <div class="radio">
      <label>
        <input type="radio" id="opc1" name="gender" value="pDia" checked>
          Por día
      </label>
    </div>

    <div class="radio">
      <label>
        <input type="radio" id="opc2" name="gender"  value="pMes"> 
          Por mes 
      </label>
    </div>
    
    <div class="selector-pais col-md-4">
      Elige un país
      <select class="form-control "></select>
    </div>
  </body>
  </html>