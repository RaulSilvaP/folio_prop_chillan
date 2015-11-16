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
	var nm = $('#nm'+str).val();
	var gd = $('#gd'+str).val();
	var pn = $('#pn'+str).val();
	var al = $('#al'+str).val();
	 
	var datas="nm="+nm+"&gd="+gd+"&pn="+pn+"&al="+al;
	$.ajax({
	   type: "POST",
	   url: "updatedata_propiedad.php?id="+id,
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

jQuery(function($) { 
    $('#tipo').css("display","none");
    $('#tipo').val($('#tipo0').val()); //asigna el valor del SELECT tipo0 al campo oculto tipo
    $('#tipo0').change(function(){  // si el SELECT cambia vuelve a asignar nuevo valor al campo tipo
        $('#tipo').val($('#tipo0').val());
        if ( $('#tipo0').val()=="otro" ) { //si se selecciona otro tipo de inscripción
          $('#tipo').show();
          $('#tipo').val(""); //borra el contenido del campo tipo
          $('#tipo').attr("placeholder","nuevo tipo de inscripción");
        }else{
          $('#tipo').css("display","none");
        }
    });

    $('#grabar').click(function(){

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

       var datas="folio="+folio+"&tipo="+tipo+"&nombre="+nombre+"&fojas="+fojas+"&vuelta="+vuelta+
       "&numero="+numero+"&ano="+ano+"&fecha_inscripcion="+fecha_inscripcion+"&folio_anterior="+
       folio_anterior+"&bien_familiar="+bien_familiar+"&litigio="+litigio;

       $.ajax({
        type: "POST",
        url: "newdata_propiedad.php",
        data: datas
      }).done(function( data ) {
        $('#info').html(data).fadeIn(1000);
        $('#info').html(data).delay(4000).fadeOut(2000);
//    $('#tipo').val(""); // vacia el contenido del campo texto
        viewdata();
      });
    });
});
