<?php
 include('funciones.php');
 session_start();
 sesion();
include('conexion/folio.php');
if($_REQUEST) {
    $folio = $_REQUEST['folio'];
    $tipo = utf8_decode($_REQUEST['tipo']);
    $nombre = mb_strtoupper (quitar_tildes($_REQUEST['nombre']));
    $fojas = $_REQUEST['fojas'];
    $vuelta = $_REQUEST['vuelta'];
    $numero = $_REQUEST['numero'];
    $ano = $_REQUEST['ano'];
    $folio_anterior = $_REQUEST['folio_anterior'];
    $fecha_inscripcion = $_REQUEST['fecha_inscripcion'];
        $var_dia=substr($fecha_inscripcion,0,2)."<br>";
        $var_mes=substr($fecha_inscripcion,3,2)."<br>";
        $var_ano=substr($fecha_inscripcion,6,4)."<br>";
    if ($fecha_inscripcion=="") {
        $fecha_inscripcion="dd-mm-aaaa";
    }else{
        if(checkdate($var_mes,$var_dia,$var_ano)){
            echo utf8_decode("Fecha válida");

        }else{
            echo "fecha erronea";
        }
    }
    $bien_familiar = $_REQUEST['bien_familiar'];
    $litigio = $_REQUEST['litigio'];

}
echo $folio."<br>";
echo $tipo."<br>";
echo $nombre."<br>";
echo $fojas."<br>";
echo $vuelta."<br>";
echo $numero."<br>";
echo $ano."<br>";
echo $folio_anterior."<br>";
echo $fecha_inscripcion."<br>";
echo $bien_familiar."<br>";
echo $litigio."<br>";
?>