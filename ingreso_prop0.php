<!DOCTYPE html>
<!--   FORMULARIO DE INGRESO AL FOLIO REAL    -->
<html lang="es">
<head>
	<?php  include('header.html'); 	
    include('conexion/folio.php');
    $sql1="SELECT * FROM tipo_propiedad "; //consulta sql
    $result1 = $conexion->query($sql1); //usamos la conexion para dar un resultado a la variable
	?>

<script type="text/javascript">  
jQuery(function($) {  

 
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
                  $('#Info').fadeIn(500).html('<div id="Error" class="text-danger"><span class="glyphicon glyphicon-remove"></span> Folio ya existe</div>');
                  $('#folio').focus();
                  $('#folio').select();

                }else{
                  $('#Info').fadeIn(500).html('<div id="Success" class="text-success"><span class="glyphicon glyphicon-ok"></span> Folio disponible</div>');
                }
            }
        });
    }); 

    $.datepicker.setDefaults($.datepicker.regional["es"]);
    $( "#date-picker" ).datepicker({ 
      dateFormat: "dd-mm-yyyy",
      changeYear: true,
      changeMonth: true,
      yearRange: "1900:2099",
      firstDay: 1, //  1=Lunes
      dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
      monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
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

    
});    


function click_hipoteca () {
	alert("Presionó botón Hipoteca");
}
function click_prohibicion () {
	alert("Presionó botón Prohibición");
}
function click_tipo () {
	alert("Presionó botón Agregar Tipo Inscripción");
}

</script>


</head>
<body>
	<div class="container miformulario">  




		<form id="form1" class="form-horizontal" action="ingreso_propiedad1.php" method="post" >
			<fieldset>

				<!-- Form Name -->
				<legend class="titulo_certificado">Ingreso de Propiedad</legend>



				<div class="row well clearfixq">
					<div class="col-md-16">
						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="folio">Folio Real</label>  
							<div class="col-md-2">
								<input id="folio" name="folio" type="text" placeholder="N° Folio Real" class="form-control input-md" required autofocus  />
							</div><div id="Info"></div>
						</div><!-- fin Text input-->
						<div class="row">
							<div class="col-md-6">
								<!-- Select Basic -->
								<div class="form-group">
									<label class="col-md-6 control-label" for="tipo">Tipo Inscripción</label>
									<div class="col-md-5 form-inline">
										<select id="tipo" name="tipo" class="form-control">
											<?php
											while ($row1 = $result1->fetch_array()) 
											{

												?>
												<option value="<?php echo $row1['tipo_com']; ?>"><?php echo $row1['tipo_abr']; ?></option>
												<?php
											} ?>
										</select>
											<button type="button" class="btn btn-primary btn-xs" onclick="click_tipo()">+</button>
									</div>
								</div>
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-6 control-label" for="nombre">Nombre</label>  
									<div class="col-md-6">
										<input id="nombre" name="nombre" type="text" placeholder="Nombre propietario" class="form-control input-md" required=""/>
									</div>
								</div><!-- fin Text input-->
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-6 control-label" for="fojas">Fojas</label>  
									<div class="col-md-3">
										<input id="fojas" name="fojas" type="number" placeholder="Fojas" class="form-control input-md" required=""/>
									</div>
									<label class="checkbox-inline" for="vuelta-0">
										<input type="checkbox" name="vuelta" id="vuelta-0" value="v" /> vuelta
									</label>
								</div><!-- fin Text input-->
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-6 control-label" for="numero">Número</label>  
									<div class="col-md-3">
										<input id="numero" name="numero" type="number" placeholder="Número" class="form-control input-md" required=""/>
									</div>
								</div><!-- fin Text input-->
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-6 control-label" for="ano">Año</label>  
									<div class="col-md-3">
										<input id="ano" name="ano" type="text" placeholder="Año" class="form-control input-md" required=""/>
									</div>
								</div><!-- fin Text input-->
								<!-- Button -->

							</div>

							<div class="col-md-6">
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="folio_anterior">Folio Anterior</label>  
									<div class="col-md-3">
										<input id="folio_anterior" name="folio_anterior" type="text" placeholder="folio anterior" class="form-control input-md" />
									</div>
								</div><!-- fin Text input-->
								<!-- Text input-->
								<div class="form-group">
									<label class="control-label col-md-3">Fecha Primera Inscripción</label> 
									<div class="col-md-5">  
										<input id="fecha_inscripcion" value="dd-mm-aaaa" name="fecha_inscripcion" type="text" class="form-control input-md" placeholder="dd-mm-aaaa" maxlength="10"/>
										<span class="help-block">dd-mm-aaaa = 30 años </span>
									</div><div id="msg_fecha"></div>
								</div> <!-- fin Text input-->
								<!-- Multiple Radios (inline) -->


								<div class="form-group">
									<label class="col-md-3 control-label" for="bien_familiar">Bien Familiar</label>
									<div class="col-md-3"> 
										<label class="radio-inline" for="bien_familiar-0">
											<input type="radio" name="bien_familiar" id="bien_familiar-0" value="no" checked="checked"/>
											No
										</label> 
										<label class="radio-inline" for="bien_familiar-1">
											<input type="radio" name="bien_familiar" id="bien_familiar-1" value="si"/>
											Si
										</label>
									</div>
								</div><!-- fin Multiple Radios (inline) -->

								<!-- Multiple Radios (inline) -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="Litigio">Litigio</label>
									<div class="col-md-3"> 
										<label class="radio-inline" for="Litigio-0">
											<input type="radio" name="litigio" id="litigio-0" value="no" checked="checked"/>
											No
										</label> 
										<label class="radio-inline" for="Litigio-1">
											<input type="radio" name="litigio" id="litigio-1" value="si"/>
											Si
										</label>
									</div>

								</div><!-- fin Multiple Radios (inline) -->

							</div>

						</div>

					</div>

				</div>

				<div class="form-group"> 
					<label class="col-md-3 control-label" for="grabar"></label>
					<div class="col-md-4">
						<button id="grabar" name="grabar" class="btn btn-success">Grabar</button>
					</div>
					<button type="button" id="boton_hipoteca" name="boton_hipoteca" class="btn btn-primary" onclick="click_hipoteca()">Agregar Hipoteca</button>
					<button type="button" id="boton_prohibicion" name="boton_prohibicion" class="btn btn-primary" onclick="click_prohibicion()">Agregar Prohibicion</button>

				</div>
				<div class="datos"></div>

 


<div class="container miformulario"> 

	<h3>Datos grabados</h3>
	<?php include('getdata_propiedad.php'); ?>

</div>


			</fieldset>
		</form>


	</div> <!-- /container -->
	<footer class="footer">
		<?php  include('footer.html');  
		?> 
	</footer>

</body>
</html>