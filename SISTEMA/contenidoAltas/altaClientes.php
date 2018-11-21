
<!DOCTYPE html>

<html>
<head>

  <title>Clientes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- PRUEBAS TOAST  -->
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<!-- PRUEBAS TOAST  -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
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

        <form accept-charset="utf-8" id="enviaDatos" method="post"  enctype="multipart/form-data">
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
            <label for="nick"> NickName: </label>
            <input type="text" name="nick" id="nick" placeholder="Ingrese NickName" class="form-control">
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
            <label for="datepick"> Fecha de Inscripcion </label>
              <input type="date" name="datepick" id="datepick" value="<?php echo date('Y-m-d'); ?>" class="form-control">
          </div>
        <br>

          <div class="form-group">
            <label for="fot"> IMAGEN:</label>
            <input type="file" name="fot" id="fot" class="btn-info">
          </div>
        <br>        
          
          <div class="form-group">
            <button type="submit" class="btn btn-success"> ENVIAR </button>          
          </div>
          
            </fieldset>
        </form>
      </div>
  </div>

  <button type="button" class="btn btn-info btn-lg" id="myBtn">Ver todos</button>

    <span id="res"></span>
    
  <div id="resultadoBusqueda"></div>

  <script type="text/javascript">

  $('#enviaDatos').on("submit",function(e){
    e.preventDefault();

    var formData = new FormData(document.getElementById("enviaDatos"));

    console.log(formData);

    $.ajax({
      url: "api/create.php",
      type: "POST",
      datatype: "HTML",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    }).done(function(data){
      $("#resultadoBusqueda").html(data);
        if (data ==1 ) {
          toastr.success(' (y)', 'DATOS INSERTADOS', {timeOut: 5000});
        }else{
          $('#res').html("Ha ocurrido un error.");
          $('#res').css('color','red');
        }
    })
  });  

    function LimpiarCampos(){
      document.nuevo_cliente.idCli.value="";
      document.nuevo_cliente.rfc.value="";
      document.nuevo_cliente.nom.value="";
      document.nuevo_cliente.apes.value="";
      document.nuevo_cliente.cel.value="";
      document.nuevo_cliente.mail.value="";
      document.nuevo_cliente.idCli.focus();
    }

  $("#myBtn").click(function(){
    $("#resultadoBusqueda").load("pruebas/getUser.php");
  });

  function volteaFech(fech){

    var day = fech[0]+fech[1];
    var month = fech[3]+fech[4];
    var year= fech[6]+fech[7]+fech[8]+fech[9];
    
  return year+"-"+month+"-"+day;
}

</script>

</body>

</html>