<!DOCTYPE html>
<html lang="es">
<head>
	<?php  include('header.html'); 	?>
</head>
<body>
	<div class="container miformulario">  




<form role="form" action="vigencia_completa_1.php" method="post">
	<legend class="titulo_certificado">Certificado de Vigencia completo</legend>
  <div class="form-group ">
    <label for="folio_formulario">Folio Real</label>
    <input type="text" class="form-control" id="folio_form" name="folio_form"
           placeholder="Introduce el N° del folio Real">
  </div>
  <div class="form-group">
    <label for="fecha_formulario">Fecha Emisión</label>
	<input class="form-control" size="16" type="text" id="fecha_form" value="<?php echo date('d-m-Y'); ?>" name="fecha_form" >
  </div>
  <div class="form-group">
    <label for="radio">Tipo de Certificado</label>
	<div class="radio">
	  <label>
	    <input type="radio" name="opcion_form" id="opciones_1" value="total" checked>
	    Total
	  </label>
	</div>
	<div class="radio">
	  <label>
	    <input type="radio" name="opcion_form" id="opciones_2" value="parcial">
	    Parcial
	  </label>
	</div>
   </div>
	  <button type="submit" class="btn btn-success">Generar Certificado</button>
</form>
	<br>
    <footer class="footer">
      <?php  include('footer.html');  
      ?>
    </footer>

	</div> <!-- /container -->

</body>
</html>