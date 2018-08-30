FUNCIONAL EN cargaDatosContrato.php
<script type="text/javascript">

        window.onload =$(".info-consulta").hide();
        var dataList = document.getElementById('json-datalist');
        var obt =null;

        $('#busq').keyup(function(tecla){

        var Chcode = Number(tecla.which);
        var term = $("#busq").val();

        if( (Number(Chcode) > 64) && (Number(Chcode) < 91) || (Number(Chcode) === 13))// 
        {

          $.ajax({
            url : "pruebas/busqkeyUp.php",
            type : "GET",
            dataType : "HTML",
            data : {param:term},
            cache : false,
            contentType : false,

            success : function(data,status){

        $("#json-datalist").empty();//datalist convertido a objeto jquery
            
            obt = JSON.parse(data);//parseo de JSON a objeto JS

            //ciclo para recorrer el arreglo
            for (var i = obt.length - 1; i >= 0; i--) {
              var option = document.createElement('option');              
              option.value = obt[i]['nombre']+" "+obt[i]['apellidos'];
              dataList.appendChild(option);
            }

            $("#resultado").html(data);

            if (obt.length === 1 ) {
              $("#nmb").val(obt[0].nombre+" "+obt[0].apellidos);
              $("#nick").val(obt[0].nick);
              $("#direcc").val(obt[0].direccion);
              $(".info-consulta").show();

            }
//            console.log("obj -> "+obt.length+" ln = 179");

            },
            error : function(xhr,status){
              alert('Ha ocurrido un error ln -193');
            },
            complete: function(xhr,status){
            
            }
          });//

}else{
    console.log("ln 84 if Oprimio -> "+Chcode);
  }

});

</script>

/***  PRUEBA AL USAR PROMISE DE JAVASCRIPT ***/

$('#input').keypress(function(e)
  {
    if(e.which == 13) {
    e.preventDefault();

      var csrftoken = getCookie('csrftoken');

      var placa = $(this).val();

      var promise = $.ajax({
            url : window.location.href + "ajax1/",
            type : "POST", 
            data : { csrfmiddlewaretoken : csrftoken,
                     placa : placa,
                  }, 
            success : function(json) {

                //Almacena el resultado en algun lado

              },

            error : function(xhr,errmsg,err) {
              console.log(xhr.status + ": " + xhr.responseText);
            }
          });
          
          promise.then(function(){
              //
                      $.ajax({
                  url : window.location.href + "ajax2/",
                  type : "POST",
                  data :  { csrfmiddlewaretoken : csrftoken,
                           placa : placa,
                        },
                  success: function(data2){
                    console.log(data2); // Debería imprimir {ajax2: true}
                  },
                  error : function(xhr,errmsg,err) {
                    console.log(xhr.status + ": " + xhr.responseText);
                  }
                });
          //
          });            
        } 
  });
