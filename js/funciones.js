    function viewdata(){
       $.ajax({ 
	   type: "GET",
	   url: "getdata_propiedad.php"
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