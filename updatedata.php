<?php
include ("conexion/folio.php");
if(isset($_GET['id'])){
$stmt = $conexion->prepare("update propiedad set TIPO=?, NOMBRE=?, FOJAS=?, NUMERO=?, ANO=? where id_propiedad=?");
$stmt->bind_param('ssssss', $tipo, $nombre, $fojas, $vuelta, $numero, $ano);

$tipo = $_POST['tipo'];
$nombre = $_POST['nombre'];
$fojas = $_POST['fojas'];
$vuelta = $_POST['vuelta'];
$numero = $_POST['numero'];
$ano = $_POST['ano'];
$id = $_GET['id'];

if($stmt->execute()){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Exito!</strong> Se han modificado los datos.
</div>
<?php
} else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Maaf terjadi kesalahan, data error.
</div>
<?php
}
} else{
?> 
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Warning!</strong> Maaf anda salah alamat.
</div>
<?php
}
?>