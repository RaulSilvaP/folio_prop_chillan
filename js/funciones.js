jQuery(function($) {  

    //funciones javascript de control de la pagina INGRESO FOLIO PROPIEDAD

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


    //MANIPULAR CAMPO SELECT DE TIPO DE INSCRIPCION
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
 

    //MANIPULAR CAMPO SELECT DE NOMBRE DE PROPIETARIOS para hipoteca y prohibicion
    $('#nombre').css("display","none");   //oculta campo nombre

    $('#nombre').val($('#nombre0').val()); //asigna el valor del SELECT nombre0 al campo oculto nombre
    $('#nombre0').change(function(){  // si el SELECT cambia vuelve a asignar nuevo valor al campo nombre
        $('#nombre').val($('#nombre0').val());
        $('#nombre0').css("display","none");
        $('#nombre').show();
        if ( $('#nombre0').val()=="Otro" ) { //si se selecciona otro tipo de inscripción
          $('#nombre').val(""); //borra el contenido del campo nombre
          $('#nombre').attr("placeholder","otro propietario");
        }else{
//          $('#nombre').css("display","none");
        }
                   

        if ($('#nombre0').val()=="Todos" ) {
          var total = ($('select#nombre0 option').length);
//          $("select#nombre0").prop('selectedIndex', (total-2));
          $("select#nombre0").prop('selectedIndex', 1);  //por defecto se selecciona la primera persona de la lista
          if (total<=3) {
              var mitexto = $('#nombre0').val();
          }else if (total==4) {
              var mitexto = $('#nombre0').val()+" Y OTRO";
          }else if (total>4) {
              var mitexto = $('#nombre0').val()+" Y OTROS";
          }    
          $('#nombre').val(mitexto);
        }
    });
 

    //MANIPULAR CAMPO SELECT DE acreedor para hipoteca y prohibicion
//    $('#acreedor').css("display","none");   //oculta campo nombre

    $('#acreedor').val($('#acreedor0').val()); //asigna el valor del SELECT nombre0 al campo oculto nombre
    $('#acreedor0').change(function(){  // si el SELECT cambia vuelve a asignar nuevo valor al campo tipo
        $('#acreedor').val($('#acreedor0').val());
//        $('#acreedor0').css("display","none");
        $('#acreedor').show();
        if ( $('#acreedor0').val()=="Otro" ) { //si se selecciona otro tipo de inscripción
          $('#acreedor').val(""); //borra el contenido del campo acreedor
          $('#acreedor').attr("placeholder","otro acreedor");
        }else{
//          $('#acreedor').css("display","none");
        }
    });





// GRABA NUEVO FOLIO DE PROPIEDAD
    $('#grabar_prop').click(function(){
       var exito = $('#info_folio').val();
       var folio = $('#folio').val();
       var folio_global = $('#folio').val();
       var tipo = $('#tipo').val();
       var nombre = $('#nombre_prop').val();
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
       var datas="folio="+folio+"&tipo="+tipo+"&nombre_prop="+nombre+"&fojas="+fojas+"&vuelta="+vuelta+
       "&numero="+numero+"&ano="+ano+"&fecha_inscripcion="+fecha_inscripcion+"&folio_anterior="+
       folio_anterior+"&bien_familiar="+bien_familiar+"&litigio="+litigio;

       $.ajax({
        type: "POST",
        url: "newdata_propiedad.php",
        data: datas
      }).done(function( data ) {
        $('#respuesta').html(data).fadeIn(1000);
        $('#respuesta').html(data).delay(4000).fadeOut(2000);
        $('#nombre_prop').val(""); // vacia el contenido del campo nombre_prop
        $('#nombre_prop').focus();
        viewdata_propiedad("Eliminar");
      });
    });




      //FUNCION TODOS TRANSFIEREN DEL REGISTRO DE PROPIEDAD
     $('#mod_fol_prop').click(function(){  // Valida que un folio exista (modificacion prop)
          $('#Info').html('<img src="images/loader.gif" alt="" />').fadeOut(300);
          var folio = $('#folio_prop').val();  
          var dataString = 'folio='+folio;
          $.ajax({
            type: "POST",
            url: "busca_folio.php",
            data: dataString,
            success: function(data) {
              if(data != "existe") {
                $('#Info2').html('<input type="hidden" id="info_folio" name="info_folio" value="error"/>');
                $('#Info').fadeIn(300).html('<div id="Error" class="text-danger" ><span class="glyphicon glyphicon-remove"></span> Folio no existe</div>');
                $('#folio_prop').focus();
                $('#folio_prop').select();
              }else{
                $('#Info2').html('<input type="hidden" id="info_folio" name="info_folio" value="exito"/><input type="hidden" id="folio" name="folio"/>');
                $('#Info').fadeIn(300).html('<div id="Success" class="text-success" ><span class="glyphicon glyphicon-ok"></span> Folio correcto</div>');
                $('#folio').val(folio);
                viewdata_propiedad_mod(" Eliminar");
              }
            }
          });
      });






// GRABA NUEVO HIPOTECA
    $('#grabar_hipo').click(function(){
       var exito = $('#info_folio').val();
       var folio = $('#folio_hip').val();
       var tipo = $('#tipo').val();
       var nombre = $('#nombre').val();
       var fojas = $('#fojas').val();
       var vuelta = $('input:checkbox[name=vuelta]:checked').val();
       var numero = $('#numero').val();
       var ano = $('#ano').val();
       var acreedor = $('#acreedor').val();
       if(exito !="exito") {  //valida que campo folio no esté repetido
          data='<div id="Error" class="text-danger"><span class="glyphicon glyphicon-remove"></span> Error, no se puede grabar los datos</div>'
          $('#respuesta').html(data).fadeIn(1000);
          $('#respuesta').html(data).delay(4000).fadeOut(2000);
          return
       }
       if(folio=="" || tipo=="" || nombre=="" || fojas=="" || numero=="" || ano=="" || acreedor=="") {   //valida que estos campos no esten vacios
          data='<div id="Error" class="text-danger"><span class="glyphicon glyphicon-remove"></span> Error, algunos datos estan vacios</div>'
          $('#respuesta').html(data).fadeIn(1000);
          $('#respuesta').html(data).delay(4000).fadeOut(2000);
          return
       }
       var datas="folio="+folio+"&tipo="+tipo+"&nombre="+nombre+"&fojas="+fojas+"&vuelta="+vuelta+
       "&numero="+numero+"&ano="+ano+"&acreedor="+acreedor;

       $.ajax({
        type: "POST",
        url: "newdata_hipoteca.php",
        data: datas
      }).done(function( data ) {
        $('#respuesta').html(data).fadeIn(1000);
        $('#respuesta').html(data).delay(4000).fadeOut(2000);
        $('#fojas').val(""); // vacia el contenido del campo 
        $('#vuelta').prop('checked',false); // vacia el contenido del campo 
        $('#numero').val(""); // vacia el contenido del campo 
        $('#ano').val(""); // vacia el contenido del campo 
        $('#fojas').focus();
        viewdata_hipoteca("Eliminar");
      });
    });






     $('#buscar_fol_hip').click(function(){  // Valida que un folio exista (ingreso hipoteca)
          $('#Info').html('<img src="images/loader.gif" alt="" />').fadeOut(300);
          var folio = $('#folio_hip').val();  
          $('#nombre').css("display","none");
          $('#nombre0').show();

          var dataString = 'folio='+folio;
          $.ajax({
            type: "POST",
            url: "busca_folio.php",
            data: dataString,
            success: function(data) {
              if(data != "existe") {
                $('#Info2').html('<input type="hidden" id="info_folio" name="info_folio" value="error"/>');
                $('#Info').fadeIn(300).html('<div id="Error" class="text-danger" ><span class="glyphicon glyphicon-remove"></span> Folio no existe</div>');
                $('#folio_hip').focus();
                $('#folio_hip').select();
              }else{
                $('#Info2').html('<input type="hidden" id="info_folio" name="info_folio" value="exito"/>');
                $('#Info').fadeIn(300).html('<div id="Success" class="text-success" ><span class="glyphicon glyphicon-ok"></span> Folio correcto</div>');
                $.ajax({
                  url: "procesar_select.php",
                  data: dataString,
                  success: function(data) {
                    $('#nombre0').html(data);
                    $("select#nombre0").prop('selectedIndex', 1);
                    $('#nombre').val($('#nombre0').val()); //asigna el valor del SELECT nombre0 al campo oculto nombre
                    $('#nombre0').attr('size','4');  //determina que el select nombre se despleque con 4 elementos abiertos
                  }
                });
              }
            }
          });

      });

     $('#mod_fol_hip').click(function(){  // Valida que un folio exista (ingreso hipoteca)
          $('#Info').html('<img src="images/loader.gif" alt="" />').fadeOut(300);
          var folio = $('#folio_hip').val();  
          var dataString = 'folio='+folio;
          $.ajax({
            type: "POST",
            url: "busca_folio.php",
            data: dataString,
            success: function(data) {
              if(data != "existe") {
                $('#Info2').html('<input type="hidden" id="info_folio" name="info_folio" value="error"/>');
                $('#Info').fadeIn(300).html('<div id="Error" class="text-danger" ><span class="glyphicon glyphicon-remove"></span> Folio no existe</div>');
                $('#folio_hip').focus();
                $('#folio_hip').select();
              }else{
                $('#Info2').html('<input type="hidden" id="info_folio" name="info_folio" value="exito"/>');
                $('#Info').fadeIn(300).html('<div id="Success" class="text-success" ><span class="glyphicon glyphicon-ok"></span> Folio correcto</div>');
                viewdata_hipoteca("Alzar Total");
              }
            }
          });

      });



// GRABA NUEVO PROHIBICION
    $('#grabar_proh').click(function(){
       var exito = $('#info_folio').val();
       var folio = $('#folio_prh').val();
       var tipo = $('#tipo').val();
       var nombre = $('#nombre').val();
       var fojas = $('#fojas').val();
       var vuelta = $('input:checkbox[name=vuelta]:checked').val();
       var numero = $('#numero').val();
       var ano = $('#ano').val();
       var acreedor = $('#acreedor').val();
       if(exito !="exito") {  //valida que campo folio no esté repetido
          data='<div id="Error" class="text-danger"><span class="glyphicon glyphicon-remove"></span> Error, no se puede grabar los datos</div>'
          $('#respuesta').html(data).fadeIn(1000);
          $('#respuesta').html(data).delay(4000).fadeOut(2000);
          return
       }
       if(folio=="" || tipo=="" || nombre=="" || fojas=="" || numero=="" || ano=="" || acreedor=="") {   //valida que estos campos no esten vacios
          data='<div id="Error" class="text-danger"><span class="glyphicon glyphicon-remove"></span> Error, algunos datos estan vacios</div>'
          $('#respuesta').html(data).fadeIn(1000);
          $('#respuesta').html(data).delay(4000).fadeOut(2000);
          return
       }
       var datas="folio="+folio+"&tipo="+tipo+"&nombre="+nombre+"&fojas="+fojas+"&vuelta="+vuelta+
       "&numero="+numero+"&ano="+ano+"&acreedor="+acreedor;

       $.ajax({
        type: "POST",
        url: "newdata_prohibicion.php",
        data: datas
      }).done(function( data ) {
        $('#respuesta').html(data).fadeIn(1000);
        $('#respuesta').html(data).delay(4000).fadeOut(2000);
        $('#fojas').val(""); // vacia el contenido del campo 
        $('#vuelta').prop('checked',false); // vacia el contenido del campo 
        $('#numero').val(""); // vacia el contenido del campo 
        $('#ano').val(""); // vacia el contenido del campo 
        $('#fojas').focus();
        viewdata_prohibicion("Eliminar");
      });
    });






     $('#buscar_fol_proh').click(function(){  // Valida que un folio exista (ingreso prohibición)
          $('#Info').html('<img src="images/loader.gif" alt="" />').fadeOut(300);
          var folio = $('#folio_prh').val();  
          $('#nombre').css("display","none");
          $('#nombre0').show();

          var dataString = 'folio='+folio;
          $.ajax({
            type: "POST",
            url: "busca_folio.php",
            data: dataString,
            success: function(data) {
              if(data != "existe") {
                $('#Info2').html('<input type="hidden" id="info_folio" name="info_folio" value="error"/>');
                $('#Info').fadeIn(300).html('<div id="Error" class="text-danger" ><span class="glyphicon glyphicon-remove"></span> Folio no existe</div>');
                $('#folio_prh').focus();
                $('#folio_prh').select();
              }else{
                $('#Info2').html('<input type="hidden" id="info_folio" name="info_folio" value="exito"/>');
                $('#Info').fadeIn(300).html('<div id="Success" class="text-success" ><span class="glyphicon glyphicon-ok"></span> Folio correcto</div>');
                $.ajax({
                  url: "procesar_select.php",
                  data: dataString,
                  success: function(data) {
                    $('#nombre0').html(data);
                    $("select#nombre0").prop('selectedIndex', 1);
                    $('#nombre').val($('#nombre0').val()); //asigna el valor del SELECT nombre0 al campo oculto nombre
                    $('#nombre0').attr('size','4');  //determina que el select nombre se despleque con 4 elementos abiertos
                  }
                });
              }
            }
          });

      });


     $('#mod_fol_prh').click(function(){  // Valida que un folio exista (modifica prohibicion)
          $('#Info').html('<img src="images/loader.gif" alt="" />').fadeOut(300);
          var folio = $('#folio_prh').val();  
          var dataString = 'folio='+folio;
          $.ajax({
            type: "POST",
            url: "busca_folio.php",
            data: dataString,
            success: function(data) {
              if(data != "existe") {
                $('#Info2').html('<input type="hidden" id="info_folio" name="info_folio" value="error"/>');
                $('#Info').fadeIn(300).html('<div id="Error" class="text-danger" ><span class="glyphicon glyphicon-remove"></span> Folio no existe</div>');
                $('#folio_prh').focus();
                $('#folio_prh').select();
              }else{
                $('#Info2').html('<input type="hidden" id="info_folio" name="info_folio" value="exito"/>');
                $('#Info').fadeIn(300).html('<div id="Success" class="text-success" ><span class="glyphicon glyphicon-ok"></span> Folio correcto</div>');
                viewdata_prohibicion("Alzar Total");
              }
            }
          });

      });




     $('#boton_propiedad').click(function(){  // Redirige al ingreso de propiedad desde hipoteca y prohibicion
          window.location="ingreso_prop0.php";
      });

     $('#boton_hipoteca_prop').click(function(){  // Redirige a ingreso hipoteca desde propiedad
          var folio = $('#folio').val();  
          window.location="ingreso_hipo0.php?folio="+folio;
      });
     $('#boton_hipoteca_proh').click(function(){  // Redirige a ingreso hipoteca desde prohibicion
          var folio = $('#folio_prh').val();  
          window.location="ingreso_hipo0.php?folio="+folio;
      });

     $('#boton_prohibicion_prop').click(function(){  // Redirige a ingreso prohbición desde propiedad
          var folio = $('#folio').val();  
          window.location="ingreso_proh0.php?folio="+folio;
      });
      $('#boton_prohibicion_hip').click(function(){  // Redirige a ingreso prohibicion desde hipoteca
          var folio = $('#folio_hip').val();  
          window.location="ingreso_proh0.php?folio="+folio;
      });





});   //cierre Jquery



      //  FUNCIONES DE CRUD DEL REGISTRO DE PROPIEDAD
      function viewdata_propiedad(mensaje){
          var folio = $('#folio').val();
          $.ajax({ 
             type: "POST",
             url: "getdata_propiedad.php?mensaje="+mensaje,
             data: "folio="+folio
          }).done(function( data ) {
              $('#viewdata').html(data);
          });
      }


      //  FUNCIONES DE CRUD DEL REGISTRO DE PROPIEDAD PARA LA MODIFICACION (TRASFEERENCIA)
      function viewdata_propiedad_mod(mensaje){
          var folio = $('#folio').val();
          $.ajax({ 
             type: "POST",
             url: "getdata_propiedad_mod.php?mensaje="+mensaje,
             data: "folio="+folio
          }).done(function( data ) {
              $('#viewdata').html(data);
              if($('#nombre_script').val()=="mod_prop0") {
                  $('#view_transfieren').html('<button type="button" id="transfieren" class="btn btn-success" data-toggle="modal" data-target="#Modal_t"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Transfieren</button>');
              }
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
          viewdata_propiedad();
        });
      });
  


      function updatedata_propiedad(str,mensaje){
        var id = str;
        var tipo = $('#tipo'+id).val();
        var nombre = $('#nombre_prop'+id).val();
        var fojas = $('#fojas'+id).val();
//        var vuelta = $('input:checkbox[name=vuelta]:checked').val();
        var vuelta = $('#vuelta'+id+':checked').val();

        var numero = $('#numero'+id).val();
        var ano = $('#ano'+id).val();
        var datas="id="+id+"&tipo="+tipo+"&nombre_prop="+nombre+"&fojas="+fojas+"&vuelta="+vuelta+"&numero="+numero+"&ano="+ano;   //+"&fecha_inscripcion="+fecha_inscripcion+"&folio_anterior="+
         //folio_anterior+"&bien_familiar="+bien_familiar+"&litigio="+litigio;
        $.ajax({
           type: "POST",
           url: "updatedata_propiedad.php",
           data: datas
        }).done(function( data ) {
          $('#info').html(data).fadeIn(1000);
          $('#info').html(data).delay(3000).fadeOut(1000);
          $('body').css('overflow', 'visible');  // HABILITAR EL SCROLL DE LA PÁGINA (BODY) el modal lo desabilitaba
          viewdata_propiedad(mensaje);
        });
      }




      function deletedata_propiedad(str,mensaje){
          if (confirm("¿Esta seguro de eliminar el registro?") == true) {
            var id = str;
            $.ajax({
               type: "GET",
               url: "deletedata_propiedad.php?id="+id
            }).done(function( data ) {
              $('#info').html(data).fadeIn(1000);
              $('#info').html(data).delay(2000).fadeOut(1000);
              viewdata_propiedad();
            });
          } else {
            var id = str;
            var data ='<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Eligió no eliminar el registro.</div>';
              $('#info').html(data).fadeIn(1000);
              $('#info').html(data).delay(2000).fadeOut(1000);
              viewdata_propiedad(mensaje);
          }
      }
