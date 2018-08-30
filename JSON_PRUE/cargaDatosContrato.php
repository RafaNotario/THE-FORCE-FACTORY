
<style type="text/css">
  
  .flotForm{
  display: inline-block;
  vertical-align: top;
}

div.#frm-muestra{
  text-align: center;
}

div.info-consulta{
  width: 95%;
  margin-top: 20px;
}


@media only scren and (min-width: 480px){
  div.info-consulta{
    width: 100%;
    margin-top: 10px;
    background-color:blue;
  }
}

@media only screen and (min-width:  768px) {
    .flotForm{
        width: 70%;
        float: right;
        display: inline-block;
    }

    .ajust{
    margin: 0 auto;
    width: 30%;
    padding-bottom: 20px;
  }
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
       
        <div class="form-group row ">
  
          <label for="busq" class="col-md-2 control-label">Buscar: </label>
          <div class="col-md-5">
            <input id="busq" list="json-datalist" class="input_list form-control" autocomplete="off">
            <datalist id="json-datalist"></datalist>
          </div>
        </div>
      </form> 


      <span id="resultado"></span> 
<br>
<div class = "info-consulta">
 <form>
    <div class="form-group col-md-3 col-sm-3 ajust">
      <img class="img-responsive" id="imgn2" alt="USUARIO" src="img/Mp.jpg" width="200px">
    </div>

<div class="flotForm col-sm-10 col-md-7 col-lg-7">

  <div class="form-group">
    <label for="nmb">Nombre: </label>
    <input type="text" class="form-control" id="nmb">
  </div>

  <div class="form-row">

    <div class="form-group">
    <label for="inputAddress2">Nick Name</label>
    <input type="text" class="form-control" id="nick">
  </div>

  <div class="form-group">
    <label for="direcc">Direccion</label>
    <input type="text" class="form-control" id="direcc" name="direcc">
  </div>

</div>

 <div class="form-row">

    <div class="form-group col-md-4">
      <label for="fechInscr">Fecha de Inscripcion</label>
      <input type="text" id="fechInscr"class="form-control" name="fechInscr" value="<?php echo date('d-m-Y')?>">
    </div>

    <div class="form-group col-md-4">
      <label for="inputState">MES:</label>
      <select id="inputState" class="form-control">
        <option value="1">ENERO</option>
        <option value="2">FEBRERO</option>
        <option value="3">MARZO</option>
        <option value="4">ABRIL</option>
        <option value="5">MAYO</option>
        <option value="6">JUNIO</option>
        <option value="7">JULIO</option>
        <option value="8">AGOSTO</option>
        <option value="9">SEPTIEMBRE</option>
        <option value="10">OCTUBRE</option>
        <option value="11">NOVIEMBRE</option>
        <option value="12">DICIEMBRE</option>

      </select>
    </div>

    <div class="form-group col-md-4">
       <label for="concept">Concepto:</label>
      <select id="concept" class="form-control">
        <option value="1">ENERO</option>
        <option value="2">FEBRERO</option>
        <option value="3">MARZO</option>
        <option value="4">ABRIL</option>
        <option value="5">MAYO</option>
        <option value="6">JUNIO</option>
        <option value="7">JULIO</option>
        <option value="8">AGOSTO</option>
        <option value="9">SEPTIEMBRE</option>
        <option value="10">OCTUBRE</option>
        <option value="11">NOVIEMBRE</option>
        <option value="12">DICIEMBRE</option>

      </select>
    </div>

  </div>

 <div class="form-row col-md-7">

    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Enviar por Correo
      </label>
    </div>


      <button type="submit" class="btn btn-primary">GUARDAR</button>
  </div>

</div>

</form>

</div><!-- .info-consulta -->
</html>

<!-- ~~~ TERMINA CODIGO NUEVOO -->
        <script type="text/javascript">

        //window.onload =$(".info-consulta").hide();

        var dataList = document.getElementById('json-datalist');
       
        var peticion2 = null;/*variable para consulta con PROMISE*/

        $('#busq').keyup(function(tecla){

        var Chcode = Number(tecla.which);
        var term = $("#busq").val();

/*Chequeamos que solo ingrese letras y enter para realizar la consulta*/
        if( (Number(Chcode) > 64) && (Number(Chcode) < 91) || (Number(Chcode) === 13))// 
        {

          var promise = $.ajax({
            url : "pruebas/busqkeyUp.php",
            type : "GET",
            dataType : "HTML",
            data : {param:term},
            cache : false,
            contentType : false,

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
          });

}else{
    console.log("ln 84 if Oprimio -> "+Chcode);
  }

});

</script>

