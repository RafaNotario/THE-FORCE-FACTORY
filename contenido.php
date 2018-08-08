  <!DOCTYPE html>

  <html lang="es">
  <head>

  <title> Ventana de altas </title>

  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
  </script>

    <script type="text/javascript">
      $(document).ready(function(){
        console.log("Esta listo");
        altaClientes();
      });

    function altaClientes(){
    //  toastr.success('Alta de Clientes.', 'Opcion 1', {timeOut: 1500});
      $("#conten").load("contenidoAltas/altaClientes.php");
    }

    function altaAntenas(){
    //  toastr.success('Alta de Comidas.', 'Opcion 2', {timeOut: 1500});
      $("#conten").load("contenidoAltas/altaAntenas.php");
    }

  </script>

  <style type="text/css">
    *{
      margin: 0;/* Espacio entre los elementos*/
      padding: 0;/* Espacio entre los contenidosy los margenes de su caja*/
      box-sizing: border-box;
    }

    .tam{
      font-size: 1.5em;
      background: #9FF3D6; /*#8C5734*/
      color: #9FF3D6;/*#9FF3D6 #FFFFFF*/
    }

</style>
  </head>
  <body>

<div class="container">
  <div class="row">
    <div class="col-xs-11 col-md-3">
      <input type="radio" id="opc1" name="gender" value="male" onclick="altaClientes();">
      <label for="opc1"> Alta de clientes </label>
    </div>
   

    <div class="col-xs-12 col-md-5">
      <input type="radio" id="opc2" name="gender" value="female" onclick="altaAntenas();"> 
      <label for="opc2">Ingrese los datos del instructor. </label>
    </div>

</div>

  <div id="conten"> </div>
  
  </body>
  </html>
