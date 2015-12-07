<?php 
include ("conexion/folio.php");

if(isset($_POST['id'])){
$stmt = $conexion->prepare("update propiedad set TIPO=?, NOMBRE=?, FOJAS=?, VUELTA=?, NUMERO=?, ANO=? where id_propiedad=?");
$stmt->bind_param('sssssss', $tipo, $nombre, $fojas, $vuelta, $numero, $ano, $id);

$tipo = $_POST['tipo'];
$nombre = $_POST['nombre_prop'];
$fojas = $_POST['fojas'];
$vuelta = $_POST['vuelta'];
$numero = $_POST['numero'];
$ano = $_POST['ano'];
$id = $_POST['id'];

if($stmt->execute()){

echo $nombre;


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
		<strong>Error!</strong> No se ha podido modificar la información.
	</div>
	<?php
}
}
?>