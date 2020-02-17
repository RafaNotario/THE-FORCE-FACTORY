
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- PRUEBAS TOAST  -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
    </script>

<style type="text/css">  
  .flotForm{
  display: inline-block;
  vertical-align: top;
 }
label{
  font-size: 1.8rem;
  font-family: 'Oswald', serif;
}
input#busq{
  text-transform: uppercase;
} 
div.#frm-muestra{
  text-align: center;
}
div.info-consulta{
  width: 100vw;
  margin-top: 20px;
  margin-bottom: 25px;
}
table {
    width: 100%;
    border-collapse: collapse;
}
th {
    text-align: left;
}
@media only screen and (max-width: 768px) {
    .flotForm{
        width: 95%;
        margin: 0 auto;
    }
    .ajust{
    margin: 0 auto;
    width: 70%;
    padding-bottom: 20px;
    padding-top: 0px;
  }
}
div#busqueda{
  position: relative;
  width: 90%;
}
span#resulatdo{
  position: absolute;
  width: 30%;
}
#res{
  display: block;
}
.cor{
  background-color: rgba(3,165,150,0.5);
  border-radius: 25px;
  text-align: center;
  padding: 7px; 
  margin: 7px;
  font-size: 1.1em;
  transition: all .3s ease;
  cursor: pointer;
}
.cor:hover{
  background-color: #fe4918;
  color: white;
}
.busqueda{
  display: block;
  float: left;
  margin: 10px;
}
</style>

<html>
    <br>
<!-- ~~~CODIGO NUEVOO -->    
      <form accept-charset="utf-8" class="form-horizontal" role="form">
       <fieldset>
         <legend> REGISTRE LA ASISTENCIA DEL DIA. </legend>  
          <div class="form-row" id="busqueda">          
            <div class="form-group col-md-5">
              <label for="busq" class="col-md-6 control-label">Buscar Cliente: </label>
              <input id="busq" list="json-datalist" class="input_list form-control" autocomplete="off">
              <datalist id="json-datalist"></datalist>
              <button class="busqueda info btn btn-info" onclick="setTimeout(cargainfo ,2000);" id="busqued">Busca</button>

            </div>       
            <div class="form-group col-md-3">
              <span id="resultado">
                <p align='center'><img width='50px' src='../SISTEMA/img/wait.gif' /></p>
              </span> 
            </div>
          </div>
          </fieldset>
      </form> 
<br>
<div class = "info-consulta">
 <form role="form" accept-charset="utf-8" id="enviaDatosAsist" method="post">
  
  <div class="form-row">
    <div class="form-group col-md-4 estatus">
      <h4> Status: <span id="statu"> ACTIVO </span> </h4>      
    </div>
    
    <div class="form-group col-md-4 vigencia">
      <h4>Vigencia al: <span id="fechP"> <?php 
      date_default_timezone_set("America/Mexico_City");
      echo date('Y-m-d'); ?> </span></h4>
    </div>

    <div class="form-group col-md-4 estatus">
      <h4> No. Contrato: <span id="contN"> ACTIVO </span> </h4>      
    </div>
  </div>

    <div class="form-group col-md-3 col-sm-3 ajust">
      <img id="imgn2" alt="USUARIO" src="img/Mp.jpg" width="200px">
    </div>

<div class="flotForm col-sm-9 col-md-7 col-xs-5 col-lg-4">

  <input type="text" name="idOcul" id="idOcul" class="hide">

 <div class="form-row">
  <div class="form-group col-md-7">
    <label for="nmb">Nombre: </label>
    <input type="text" class="form-control" id="nmb" name="titulo" readonly>
  </div>

    <div class="form-group col-md-5">
      <label for="nick">Nick Name </label>
      <input type="text" class="form-control" id="nick" name="nick" readonly>
    </div>
</div>

  <div class="form-group col-md-12">
    <label for="direcc">Direccion </label>
    <input type="text" class="form-control" id="direcc" name="direcc" readonly>
  </div>

    <div class="form-group col-md-6">
      <label for="fechReg">Fecha de Registro.</label>
      <input type="text" class="form-control" id="fechReg" name="fechReg" readonly>
    </div>

    <div class="form-group col-md-6">
      <label for="fechProxM">Fecha dia: </label>
      <input type="date" class="form-control" id="fechProxM" name="fechProxM" value="<?php 
      date_default_timezone_set("America/Mexico_City");
      echo date('Y-m-d'); ?>">
    </div>

    <button type="submit" class="btn btn-success" id="boton"> ENVIAR </button><!--onclick="guardaCont();" -->

  <span id="res">
  </span>

    <table id="tabla" class="table table-hover table-condensed table-striped">
    </table>

</div>

</form>

</div><!-- .info-consulta -->

</html>

<script type="text/javascript">

  var contador = 0;
       
        $(".info-consulta").hide();

        var obt;

        var dataList = document.getElementById('json-datalist');
       
        var peticion2 = new Array(7);/*variable para consulta con PROMISE*/
        var param3 = null; //variables para comparar vigencia
        var compar = null;

        $('#busq').focus();

        $('#busq').on('input',function(){//tenia keyup()   
          buscar();
        });

