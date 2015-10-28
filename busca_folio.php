<?php
// DETECTA SI EL FOLIO ESTA REPETIDO EN LA BASE DE DATOS AL MOMENTO DE ESCRIBIRLO
sleep(1);
include('conexion/folio.php');
if($_REQUEST) {
    $folio = $_REQUEST['folio'];
    $query = "select * from propiedad where FOLIO = '$folio)'";
 	$result1 = $conexion->query($query); //usamos la conexion para dar un resultado a la variable
	$total_registros=$result1->num_rows;
    if($total_registros > 0)
    	echo "existe";
//        echo '<div id="Error" class="text-danger"><span class="glyphicon glyphicon-remove"></span> Folio ya existente</div>';
    else
    	echo "no existe";
//        echo '<div id="Success" class="text-success"><span class="glyphicon glyphicon-ok"></span> Folio disponible</div>';
}
?>