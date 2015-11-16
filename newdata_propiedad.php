<?php
include ("conexion/folio.php");

$folio = $_POST['folio'];
$tipo = $_POST['tipo'];
$nombre = $_POST['nombre'];
$fojas = $_POST['fojas'];
$vuelta = $_POST['vuelta'];
if ($vuelta!="v") {$vuelta=" ";}
$numero = $_POST['numero'];
$ano = $_POST['ano'];
$fecha_inscripcion = $_POST['fecha_inscripcion'];
        $var_dia=substr($fecha_inscripcion,0,2);
        $var_mes=substr($fecha_inscripcion,3,2);
        $var_ano=substr($fecha_inscripcion,6,4);
    if ($fecha_inscripcion=="") {
        $fecha_inscripcion="dd/mm/aaaa";
    }else{
        $fecha_inscripcion=$var_dia."/".$var_mes."/".$var_ano;
    }

$folio_anterior = $_POST['folio_anterior'];
$bien_familiar = $_POST['bien_familiar'];
$litigio = $_POST['litigio'];

if($folio != null && $tipo != null && $nombre != null && $fojas != null 
	&& $numero != null && $ano != null && $fecha_inscripcion != null 
	&& $bien_familiar != null && $litigio != null ){
	$stmt = $conexion->prepare("INSERT INTO propiedad VALUES ('',?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param('sssssssssss', $folio, $ano, $tipo, $nombre, $fojas, $vuelta, $numero, $fecha_inscripcion,
	$folio_anterior, $bien_familiar, $litigio);


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
	echo "falló el envío...<br/>";
	echo "<br>Folio :".$folio."<br>";
	echo "Tipo :".$tipo."<br>";
	echo "Nombre :".$nombre."<br>";
	echo "Fojas :".$fojas."<br>";
	echo "Vuelta :".$vuelta."<br>";
	echo "Número :".$numero."<br>";
	echo "Año :".$ano."<br>";
	echo "Folio anterior :".$folio_anterior."<br>";
	echo "Fecha Insc. :".$fecha_inscripcion."<br>";
	echo "Bien Familiar :".$bien_familiar."<br>";
	echo "Litigio :".$litigio."<br>";
?> <!--
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Advertencia!</strong> Existe algún problema de conexión.
</div> -->

<?php
}
?>