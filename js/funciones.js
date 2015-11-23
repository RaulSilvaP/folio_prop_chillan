jQuery(function($) {  

    //funciones javascript de control de la pagina

        $('#folio').blur(function(){  // Valida que un folio no esté repetido
        $('#Info').html('<img src="images/loader.gif" alt="" />').fadeOut(500);
        var folio = $(this).val();        
        var dataString = 'folio='+folio;
        $.ajax({
            type: "POST",
            url: "busca_folio.php",
            data: dataString,
            success: function(data) {
                if(data=="existe") {
                  $('#Info2').html('<input type="hidden" id="info_folio" name="info_folio" value="error"/>');
                    $('#Info').fadeIn(500).html('<div id="Error" class="text-danger" ><span class="glyphicon glyphicon-remove"></span> Folio ya existe</div>');
                    $('#folio').focus();
                    $('#folio').select();

                }else{
                  $('#Info2').html('<input type="hidden" id="info_folio" name="info_folio" value="exito"/>');
                  $('#Info').fadeIn(500).html('<div id="Success" class="text-success" ><span class="glyphicon glyphicon-ok"></span> Folio disponible</div>');
                }
            }
        });
    }); 


    $("#fecha_inscripcion").mask("99-99-9999",{placeholder:"dd-mm-aaaa"});
    $("#ano").mask("9999");
    $('#fecha_inscripcion').blur(function(){ //validar fecha
       var fecha = $('#fecha_inscripcion').val();
       var fechaArr = fecha.split('-');
       var aho = fechaArr[2];
       var mes = fechaArr[1];
       var dia = fechaArr[0];
       var plantilla = new Date(aho, mes - 1, dia);//mes empieza de cero Enero = 0
       if( fecha=="" || plantilla.getFullYear() == aho && plantilla.getMonth() == mes -1 && plantilla.getDate() == dia) {   //Si es correcta la fecha debe hacer lo siguiente:
          $('#msg_fecha').html('');
       }else{
          //SI LA FECHA NO ES VALIDA
          $('#msg_fecha').html('<div id="Error" class="text-danger"><span class="glyphicon glyphicon-remove"></span> Fecha inconsistente</div>');
          var timeoutId = setTimeout(function(){   //para poder engañar al navegador ya que el evento focus() se desactiva si está directamente dentro de un evento blur() se usa setTimeout para separarlos
            $('#fecha_inscripcion').focus();
            $('#fecha_inscripcion').select();
          },200);
        }
    }); 



    $('#tipo').css("display","none");
    $('#tipo').val($('#tipo0').val()); //asigna el valor del SELECT tipo0 al campo oculto tipo
    $('#tipo0').change(function(){  // si el SELECT cambia vuelve a asignar nuevo valor al campo tipo
        $('#tipo').val($('#tipo0').val());
        if ( $('#tipo0').val()=="otro" ) { //si se selecciona otro tipo de inscripción
          $('#tipo').show();
          $('#tipo').val(""); //borra el contenido del campo tipo
          $('#tipo').attr("placeholder","otro tipo de inscripción");
        }else{
          $('#tipo').css("display","none");
        }
    });


    $('#grabar').click(function(){
       var exito = $('#info_folio').val();
       var folio = $('#folio').val();
       var tipo = $('#tipo').val();
       var nombre = $('#nombre').val();
       var fojas = $('#fojas').val();
       var vuelta = $('input:checkbox[name=vuelta]:checked').val();
       var numero = $('#numero').val();
       var ano = $('#ano').val();
       var fecha_inscripcion = $('#fecha_inscripcion').val();
       var folio_anterior = $('#folio_anterior').val();
       var bien_familiar = $('input:radio[name=bien_familiar]:checked').val();
       var litigio = $('input:radio[name=litigio]:checked').val();
       if(exito !="exito") {  //valida que campo folio no esté repetido
          data='<div id="Error" class="text-danger"><span class="glyphicon glyphicon-remove"></span> Error, no se puede grabar los datos</div>'
          $('#respuesta').html(data).fadeIn(1000);
          $('#respuesta').html(data).delay(4000).fadeOut(2000);
          return
       }
       if(folio=="" || tipo=="" || nombre=="" || fojas=="" || numero=="" || ano=="") {   //valida que estos campos no esten vacios
          data='<div id="Error" class="text-danger"><span class="glyphicon glyphicon-remove"></span> Error, algunos datos estan vacios</div>'
          $('#respuesta').html(data).fadeIn(1000);
          $('#respuesta').html(data).delay(4000).fadeOut(2000);
          return
       }
       var datas="folio="+folio+"&tipo="+tipo+"&nombre="+nombre+"&fojas="+fojas+"&vuelta="+vuelta+
       "&numero="+numero+"&ano="+ano+"&fecha_inscripcion="+fecha_inscripcion+"&folio_anterior="+
       folio_anterior+"&bien_familiar="+bien_familiar+"&litigio="+litigio;

       $.ajax({
        type: "POST",
        url: "newdata_propiedad.php",
        data: datas
      }).done(function( data ) {
        $('#respuesta').html(data).fadeIn(1000);
        $('#respuesta').html(data).delay(4000).fadeOut(2000);
//    $('#tipo').val(""); // vacia el contenido del campo texto
        viewdata();
      });
    });








});   //cierre Jquery