// FIN FUNCIONES CRUD DE PROPIEDAD


//  FUNCIONES DE CRUD DEL REGISTRO DE HIPOTECA
      function viewdata_hipoteca(mensaje){
        var folio = $('#folio_hip').val();
       $.ajax({ 
       type: "POST",
       url: "getdata_hipoteca.php?mensaje="+mensaje,
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
          viewdata_propiedad();
        });
      });
  


      function updatedata_hipoteca(str,mensaje){
        var id = str;
        var tipo = $('#tipo'+id).val();
        var nombre = $('#nombre'+id).val();
        var fojas = $('#fojas'+id).val();
//        var vuelta = $('input:checkbox[name=vuelta]:checked').val();
        var vuelta = $('#vuelta'+id+':checked').val();

        var numero = $('#numero'+id).val();
        var ano = $('#ano'+id).val();
        var acreedor = $('#acreedor'+id).val();
        var datas="id="+id+"&tipo="+tipo+"&nombre="+nombre+"&fojas="+fojas+"&vuelta="+vuelta+"&numero="+numero+"&ano="+ano+"&acreedor="+acreedor;   //+"&fecha_inscripcion="+fecha_inscripcion+"&folio_anterior="+
         //folio_anterior+"&bien_familiar="+bien_familiar+"&litigio="+litigio;
        $.ajax({
           type: "POST",
           url: "updatedata_hipoteca.php",
           data: datas
        }).done(function( data ) {
          $('#info').html(data).fadeIn(1000);
          $('#info').html(data).delay(3000).fadeOut(1000);
          $('body').css('overflow', 'visible');  // HABILITAR EL SCROLL DE LA PÁGINA (BODY) el modal lo desabilitaba
          viewdata_hipoteca(mensaje);
        });
      }




      function deletedata_hipoteca(str,mensaje){
          if (confirm("¿Esta seguro de eliminar el registro?") == true) {
            var id = str;
            $.ajax({
               type: "GET",
               url: "deletedata_hipoteca.php?id="+id
            }).done(function( data ) {
              $('#info').html(data).fadeIn(1000);
              $('#info').html(data).delay(2000).fadeOut(1000);
              viewdata_hipoteca(mensaje);
            });
          } else {
            var id = str;
            var data ='<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Eligió no eliminar el registro.</div>';
              $('#info').html(data).fadeIn(1000);
              $('#info').html(data).delay(2000).fadeOut(1000);
              viewdata_hipoteca(mensaje);
          }
      }
