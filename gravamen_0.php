<!DOCTYPE html>
<html lang="es">
<head>
	<?php  include('header.html'); 	
	?>
</head>
<body>
	<div class="container miformulario">  




<form id="form1" class="form-horizontal" action="gravamen_1.php" method="post" >
<fieldset>

<!-- Form Name -->
<legend class="titulo_certificado">Certificado de Gravamen</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Folio_form">Folio Real</label>  
  <div class="col-md-2">
  <input id="Folio_form" name="folio_form" type="text" placeholder="N° Folio Real" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Appended Input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="periodo">Período</label>
  <div class="col-md-2">
    <div class="input-group">
      <input id="periodo" name="periodo" class="form-control" placeholder="" value="30" type="text" required="">
      <span class="input-group-addon">Años</span>
    </div>
    
  </div>
</div>

<!-- Multiple Radios (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="bien_familiar">Bien Familiar</label>
  <div class="col-md-4"> 
    <label class="radio-inline" for="bien_familiar-0">
      <input type="radio" name="bien_familiar" id="bien_familiar-0" value="si" checked="checked">
      Si
    </label> 
    <label class="radio-inline" for="bien_familiar-1">
      <input type="radio" name="bien_familiar" id="bien_familiar-1" value="no">
      No
    </label>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Litigio">Litigio</label>
  <div class="col-md-4"> 
    <label class="radio-inline" for="Litigio-0">
      <input type="radio" name="litigio" id="litigio-0" value="si" checked="checked">
      Si
    </label> 
    <label class="radio-inline" for="Litigio-1">
      <input type="radio" name="litigio" id="litigio-1" value="no">
      No
    </label>
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
    <button id="boton" name="boton" class="btn btn-success" >Generar Certificado</button>
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

