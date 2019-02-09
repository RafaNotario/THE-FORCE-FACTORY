
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
         <legend> PAGO DE MENSUALIDAD. </legend>  
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
 <form role="form" action="../SISTEMA/report/report2Mens.php">
    <div class="form-group col-md-3 col-sm-3 ajust">
      <img class="img-responsive img-circle" id="imgn2" alt="USUARIO" src="img/Mp.jpg" width="200px">
    </div>
<div class="flotForm col-sm-9 col-md-7 col-xs-5 col-lg-4">

  <input type="text" name="idOcul" id="idOcul" class="hide">


 <div class="form-row">
  <div class="form-group col-md-7">
    <label for="nmb">Nombre: </label>
    <input type="text" class="form-control" id="nmb" name="titulo">
  </div>

    <div class="form-group col-md-5">
    <label for="nick">Nick Name </label>
    <input type="text" class="form-control" id="nick" name="nick">
  </div>
</div>

  <div class="form-group">
    <label for="direcc">Direccion </label>
    <input type="text" class="form-control" id="direcc" name="direcc">
  </div>

  <div class="form-group">
    <label for="mail">Correo </label>
    <input type="text" class="form-control" id="mail" name="mail">
  </div>


   <div class="form-row">

    <div class="form-group col-md-6">
      <label for="fechReg">Fecha de Registro.</label>
      <input type="text" class="form-control" id="fechReg" name="fechReg">
    </div>

    <div class="form-group col-md-6">
      <label for="paqC">Paquete contratado:</label>
      <input type="text" class="form-control" id="paqC" name="paqC">
    </div>
  </div>

 <div class="form-row">

    <div class="form-group col-md-8">
      <label for="descriM">Descripcion:</label>
      <input type="text" class="form-control" id="descriM" name="descriM">
    </div>

    <div class="form-group col-md-4">
      <label for="costM">Costo:</label>
      <input type="text" class="form-control" id="costM" name="costM">
    </div>
<!-- 
  input oculto para enviar los otros datos del reporte contrato
--> 
  <input type="text" name="vari2" id="vari2" class="hide">

  </div>


 <div class="form-row">

    <div class="form-group col-md-6">
      <label for="fechM">Fecha de pago</label>
      <input type="date" class="form-control" id="fechM" name="fechM" value="<?php 
      date_default_timezone_set("America/Mexico_City");
      echo date('Y-m-d'); ?>">
    </div>

    <div class="form-group col-md-6">
      <label for="fechProxM">Proximo pago</label>
      <input type="date" class="form-control" id="fechProxM" name="fechProxM" value="<?php 
      date_default_timezone_set("America/Mexico_City");
      echo date('Y-m-d'); ?>">
    </div>

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

      <button type="submit" class="btn btn-primary" formmethod="post" formtarget="_blank" name="contrato" onclick="guardaMens();">GUARDAR
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
            url : "pruebas/busqkeyUpMens.php",
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
            
            if (obt.length === 1 ) {
              peticion2 = obt[0].id_cli;//variable para ejecutar la promise asinc
              $("#idOcul").val(obt[0].id_contrato);
              $("#nmb").val(obt[0].nombre+" "+obt[0].apellidos);
              $("#nick").val(obt[0].nick);
              $("#mail").val(obt[0].correo);
              $("#direcc").val(obt[0].direccion);

              $("#fechReg").val(obt[0].fecha_contrato);
              $("#paqC").val(obt[0].nombreConc);
              $("#descriM").val(obt[0].descripcion);
              $("#costM").val(obt[0].costo);



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

    function guardaMens(){
      console.log("GUARDA MENSULAIDAD");   

      var idcont = $("#idOcul").val();
      var fechPagoM = $("#fechM").val();
      var fechProxPagM = $("#fechProxM").val();

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
            idcontr:idcont,
            fpm:fechPagoM,
            fppm:fechProxPagM,           
            pag:pay,
            funcion:"funcionMens"
          }, function(data, textStatus){
            if(data != 0){
              $('#res').html("Mensualidad insertada correctamente");
              $('#res').css('color','green');

              console.log("textStatus: "+textStatus);
              //$("#resultadoBusqueda").load("pruebas/getPaquetes.php");
            }
            else{
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
</script>