// FIN FUNCIONES CRUD DE HIPOTECA


//  FUNCIONES DE CRUD DEL REGISTRO DE PROHIBICION
      function viewdata_prohibicion(mensaje){
        var folio = $('#folio_prh').val();
       $.ajax({ 
       type: "POST",
       url: "getdata_prohibicion.php?mensaje="+mensaje,
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
          viewdata_propiedad();
        });
      });
  


      function updatedata_prohibicion(str,mensaje){
        var id = str;
        var tipo = $('#tipo'+id).val();
        var nombre = $('#nombre'+id).val();
        var fojas = $('#fojas'+id).val();
//        var vuelta = $('input:checkbox[name=vuelta]:checked').val();
        var vuelta = $('#vuelta'+id+':checked').val();

        var numero = $('#numero'+id).val();
        var ano = $('#ano'+id).val();
        var acreedor = $('#acreedor'+id).val();
        var datas="id="+id+"&tipo="+tipo+"&nombre="+nombre+"&fojas="+fojas+"&vuelta="+vuelta+"&numero="+numero+"&ano="+ano+"&acreedor="+acreedor;   //+"&fecha_inscripcion="+fecha_inscripcion+"&folio_anterior="+
         //folio_anterior+"&bien_familiar="+bien_familiar+"&litigio="+litigio;
        $.ajax({
           type: "POST",
           url: "updatedata_prohibicion.php",
           data: datas
        }).done(function( data ) {
          $('#info').html(data).fadeIn(1000);
          $('#info').html(data).delay(3000).fadeOut(1000);
          $('body').css('overflow', 'visible');  // HABILITAR EL SCROLL DE LA PÁGINA (BODY) el modal lo desabilitaba
          viewdata_prohibicion(mensaje);
        });
      }




      function deletedata_prohibicion(str,mensaje){
          if (confirm("¿Esta seguro de eliminar el registro?") == true) {
            var id = str;
            $.ajax({
               type: "GET",
               url: "deletedata_prohibicion.php?id="+id
            }).done(function( data ) {
              $('#info').html(data).fadeIn(1000);
              $('#info').html(data).delay(2000).fadeOut(1000);
              viewdata_prohibicion(mensaje);
            });
          } else {
            var id = str;
            var data ='<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Eligió no eliminar el registro.</div>';
              $('#info').html(data).fadeIn(1000);
              $('#info').html(data).delay(2000).fadeOut(1000);
              viewdata_prohibicion(mensaje);
          }
      }
// FIN FUNCIONES CRUD DE PROHIBICION
