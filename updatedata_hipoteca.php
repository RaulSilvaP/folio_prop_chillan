<?php 
include ("conexion/folio.php");

if(isset($_POST['id'])){
$stmt = $conexion->prepare("update hipoteca set TIPO=?, NOMBRE=?, FOJAS=?, VUELTA=?, NUMERO=?, ANO=?, ACREEDOR=? where id_hipoteca=?");
$stmt->bind_param('ssssssss', $tipo, $nombre, $fojas, $vuelta, $numero, $ano, $acreedor,  $id);

$tipo = $_POST['tipo'];
$nombre = $_POST['nombre'];
$fojas = $_POST['fojas'];
if($_POST['vuelta']=="v") {
	$vuelta="v";
}else{
	$vuelta = ' ';
}
$numero = $_POST['numero'];
$ano = $_POST['ano'];
$acreedor = $_POST['acreedor'];
$id = $_POST['id'];

  /*   //MUESTRA DATOS PARA DEPURAR LA RECEPCION DE DATOS DESDE AJAX
echo $id."<br/>";
echo $tipo."<br/>";
echo $nombre."<br/>";
echo $fojas."<br/>";
echo $vuelta."<br/>";
echo $numero."<br/>";
echo $ano."<br/>";
echo $acreedor."<br/>";
exit;

  */

 

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
		<strong>Error!</strong> No se ha podido modificar la información.
	</div>
	<?php
}
}
?>