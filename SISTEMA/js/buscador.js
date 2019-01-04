//  <script type="text/javascript">
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
//}else{
  //  console.log("ln 84 if Oprimio -> "+Chcode);
 // }
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
      console.log("GUARDA CONTRATO");      
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

      alert("pgo"+pay);

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

//</script>

