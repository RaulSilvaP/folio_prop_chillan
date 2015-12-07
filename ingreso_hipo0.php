<!DOCTYPE html>
<!--   FORMULARIO DE INGRESO AL FOLIO REAL    -->
<html lang="es">
<head>
	<?php  include('header.html'); 	
    include('conexion/folio.php');
    $sql1="SELECT * FROM tipo_hipoteca "; //consulta sql
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
				<legend class="titulo_certificado">Ingreso de Hipoteca</legend>



				<div class="row well clearfixq">
					<div class="col-md-16">
						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="folio_hip">Folio Real</label>  
							<div class="col-md-2">
								<input id="folio_hip" name="folio_hip" type="text" placeholder="N° Folio Real" class="form-control input-md" required autofocus  />
							</div><div id="Info2"></div><div id="Info"></div>
 					        <div class="form-group">
            					<div class="col-md-offset-4 col-md-4">
									<button type="button" id="buscar_fol" name="buscar_fol" class="btn btn-primary">Buscar</button>
								</div>
							</div>
						</div><!-- fin Text input-->
						<div id="ingreso_hipoteca" class="row" >    <!--   style="display: none;"  -->
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


 

								<!-- Select Basic -->
								<div class="form-group">
									<label class="col-md-6 control-label" for="tipo">Nombre</label>
									<div class="col-md-5 form-inline">
										<select id="nombre0" name="nombre0" class="form-control">
										</select>
									</div>
									<!-- Text input   SOLO SI SE ELIGE OTRO PROPIETARIO-->
									<div class="form-group">
										<label class="col-md-6 control-label" for="nombre"></label>  
										<div class="col-md-6" id="id_nombre">
											<input type="text" id="nombre" name="nombre" class="form-control input-md" required="">
										</div>
									</div><!-- fin Text input-->
								</div>


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

						</div>
 
					</div>

				</div>

				<div class="form-inline"> 
					<label class="col-md-3 control-label" for="grabar"></label>
					<div class="col-md-4">


						<button type="button" id="grabar" name="grabar" class="btn btn-success">Grabar</button><div id="respuesta"></div>
					</div>

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