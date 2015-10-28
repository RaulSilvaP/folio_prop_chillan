<!DOCTYPE html>
<html lang="es">
<head>
	<?php  include('header.html'); ?>
					

</head>
<body>
	<div class="container">
		<?php 
			$folio= $_POST['folio'];
			include("conexion/folio.php");
			//Buscar Folio en registro de PROPIEDAD
			$sql="SELECT * from propiedad WHERE folio='$folio' ORDER BY ANO, NUMERO, NOMBRE"; //consulta sql
			$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
			if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
			{

				echo "<p class='text-success'>Resultado de la busqueda para el Folio Real N° <strong class='enfacis'>".$folio."</strong><p><br>";
				echo "<div class='alert alert-success' role='alert'><strong class='text-danger'>Propiedad: ".$result->num_rows." Registro(s) encontrado(s).</strong><br>";
				echo "<table class='table table-striped'>
					<tbody>
					  <tr>
					  <th>Tipo</th>
					  <th>Nombre</th>
					  <th>Fojas</th>
					  <th>Número</th>
					  <th>Año</th>
					  <tr>";

			    while ($row = $result->fetch_array()) 
			    {
			    	echo " <tr>
					    <td>".$row['TIPO']."</td>
					    <td>".$row['NOMBRE']."</td>
					    <td>".$row['FOJAS'].' '.$row['VUELTA']."</td>
					    <td>".$row['NUMERO']."</td>
					    <td>".$row['ANO']."</td>
					  </tr>";

			    }
			    echo "</tbody>
				</table></div>";
			}
			else
			{
			    echo "<div class='alert alert-danger' role='alert'>No hubo resultados en Propiedad<br><br></div>";
			}

			//Buscar Folio en registro de HIPOTECA
			$sql="SELECT * from hipoteca WHERE folio='$folio' ORDER BY ANO, NUMERO, NOMBRE"; //consulta sql
			$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
			if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
			{

				echo "<div class='alert alert-success' role='alert'><strong class='text-danger'>Hipoteca: ".$result->num_rows." Registro(s) encontrado(s).</strong><br>";
				echo "<table class='table table-striped'>
					<tbody>
					  <tr>
					  <th>Tipo</th>
					  <th>Nombre</th>
					  <th>Fojas</th>
					  <th>Número</th>
					  <th>Año</th>
					  <th>Acreedor</th>
					  <tr>";

			    while ($row = $result->fetch_array()) 
			    {
			    	echo " <tr>
					    <td>".$row['TIPO']."</td>
					    <td>".$row['NOMBRE']."</td>
					    <td>".$row['FOJAS'].' '.$row['VUELTA']."</td>
					    <td>".$row['NUMERO']."</td>
					    <td>".$row['ANO']."</td>
					    <td>".$row['ACREEDOR']."</td>
					  </tr>";

			    }
			    echo "</tbody>
				</table></div>";
			}
			else
			{
			    echo "<div class='alert alert-danger' role='alert'>No hubo resultados en Hipoteca<br><br></div>";
			}


			//Buscar Folio en registro de PROHIBICION
			$sql="SELECT * from prohibicion WHERE folio='$folio' ORDER BY ANO, NUMERO, NOMBRE"; //consulta sql
			$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
			if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
			{

				echo "<div class='alert alert-success' role='alert'><strong class='text-danger'>Prohibición: ".$result->num_rows." Registro(s) encontrado(s).</strong><br>";
				echo "<table class='table table-striped'>
					<tbody>
					  <tr>
					  <th>Tipo</th>
					  <th>Nombre</th>
					  <th>Fojas</th>
					  <th>Número</th>
					  <th>Año</th>
					  <th>Acreedor</th>
					  <tr>";

			    while ($row = $result->fetch_array()) 
			    {
			    	echo " <tr>
					    <td>".$row['TIPO']."</td>
					    <td>".$row['NOMBRE']."</td>
					    <td>".$row['FOJAS'].' '.$row['VUELTA']."</td>
					    <td>".$row['NUMERO']."</td>
					    <td>".$row['ANO']."</td>
					    <td>".$row['ACREEDOR']."</td>
					  </tr>";

			    }
			    echo "</tbody>
				</table></div>";
			}
			else
			{
			    echo "<div class='alert alert-danger' role='alert'>No hubo resultados en Prohibición<br><br></div>";
			}

			$conexion->close(); //cerramos la conexión

		?>
	</div> <!-- /container -->
</body>
</html>