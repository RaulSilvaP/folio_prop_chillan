<?php
include ("conexion/conexion.php");
$inicial="rsp";

$registro = $_POST['registro'];
$tipo = $_POST['tipo'];
$repertorio = $_POST['repertorio'];
$nombre = $_POST['nombre'];
$fojas = $_POST['fojas'];
//$vuelta = $_POST['vuelta'];
//if ($vuelta!="v") {$vuelta=" ";}
$numero = $_POST['numero'];
$ano = $_POST['ano'];
$rol="";
$comuna="";

echo $nombre;
exit;

if($registro != null && $tipo != null && $nombre != null && $fojas != null 
	&& $numero != null && $ano != null && $repertorio != null ){
	$stmt = $conexion->prepare("INSERT INTO COMERCIO VALUES ('','',?,?,?,?,?,?,?,?,?,'')");  //debe contener la cantidad exacta de elementos de la base de datos
	$stmt->bind_param('sssssssss', $tipo, $nombre, $repertorio, $fojas, $numero, $ano, $rol, $comuna, $inicial);


if($stmt->execute()){
	?>

	<div id="Success" class="text-success"><span class="glyphicon glyphicon-ok"></span> Datos grabados</div>
<!--
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Exito!</strong> Los datos fueron grabados.
	</div>
-->	



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

	/*
	echo "falló el envío...<br/>";
	echo "<br>Folio :".$folio."<br>";
	echo "Tipo :".$tipo."<br>";
	echo "Nombre :".$nombre."<br>";
	echo "Fojas :".$fojas."<br>";
	echo "Vuelta :".$vuelta."<br>";
	echo "Número :".$numero."<br>";
	echo "Año :".$ano."<br>";
	echo "Acreedor :".$acreedor."<br>";
	exit;

*/

?> 
<div id="Error" class="text-danger"><span class="glyphicon glyphicon-remove"></span> Error, dato no fue grabadoererer</div>

<!--
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Advertencia!</strong> Existe algún problema de conexión.
</div> -->

<?php
}
?>