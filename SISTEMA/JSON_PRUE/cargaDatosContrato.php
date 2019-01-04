
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

<script type="text/javascript" src="js/buscador.js"></script>