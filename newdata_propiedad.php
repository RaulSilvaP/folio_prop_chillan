<?php
include ("conexion/folio.php");
$nm = $_POST['nm'];
$gd = $_POST['gd'];
if($nm != null && $gd != null ){
$stmt = $conexion->prepare("INSERT INTO tabla1 VALUES ('',?,?)");
$stmt->bind_param('ss', $nm, $gd);


if($stmt->execute()){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Exito!</strong> Los datos fueron grabados.
</div>
<?php

} else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Los datos no fueron grabados.
</div>
<?php
}
} else{
?> 
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Advertencia!</strong> Existe algún problema de conexión.
</div>
<?php
}
?>