
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


</style>

<html>
  
      <form>
        <fieldset>
          <legend> Nuevo contrato. </legend>  
          <h4>Busqueda por: </h4>

          <center>
            <div class="row">
              
              <div class="col-lg-4 col-md-3 col-xs-11">
                <input type="radio" id="opc1" name="gender" value="0" >
                <label for="opc1"> Nombre </label>
              </div>
                   
              <div class="col-lg-4 col-md-3 col-xs-11">
                <input type="radio" id="opc3" name="gender" value="1" >
                <label for="opc3"> Nick-Name </label>
              </div>

            </div>
          </center>
          
        </fieldset>

      </form>

        <br>

<!-- ~~~CODIGO NUEVOO -->
    
      <form accept-charset="utf-8" class="form-horizontal" role="form" id="datos_cotizacion">
       
        <div class="form-row" id="busqueda">
  
          
          <div class="form-group col-md-8">
            <label for="busq" class="col-md-2 control-label">Buscar: </label>
            <input id="busq" list="json-datalist" class="input_list form-control" autocomplete="off">
            <datalist id="json-datalist"></datalist>
          </div>
          
          <div class="form-group col-md-3">
            <span id="resultado">
              <p align='center'><img width='50px' src='../THE-FORCE-FACTORY/img/wait.gif' /></p>
            </span> 
          </div>

        </div>
      </form> 


<br>
<div class = "info-consulta">

 <form action="../THE-FORCE-FACTORY/report/report1.php">
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
    <label for="nick">Nick Name</label>
    <input type="text" class="form-control" id="nick" name="nick">
  </div>

  <div class="form-group">
    <label for="direcc">Direccion</label>
    <input type="text" class="form-control" id="direcc" name="direcc">
  </div>

</div>


 <div class="form-row">

    <div class="form-group col-md-6">
      <label for="fech">Fecha Inscripcion</label>
      <input type="date" class="form-control" id="fech" value="<?php echo date('Y-m-d'); ?>">
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

  </div>

 <div class="form-row col-md-7">

    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Enviar recibo por correo.
      </label>
    </div>
      <button type="submit" class="btn btn-primary" formmethod="post" formtarget="_blank" name="contrato" onclick="guardaCont();">ENVIAR </button>
  </div>

  <span id="res"></span>
</div>
</form>

</div><!-- .info-consulta -->

</html>

<!-- ~~~ TERMINA CODIGO NUEVOO -->
        <script type="text/javascript">

        window.onload =$(".info-consulta").hide();
        var obt;

        $(document).ready(function(){
            cargaConcepto();

          var select = document.getElementById('concepto');
          select.addEventListener('change',function(){
            var selectedOption = this.options[select.selectedIndex];
            //console.log(selectedOption.value +': ' + selectedOption.text+': '+selectedOption.getAttribute("data-costo")+': '+selectedOption.getAttribute("data-descripcion"));

            $('#descriP').val(selectedOption.getAttribute("data-descripcion"));
            $('#costP').val(selectedOption.getAttribute("data-costo"));

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
              $("#direcc").val(obt[0].direccion);
              $(".info-consulta").show();
            }
            },
            error : function(xhr,status){
              alert('Ha ocurrido un error ln -193');
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
//}else{
  //  console.log("ln 84 if Oprimio -> "+Chcode);
 // }
});

    function cargaConcepto(){
       $.get('JSON_PRUE/carga-select.php', function(data) {
      obt = JSON.parse(data);
      console.log(data);

            for (var i = obt.length - 1; i >= 0; i--) {
$("#concepto").append('<option value="'+obt[i]['id_concepto']+'" data-costo="'+obt[i]['costo']+'" data-descripcion="'+obt[i]['descripcion']+'">'+obt[i]['nombreConc']+'</option>');   
            }
    }); // close getJSON()
    }


    function guardaCont(){

      
      var idclient = $("#idOcul").val();
      var idoption = $("#concepto").val();
      var fechcont = $("#fech").val();

      alert("quedo: "+fechcont);



          jQuery.post("api/altas.php",{
            idcli:idclient,
            idopt:idoption,
            fechc:fechcont,
            funcion:"funcion2"
          }, function(data, textStatus){
              console.log(data);

            if(data == 1){
//              LimpiarCampos();
              alert("llego: "+data);
              $('#res').html("Datos insertados.");
              $('#res').css('color','green');
              //$("#resultadoBusqueda").load("pruebas/getPaquetes.php");
            }
            else{
              $('#res').html("Ha ocurrido un error.");
              $('#res').css('color','red');
            }
          });
/*
          $.ajax({
            url : "api/altas.php",
            type : "POST",
            dataType : "HTML",
            data : {
              funcion:"funcion2",
              idcli:idclient,
              idopt:idoption,
              fech:fechcont
            },
            cache : false,
            contentType : false,
            beforeSend: function(){
                          //imagen de carga
                        alert("envio before:"+funcion);
                    },
            success : function(data,status){
                  alert("llego success"+data);
            },
            error : function(xhr,status){
              alert('Ha ocurrido un error ln -309');
            },
            complete: function(xhr,status){
            
            }
          });//ajax
*/
      alert("apreto boton-> "+idoption);
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
  var info = string.split('/');
  return info[2] + '-' + info[1] + '-' + info[0];
}

</script>

