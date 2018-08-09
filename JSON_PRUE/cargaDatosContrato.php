
<style type="text/css">
  
  .flotForm{
  display: inline-block;
  vertical-align: top;
}

div.#frm-muestra{
  text-align: center;
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

 <form>
    <div class="form-group col-md-3 col-sm-3 ajust">
      <img class="img-responsive img-circle" id="imgn" alt="SIN IMAGEN" src="img/Mp.jpg">
    </div>

<div class="flotForm col-sm-9 col-md-7 col-xs-5 col-lg-4">

  <div class="form-group">
    <label for="nmb">Nombre: </label>
    <input type="text" class="form-control" id="nmb">
  </div>

  <div class="form-row">

    <div class="form-group">
    <label for="inputAddress2">Nick Name</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>

  <div class="form-group">
    <label for="inputAddress3">Direccion</label>
    <input type="text" class="form-control" id="inputAddress3" placeholder="Apartment, studio, or floor">
  </div>

</div>

  <div class="form-group">
    <label for="drn">Direccion: </label>
    <input type="text" class="form-control" id="drn">
  </div>

 <div class="form-row">

    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>

    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>

    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>

  </div>

 <div class="form-row col-md-7">

    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
      <button type="submit" class="btn btn-primary">Sign in</button>
  </div>
</div>
</form>
</html>

<!-- ~~~ TERMINA CODIGO NUEVOO -->

        <script type="text/javascript">

        var dataList = document.getElementById('json-datalist');

        $('#busq').keyup(function(tecla){

        var Chcode = Number(tecla.which);


          var term = $("#busq").val();

        if( term != ""  )//(Number(Chcode) > 64) && (Number(Chcode) < 91) 
        {

        $(dataList).empty();//datalist convertido a objeto jquery



//          console.log("term ->"+term);

          $.ajax({
            url : "pruebas/busqkeyUp.php",
            type : "GET",
            dataType : "HTML",
            data : {param:term},
            cache : false,
            contentType : false,

            success : function(data,status){
            //  alert("Yaaaaaa!!!");
            obt = JSON.parse(data);
            //var leng = obt.length;
            //ciclo para recorrer el arreglo
            for (var i = obt.length - 1; i >= 0; i--) {
              var option = document.createElement('option');              
              option.value = obt[i]['nombre']+" "+obt[i]['apellidos'];
              dataList.appendChild(option);
            }

            $("#resultado").html(data);


            console.log("obj -> "+data+"ln = 179");

            },
            error : function(xhr,status){
              alert('Ha ocurrido un puto error de mierdaaa');
            },
            complete: function(xhr,status){

            }
          });//

}else{
//    console.log("ln 84 if Oprimio -> "+Chcode);
  }

});

</script>