function click_hipoteca () {
  alert("Presionó botón Hipoteca");
}
function click_prohibicion () {
  alert("Presionó botón Prohibición");
}
function click_tipo () {
  alert("Presionó botón Agregar Tipo Inscripción");
}






      function viewdata(){
        var folio = $('#folio').val();
       $.ajax({ 
       type: "POST",
       url: "getdata_propiedad.php",
       data: "folio="+folio
        }).done(function( data ) {
      $('#viewdata').html(data);
        });
      }


      $('#save').click(function(){
         var nm = $('#nm').val();
         var gd = $('#gd').val();
         var pn = $('#pn').val();
         var al = $('#al').val();
         var datas="nm="+nm+"&gd="+gd+"&pn="+pn+"&al="+al;
         $.ajax({
          type: "POST",
          url: "newdata.php",
          data: datas
        }).done(function( data ) {
          $('#info').html(data).fadeIn(1000);
          $('#info').html(data).delay(4000).fadeOut(2000);
          $('#nm').val(""); // vacia el contenido del campo texto
          viewdata();
        });
      });
  


      function updatedata(str){
        var id = str;
        var tipo = $('#tipo'+id).val();
        var nombre = $('#nombre'+id).val();
        var fojas = $('#fojas'+id).val();
//        var vuelta = $('input:checkbox[name=vuelta]:checked').val();
        var vuelta = $('#vuelta'+id).val();
        alert(vuelta);
        var numero = $('#numero'+id).val();
        var ano = $('#ano'+id).val();
        var datas="id="+id+"&tipo="+tipo+"&nombre="+nombre+"&fojas="+fojas+"&vuelta="+vuelta+"&numero="+numero+"&ano="+ano;   //+"&fecha_inscripcion="+fecha_inscripcion+"&folio_anterior="+
         //folio_anterior+"&bien_familiar="+bien_familiar+"&litigio="+litigio;
        $.ajax({
           type: "POST",
           url: "updatedata_propiedad.php",
           data: datas
        }).done(function( data ) {
          $('#info').html(data).fadeIn(1000);
          $('#info').html(data).delay(3000).fadeOut(1000);
          viewdata();
        });
      }




      function deletedata(str){
          if (confirm("¿Esta seguro de eliminar el registro?") == true) {
            var id = str;
            $.ajax({
               type: "GET",
               url: "deletedata_propiedad.php?id="+id
            }).done(function( data ) {
              $('#info').html(data).fadeIn(1000);
              $('#info').html(data).delay(2000).fadeOut(1000);
              viewdata();
            });
          } else {
            var id = str;
            var data ='<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>No se ha eliminado el registro.</div>';
              $('#info').html(data).fadeIn(1000);
              $('#info').html(data).delay(2000).fadeOut(1000);
              viewdata();
          }
      }
