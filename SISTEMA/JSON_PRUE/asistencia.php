
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

.perfilfot{
  border: 20px solid green;
}
.perfilfotVen{
  border: 20px solid red;
}

.status{

}
</style>

<html>
    <br>
<!-- ~~~CODIGO NUEVOO -->    
      <form accept-charset="utf-8" class="form-horizontal" role="form">
       <fieldset>
         <legend> REGISTRE LA ASISTENCIA DEL DIA. </legend>  
          <div class="form-row" id="busqueda">          
            <div class="form-group col-md-8">
              <label for="busq" class="col-md-6 control-label">Buscar Cliente: </label>
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
 <form role="form">
  
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

    <button type="submit" class="btn btn-success" id="boton" onclick="guardaAsist();"> ENVIAR </button><!--onclick="guardaCont();" -->

  <span id="res"></span>
</div>

</form>

</div><!-- .info-consulta -->

</html>

<script type="text/javascript">

var contador = 0;
        window.onload =$(".info-consulta").hide();
        var obt;

        var dataList = document.getElementById('json-datalist');
       
        var peticion2 = null;/*variable para consulta con PROMISE*/
        var param3 = null; //variables para comparar vigencia
        var compar = null;

        $('#busq').focus();

        $('#busq').on('input',function(tecla){//tenia keyup()

        var Chcode = Number(tecla.which);
        var term = $("#busq").val();

          var promise = $.ajax({
            url : "pruebas/busqkeyUpAsist.php",
            type : "GET",
            dataType : "HTML",
            data : {param:term},
            cache : false,
            contentType : false,
            beforeSend: function(){
                          //imagen de carga
                         // alert("ANTES");
                        $('#resultado').show();
                    },
            success : function(data,status){
                      //    alert(data);

              $("#json-datalist").empty();//datalist convertido a objeto jquery
            
            var obt = JSON.parse(data);//parseo de JSON a objeto JS
            //ciclo para recorrer el arreglo
            for (var i = obt.length - 1; i >= 0; i--) {
              var option = document.createElement('option');              
              option.value = obt[i]['nombre']+" "+obt[i]['apellidos'];
              dataList.appendChild(option);
            }
//alert(contsL);
//            console.log("Letra "+obt.length);

            if (obt.length >= 1 ) {
              peticion2 = obt[0].id_cli;//variable para ejecutar la promise asinc
              param3 = obt[0].id_contrato;

              $("#idOcul").val(peticion2);
              
              $("#nmb").val(obt[0].nombre+" "+obt[0].apellidos);
              $("#nick").val(obt[0].nick);
              $("#direcc").val(obt[0].direccion);
              $("#fechReg").val(obt[0].fechaInicio);

              $("#contN").html(param3);
              //$("#fechReg").val(obt[0].fecha_contrato);

              $(".info-consulta").show();

              obt = null;
            }
            },
            error : function(xhr,status){
              alert('Ha ocurrido un error ln -234');
            },
            complete: function(xhr,status){            
            }
          });//

          promise.then(function(){
            if (peticion2 != null) {
              $.post("Modales/formularioLL.php",{param:peticion2},function(data,status){       // console.log("post2 "+status);
                    var user = JSON.parse(data);
                    $("#imgn2").attr("src", "data:image/png;base64,"+user.foto);
              });

              $.post("api/altas.php",{funcion:"getfech",param2:param3},function(data,status){

//                console.log("llego: "+data);

               $("#fechP").html(data);
               compar = data;
              });

              var compar2 = $("#fechProxM").val();

              if (compar != null) {
                var nodo = document.getElementById("imgn2");

                nodo.classList.remove("perfilfot");
                nodo.classList.remove("perfilfotVen");

                var Fec1 = compar.split("-");
                var Fec2 = compar2.split("-");

                if (Number(Fec1[0]) >= Number(Fec2[0])) {
                  if (Number(Fec1[1]) >= Number(Fec2[1])) {
                    if (Number(Fec1[2]) >= Number(Fec2[2])) {

                      $("#statu").html("ACTIVO");

                      
                      nodo.classList.add("perfilfot");

                      document.getElementById("boton").disabled = false;

                    }else{
                      $("#statu").html("VENCIDO");
                      nodo.classList.add("perfilfotVen");
                      document.getElementById("boton").disabled = true;
                    }
                  }else{
                    $("#statu").html("MES VENCIDO");
                    nodo.classList.add("perfilfotVen");
                    document.getElementById("boton").disabled = true;
                  }
                }else{
                  $("#statu").html("AÑO VENCIDO");
                  nodo.classList.add("perfilfotVen");
                  document.getElementById("boton").disabled = true;
                }
                console.log(Fec1[0]+"  "+Fec1[1]+"  "+Fec1[2]);
                console.log(Fec2[0]+"  "+Fec2[1]+"  "+Fec2[2]);
              }
            }
              $('#resultado').hide();
          });

});

    function guardaAsist(){
      console.log("GUARDA ASISTENCIA");

      var idcont = $("#idOcul").val();
      var fechAsist = $("#fechProxM").val();

          jQuery.post("api/altas.php",{
            idcontr:idcont,
            fpm:fechAsist,
            funcion:"funcionAsist"
          }, function(data, textStatus){
            if(data != 0){
              $('#res').html("Asistencia insertada correctamente");
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
</script>

