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
							</div><div id="Info2"></div><div id="Info"></div>
						</div><!-- fin Text input-->
						<div class="row">
							<div class="col-md-6">
								<!-- Select Basic -->
								<div class="form-group">
									<label class="col-md-6 control-label" for="tipo">Tipo Inscripción</label>
									<div class="col-md-5 form-inline">
										<select id="tipo0" name="tipo0" class="form-control">
											<?php
											while ($row1 = $result1->fetch_array()) 
											{

												?>
												<option value="<?php echo $row1['tipo_com']; ?>"><?php echo $row1['tipo_abr']; ?></option>
												<?php
											} ?>
										</select>
					<!--		  				<button type="button" class="btn btn-primary btn-xs" onclick="click_tipo()">+</button> -->
									</div>
									<!-- Text input   SOLO SI SE ELIGE OTRO TIPO DE INSCRIPCION-->
									<div class="form-group">
										<label class="col-md-6 control-label" for="tipo"></label>  
										<div class="col-md-6" id="id_tipo">
											<input type="text" id="tipo" name="tipo" class="form-control input-md" required="">
										</div>
									</div><!-- fin Text input-->
								</div>
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-6 control-label" for="nombre_prop">Nombre</label>  
									<div class="col-md-6">
										<input id="nombre_prop" name="nombre_prop" type="text" placeholder="Nombre propietario" class="form-control input-md" required=""/>
									</div>
								</div><!-- fin Text input-->
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-6 control-label" for="fojas">Fojas</label>  
									<div class="col-md-3">
										<input id="fojas" name="fojas" type="number" placeholder="Fojas" class="form-control input-md" required=""/>
									</div>
									<label class="checkbox-inline" for="vuelta">
										<input type="checkbox" name="vuelta" id="vuelta" value="v" /> vuelta
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
										<label class="radio-inline bien_familiar" for="bien_familiar-0">
											<input type="radio" name="bien_familiar" id="bien_familiar-0" value="N" checked="checked"/>
											No
										</label> 
										<label class="radio-inline bien_familiar" for="bien_familiar-1">
											<input type="radio" name="bien_familiar" id="bien_familiar-1" value="S"/>
											Si
										</label>
									</div>
								</div><!-- fin Multiple Radios (inline) -->

								<!-- Multiple Radios (inline) -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="Litigio">Litigio</label>
									<div class="col-md-3"> 
										<label class="radio-inline" for="Litigio-0">
											<input type="radio" name="litigio" id="litigio-0" value="N" checked="checked"/>
											No
										</label> 
										<label class="radio-inline" for="Litigio-1">
											<input type="radio" name="litigio" id="litigio-1" value="S"/>
											Si
										</label>
									</div>

								</div><!-- fin Multiple Radios (inline) -->

							</div>

						</div>

					</div>

				</div>

				<div class="form-inline"> 
					<label class="col-md-3 control-label" for="grabar_prop"></label>
					<div class="col-md-4">


						<button type="button" id="grabar_prop" name="grabar_prop" class="btn btn-success">Grabar</button><div id="respuesta"></div>
					</div>
					<button type="button" id="boton_hipoteca_prop" name="boton_hipoteca_prop" class="btn btn-primary" >Agregar Hipoteca</button>
					<button type="button" id="boton_prohibicion_prop" name="boton_prohibicion_prop" class="btn btn-primary">Agregar Prohibicion</button>

				</div>

 
			</fieldset>
		</form>
		<div id="info"></div>
		<div id="viewdata"></div>


	</div> <!-- /container -->
	<footer class="footer">
		<?php  include('footer.html'); ?> 
	</footer>

</body>
</html>