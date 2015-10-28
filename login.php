<?php 
include('conexion/cbr.php');

session_start();
$usuario = $_POST['usuario'];
$password = md5($_POST['password']);
$sql="SELECT * from funcionarios WHERE usuario='$usuario' AND password2='$password'"; //consulta sql
$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable

$row = $result->fetch_array();
if( $result->num_rows == 1 ) {
	echo 'true';
	$_SESSION['usuario'] = $row['usuario'];
	$_SESSION['funcionario'] = $row['nombre'];
	$_SESSION['iniciales'] = $row['iniciales'];	
	}
else {
	echo 'false';
}
 ?>