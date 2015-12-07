<option value="Todos">Todos</option>
<?php 
require('conexion/folio.php');   //todo el string de conexion a mysql... me quedo con el handler $db
$folio = $_GET['folio'];
$sql = "SELECT nombre FROM propiedad WHERE folio='$folio'"; //consulta sql
$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
while ($row = $result->fetch_array())
	{ ?>
		<option value="<?php echo $row['nombre']; ?>"><?php echo $row['nombre']; ?></option>
		
<?php } ?>
<option value="Otro">Otro</option>
