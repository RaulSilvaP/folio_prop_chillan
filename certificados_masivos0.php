<!DOCTYPE html>
<html lang="es">
<head>
	<?php  include('header.html'); 	
	?>
</head>
<body>
	<div class="container miformulario">  




<form id="form1" class="form-horizontal" action="certificados_masivos_1.php" method="post" >
<fieldset>

<!-- Form Name -->
<legend class="titulo_certificado">Certificados Masivos</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="fecha_ins">Fecha Inscripciones</label>  
  <div class="col-md-2">
  <input id="fecha_ins" name="fecha_ins" type="text" placeholder="dd-mm-aaaa" class="form-control input-md" required="">
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="fecha">Fecha Emisión</label>  
  <div class="col-md-4">
  <input id="fecha_form" value="<?php echo date('d-m-Y'); ?>" name="fecha_form"  type="text" placeholder="dd-mm-aaaa" class="form-control input-md">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="boton"></label>
  <div class="col-md-4">
    <button id="boton" name="boton" class="btn btn-success" >Generar Certificados</button>
  </div>
</div>

</fieldset>
</form>
    <footer class="footer">
      <?php  include('footer.html');  
      ?>
    </footer>


	</div> <!-- /container -->
</body>
</html>

