<!DOCTYPE html>
<!--   FORMULARIO DE MODIFICACION AL FOLIO REAL  PROPIEDAD  -->
<html lang="es">
<head>
	<?php  include('header.html'); 	
	$folio = $_GET['folio'];
    include('conexion/folio.php');
    $sql1="SELECT * FROM tipo_propiedad "; //consulta sql
    $result1 = $conexion->query($sql1); //usamos la conexion para dar un resultado a la variable
    $sql2="SELECT * FROM acreedor ORDER BY acreedor_abr"; //consulta sql
    $result2 = $conexion->query($sql2); //usamos la conexion para dar un resultado a la variable
	?>
</head>
<body>
	<div class="container miformulario">  
 

		<form id="form1" class="form-horizontal" method="post" >
			<fieldset>

				<!-- Form Name -->
				<legend class="titulo_certificado">Modificar Propiedad</legend>



				<div class="row well clearfixq">
					<div class="col-md-16">
						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="folio">Folio Real</label>  
							<div class="col-md-2">
								<input id="folio_prop" name="folio_prop" type="text" value="<?php echo $folio; ?>"placeholder="N° Folio Real" class="form-control input-md" required autofocus  />
							</div>
            					<div class="col-md-1">
									<button type="button" id="mod_fol_prop" name="mod_fol_prop" class="btn btn-primary">Buscar</button>
								</div><div id="Info2"></div><div id="Info"></div>
						</div> 
 
					</div>   <!-- fin div columna 1 row   -->
				</div>
				<input type="hidden" id="nombre_script" name="nombre_script" value="mod_prop0" />
<!--
				<div class="form-inline"> 
					<label class="col-md-3 control-label" for="grabar"></label>
					<div class="col-md-4">
 

						<button type="button" id="grabar_hipo" name="grabar_hipo" class="btn btn-success">Grabar</button><div id="respuesta"></div>
					</div>
					<button type="button" id="boton_propiedad" name="boton_propiedad_hip" class="btn btn-primary" >Ingresar Propiedad</button>
					<button type="button" id="boton_prohibicion_hip" name="boton_prohibicion_hip" class="btn btn-primary" >Agregar Prohibición</button>
		
				</div>
 
--> 
			</fieldset>
		</form>
		<div id="info"></div>
		<div id="viewdata"></div>


	</div> <!-- /container -->
	<footer class="footer">
		<?php  include('footer.php'); ?> 
	</footer>

</body>
</html>