$('#enviaDatosAsist').on("submit",function(e){

  e.preventDefault();

      var idcont = $("#idOcul").val();
      var fechAsist = $("#fechProxM").val();

          jQuery.post("api/altas.php",{
            idcontr:idcont,
            fpm:fechAsist,
            funcion:"funcionAsist"
          }, function(data, textStatus){
            if(data != 0){
              toastr.success('Correctamente', 'ASISTENCIA GUARDADA', {timeOut: 5000});
              $('#res').html("Asistencia insertada correctamente");
              $('#res').css('color','green');

  /*CREAR TABLA DE ASISTENCIAS*/
              var d = '<thead class='+'thead-dark'+'>'+
                '<tr>'+
                '<th>Id_Asistencia</th>'+
                '<th>Id_Cliente</th>'+
                '<th> Fecha </th>'+
                '</tr>'+
                '</thead>';

      $.get('pruebas/getJSONasistencia.php',{param:idcont}, function(data) {
        var datos = JSON.parse(data);
              $("#tabla tr").remove(); 

        for (var i = 0; i < datos.length; i++) {
         d+= '<tr>'+
         '<td>'+datos[i].id_asist+'</td>'+
         '<td>'+datos[i].id_cli+'</td>'+
         '<td>'+datos[i].fecha+'</td>'+
         '</tr>';
         }

        $("#tabla").append(d);
    }); // close getJSON() 
             

              }else{
              toastr.error('ERROR','No se realizo el guardado', {timeOut: 5000});
              $('#res').html("Ha ocurrido un error.");
              $('#res').css('color','red');
            }
          });
$('#busq').val("");
$('#busq').focus();
$("#tabla tr").remove(); 

});

function buscar(){
    var term = $("#busq").val();

            $.ajax({
              url : "pruebas/busqkeyUpAsist.php",
              type : "GET",
              dataType : "HTML",
              data : {param:term},
              cache : false,
              contentType : false,
            beforeSend: function(){
                  $('#resultado').show();
                    },
            success : function(data,status){
                  $("#json-datalist").empty();//datalist convertido a objeto jquery
            
            var obt = JSON.parse(data);//parseo de JSON a objeto JS

      for (var i = obt.length - 1; i >= 0; i--) {
        if(obt[i]['nombre'].replace(/ /g,"")+obt[i]['apellidos'].replace(/ /g,"") != term.replace(/ /g,"")){

                var option = document.createElement('option');              
                option.value = obt[i]['nombre']+" "+obt[i]['apellidos'];
                dataList.appendChild(option);
              }
        }
            
            if (obt.length === Number(1)) {
              peticion2[0] = obt[0].id_cli;
              peticion2[1] = obt[0].nombre;
              peticion2[2] = obt[0].apellidos;
              peticion2[3] = obt[0].nick;
              peticion2[4] = obt[0].direccion;
              peticion2[5] = obt[0].id_contrato;
              peticion2[6] = obt[0].fechaInicio;

              $.post("api/altas.php",{funcion:"getfech",param2:peticion2[5]},function(data,status){
                $("#fechP").html(data);
                compar = data;
              });
              $("#tabla tr").remove();


            }//if length    
            },
            error : function(xhr,status){
              alert('Ha ocurrido un error ln -297');
            },
            complete: function(xhr,status){
            $(".info-consulta").hide();
            
           
            }

          });     
}//function buscar()


function cargainfo(){

  var cad = $("#busq").val();

  if (cad.length > Number(0)) {

  $.post("Modales/returnFoto.php",{param:peticion2[0]},function(data,status){       // console.log("post2 "+status);
    var user = JSON.parse(data);
    $("#imgn2").attr("src", "data:image/png;base64,"+user.foto);
  });

  var compar2 = $("#fechProxM").val();

    $("#idOcul").val(peticion2[0]);
    $("#nmb").val(peticion2[1]+" "+peticion2[2]);
    $("#nick").val(peticion2[3]);
    $("#direcc").val(peticion2[4]);
    $("#fechReg").val(peticion2[6]);
    $("#contN").html(peticion2[5]);
    $('#res').html("");
    $(".info-consulta").show();
    $('#resultado').hide();
    

    compara(compar,compar2);

      /*CREAR TABLA DE ASISTENCIAS*/
              var d = '<thead class='+'thead-dark'+'>'+
                '<tr>'+
                '<th>Id_Asistencia</th>'+
                '<th>Id_Cliente</th>'+
                '<th> Fecha </th>'+
                '</tr>'+
                '</thead>';

      $.get('pruebas/getJSONasistencia.php',{param:peticion2[0]}, function(data) {
        var datos = JSON.parse(data);
              $("#tabla tr").remove(); 

        for (var i = 0; i < datos.length; i++) {
         d+= '<tr>'+
         '<td>'+datos[i].id_asist+'</td>'+
         '<td>'+datos[i].id_cli+'</td>'+
         '<td>'+datos[i].fecha+'</td>'+
         '</tr>';
         }

        $("#tabla").append(d);
   }); // close getJSON() 
  }else{
    toastr.error('ERROR','Campo de busqueda vacio', {timeOut: 5000})
  }
}//cargainfo()

function compara(compar,compar2){
  if (compar != null){

    if( (new Date(compar).getTime() >= new Date(compar2).getTime()))
    {
      $("#statu").html("ACTIVO");
      document.getElementById("boton").disabled = false;
    }else{
      document.getElementById("boton").disabled = true;
      $("#statu").html("VENCIDO");
      $('#res').html("Ir a MENU>> <a href="+"#"+"> MENSUALIDAD </a>");
    }
  }//compar != null

}
</script>

