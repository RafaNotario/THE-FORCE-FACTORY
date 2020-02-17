<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- PRUEBAS TOAST  -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
    </script>

<style type="text/css">
  
  .flotForm{
  display: inline-block;
  vertical-align: top;
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
  background-color:black;

}

@media only screen and (max-width: 600px) {
    .flotForm{
        background-color: lightblue;
        width: 100%;
    }

    .ajust{
    margin: 0 auto;
    width: 70%;
    padding-bottom: 20px;
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
  border-radius: 5px;
  text-align: center;
  padding: 7px; 
  margin: 7px;
  font-size: 1.1em;
}
</style>

<html>
    <br>
<!-- ~~~CODIGO NUEVOO -->    
      <form accept-charset="utf-8" class="form-horizontal" role="form" id="datos_cotizacion">
       <fieldset>
         <legend> Nuevo contrato. </legend>  
        <div class="form-row" id="busqueda">          
          <div class="form-group col-md-8">
            <label for="busq" class="col-md-2 control-label">Buscar: </label>
            <input id="busq" list="json-datalist" class="input_list form-control" autocomplete="off">
            <datalist id="json-datalist"></datalist>
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
 <form action="../SISTEMA/report/report1.php">
    <div class="form-group col-md-3 col-sm-3 ajust">
      <img class="img-responsive img-circle" id="imgn2" alt="USUARIO" src="img/Mp.jpg" width="200px">
    </div>
<div class="flotForm col-sm-9 col-md-7 col-xs-5 col-lg-4">

  <input type="text" name="idOcul" id="idOcul" class="hide">

  <div class="form-group">
    <label for="nmb">Nombre: </label>
    <input type="text" class="form-control" id="nmb" name="titulo">
  </div>

  <div class="form-row">

    <div class="form-group">
    <label for="nick">Nick Name </label>
    <input type="text" class="form-control" id="nick" name="nick">
  </div>

  <div class="form-group">
    <label for="direcc">Direccion </label>
    <input type="text" class="form-control" id="direcc" name="direcc">
  </div>

  <div class="form-group">
    <label for="mail">Correo </label>
    <input type="text" class="form-control" id="mail" name="mail">
  </div>

</div>


 <div class="form-row">

    <div class="form-group col-md-6">
      <label for="fech">Fecha Inscripcion</label>
      <input type="date" class="form-control" id="fech" value="<?php 
      date_default_timezone_set("America/Mexico_City");
      echo date('Y-m-d'); ?>">
    </div>

    <div class="form-group col-md-4">
      <label for="concepto">Concepto/Paquete.</label>
      <select name="concepto" id="concepto" class="form-control">PLANES</select>
    </div>

  </div>

  <div class="form-row">
    <div class="form-group col-md-8">
      <label for="descriP">Descripcion:</label>
      <input type="text" class="form-control" id="descriP" name="descriP">
    </div>

    <div class="form-group col-md-4">
      <label for="costP">Costo:</label>
      <input type="text" class="form-control" id="costP" name="costP">
    </div>
<!-- 
  input oculto para enviar los otros datos del reporte contrato
--> 
  <input type="text" name="vari2" id="vari2" class="hide">

  </div>

 <div class="form-row col-md-7">

    <div class="form-check cor">
      <input class="pay form-check-input" type="checkbox" id="pagoCheck" name="pagoCheck" value="pagado">
      <label class="form-check-label" for="pagoCheck">
        Pagado
      </label>
    </div>

    <div class="form-check cor">
      <input class="form-check-input email" type="checkbox" id="mailCheck" value="siEnvia">
      <label class="form-check-label" for="mailCheck">
        Enviar por correo.
      </label>
    </div>

      <button type="submit" class="btn btn-primary" formmethod="post" formtarget="_blank" name="  contrato" onclick="guardaCont();">GUARDAR
      </button><!--onclick="guardaCont();" -->
  </div>

  <span id="res"></span>
</div>

</form>

</div><!-- .info-consulta -->

</html>

<script type="text/javascript">

        window.onload =$(".info-consulta").hide();
        var obt;
//funcion de evento de select
        $(document).ready(function(){
          cargaConcepto();

          var select = document.getElementById('concepto');
          select.addEventListener('click',function(){
            var selectedOption = this.options[select.selectedIndex];
            //console.log(selectedOption.value +': ' + selectedOption.text+': '+selectedOption.getAttribute("data-costo")+': '+selectedOption.getAttribute("data-descripcion"));
            $('#descriP').val(selectedOption.getAttribute("data-descripcion"));
            $('#costP').val(selectedOption.getAttribute("data-costo"));
            $("#vari2").val(selectedOption.getAttribute("data-vlue"));
          });
        });

        var dataList = document.getElementById('json-datalist');
       
        var peticion2 = null;/*variable para consulta con PROMISE*/
        $('#busq').focus();

        $('#busq').on('input',function(tecla){//tenia keyup()

        var Chcode = Number(tecla.which);
        var term = $("#busq").val();

       // alert(Chcode);
/*Chequeamos que solo ingrese letras y enter para realizar la consulta*/
//        if( (Number(Chcode) > 64) && (Number(Chcode) < 91) || (Number(Chcode) === 13))// 
  //      {
          var promise = $.ajax({
            url : "pruebas/busqkeyUp.php",
            type : "GET",
            dataType : "HTML",
            data : {param:term},
            cache : false,
            contentType : false,
            beforeSend: function(){
                          //imagen de carga
                        $('#resultado').show();
                    },
            success : function(data,status){
              $("#json-datalist").empty();//datalist convertido a objeto jquery
            
            var obt = JSON.parse(data);//parseo de JSON a objeto JS

            console.log("objeto obt:"+obt);
            //ciclo para recorrer el arreglo
            for (var i = obt.length - 1; i >= 0; i--) {
              var option = document.createElement('option');              
              option.value = obt[i]['nombre']+" "+obt[i]['apellidos'];
              dataList.appendChild(option);
            }

          //  $("#resultado").html(data);

            if (obt.length === 1 ) {
              peticion2 = obt[0].id_cli;
              $("#idOcul").val(obt[0].id_cli);
              $("#nmb").val(obt[0].nombre+" "+obt[0].apellidos);
              $("#nick").val(obt[0].nick);
              $("#mail").val(obt[0].correo);
              $("#direcc").val(obt[0].direccion);

              $(".info-consulta").show();
            }
            },
            error : function(xhr,status){
              alert('Ha ocurrido un error ln -261');
            },
            complete: function(xhr,status){            
            }
          });//

          promise.then(function(){
            if (peticion2 != null) {
              $.post("Modales/formularioLL.php",{param:peticion2},function(data,status){        
                    var user = JSON.parse(data);
                    $("#imgn2").attr("src", "data:image/png;base64,"+user.foto);
              });
            }
              $('#resultado').hide();
          });
});

    function cargaConcepto(){
       $.get('JSON_PRUE/carga-select.php', function(data) {
      obt = JSON.parse(data);
    //  console.log(data);

    for (var i = obt.length - 1; i >= 0; i--) {
      $("#concepto").append('<option value="'+obt[i]['id_concepto']+'" data-costo="'+obt[i]['costo']+'" data-vlue="'+obt[i]['nombreConc']+'" data-descripcion="'+obt[i]['descripcion']+'">'+obt[i]['nombreConc']+'</option>');   
    }

    }); // close getJSON()
    }


    function guardaCont(){
      var idclient = $("#idOcul").val();
      var idoption = $("#concepto").val();
      var fechcont = $("#fech").val();
      var mesI = convertDateFormat(fechcont);
      var pay = "";
      var cor="";

      if ( $('.pay').prop('checked') ) {
        pay="PAGADO";
      }else{       
        pay="PENDIENTE";
      }

      if ( $('.email').prop('checked') ) {
        cor = $('#mailCheck').val();
      }else{       
        cor="0";
      }

          jQuery.post("api/altas.php",{
            idcli:idclient,
            idopt:idoption,
            fechc:fechcont,
            mesin:mesI,
            pag:pay,

            funcion:"funcion2"
          }, function(data, textStatus){
            if(data != 0){
              $('#res').html("Contrato No. "+data+" insertado correctamente");
              $('#res').css('color','green');
              toastr.success('Correctamente', 'CONTRATO GUARDADO', {timeOut: 5000});
              //$("#resultadoBusqueda").load("pruebas/getPaquetes.php");
            }
            else{
              toastr.error('ERROR','No se realizo el guardado', {timeOut: 5000})
              $('#res').html("Ha ocurrido un error.");
              $('#res').css('color','red');
            }
          });
    }

/*poner eventos
  1. hacer funcion la busqueda para usarla en cada evento
  2. aplicar toUppercase() para buscar solo mayusculas
    LAP, ESCRITORIO
  3. .click() para hacer la busqueda con el raton
    MOVIL, TABLET,CEL
  4. .bind()
*/

function convertDateFormat(string) {
  var info = string.split('-');
  var mes = "";

  switch(info[1]){
    case "01":
      mes = "Enero";
    break;
    case "02":
      mes = "Febrero";
    break;
    case "03":
      mes = "Marzo";
    break;
    case "04":
      mes = "Abril";
    break;
    case "05":
      mes = "Mayo";
    break;
    case "06":
      mes = "Junio";
    break;
    case "07":
      mes = "Julio";
    break;
    case "08":
      mes = "Agosto";
    break;
    case "09":
      mes = "Septiembre";
    break;
    case "10":
      mes = "Octubre";
    break;
    case "11":
      mes = "Noviembre";
    break;
    case "12":
      mes = "Diciembre";
    break;

    default:
    mes="ERROR DE FECHA";
}
  return mes;
}
</script>

