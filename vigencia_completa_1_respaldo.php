<!DOCTYPE html>
<html lang="es">
<head>
	<?php  
		include('header.html');
		include('conexion/folio.php');
	?>
</head>
<body>
	<div class="container">

<?php 
	// Variables rescatadas desde el formulario HTML 'vigencia_completa_0.php'
	$folio_form=$_POST['folio_form'];
	$fecha_form=$_POST['fecha_form'];
	$opcion_form=$_POST['opcion_form'];
	// Variable de Session que contiene las iniciales del funcionario obtenido de 'login.php'
	$iniciales=$_SESSION['iniciales'];

//echo "Folio Real N° : ".$folio_form."<br>";
//echo "Fecha emisión: ".$fecha_form."<br>";
//echo "Tipo Certificado : ".$opcion_form."<br>";
//echo "Iniciales funcionario : ".$iniciales."<br>";




$fsalida="certificados/";  
	$fsalida.=$iniciales."_".$fecha_form."_vig_".$folio_form; 
//echo "Nombre del archivo : ".$fsalida."<br>";
//Buscar Folio en registro de PROPIEDAD ordenado por titulos sin repetir
$sql1="SELECT FOLIO,FOJAS, VUELTA, NUMERO, ANO FROM propiedad WHERE FOLIO ='$folio_form' GROUP BY FOJAS, VUELTA, NUMERO, ANO ORDER BY ANO, NUMERO"; //consulta sql
$result1 = $conexion->query($sql1); //usamos la conexion para dar un resultado a la variable

//Buscar Folio en registro de PROPIEDAD ordenado por nombre sin repetir
$sql2="SELECT FOLIO, NOMBRE FROM propiedad WHERE FOLIO ='$folio_form' GROUP BY NOMBRE ORDER BY NOMBRE"; //consulta sql
$result2 = $conexion->query($sql2); //usamos la conexion para dar un resultado a la variable

if ($result1->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
		/*  Comandos RTF

			RTF code	Significado
			\b	Negrita
			\i	Cursiva
			\u	Subrrayado
			\par	Retorno de Carro
			\qj	Justificar
			\ql	Alinear a la izquierda
			\qr	Alinear a la derecha
			\qc	Centrar
			\fsX	Tamaño de fuente donde X es el tamaño

			Los estilos de texto como bold se pueden delimitar de estas dos formas:

			{\b Mi texto }
			\b Mi texto \b0
			Y el funcionamiento es similar para el resto de tags de formato.

			Debemos etiquetar las lineas con el tag “\par ” para definir que es un párrafo o una linea del texto.

			Y en el inicio del documento tenemos que definir cual va a ser la fuente de la letra, y algunos parámetros más.

			Ejemplo de encabezamiento:

			{\rtf1\ansi\deff0{\fonttbl{\f0\froman Times New Roman;}{\f1\froman Palatino;}}
		*/
		/*  Comenzamos a armar el documento  */		
		$output="{\\rtf1 \\paperh18710 ";   //<-- Iniciamos un documento RTF
		$output.= "\\margl3000 "; //<-- márgenes izquierdo y derecho de las celdas=70
		$output.= "\\margr2541 "; // <-- Posición izquierda la primera celda = -10
/*			$output.= "\\fs24 \\qc {\\ul C E R T I F I C A D O S }    (".$iniciales.") \\par ";
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "{\\fs20 \\qj CERTIFICO: QUE LA PRESENTE COPIA SE ENCUENTRA CONFORME CON SU MATRIZ.- CHILLAN, ".$fecha_form.".-}";
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "LUIS A. GONZALEZ ALVARADO";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "Conservador - Archivero";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "{\\fs24 \\qc {\\ul CERTIFICADO DE INSCRIPCION } }";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "{\\fs20 \\qj El Conservador de Bienes Raíces de la agrupación de las comunas de }";  
		$output.= "Chillán, Chillán Viejo, Coihueco y Pinto, Provincia de Ñuble, Octava Región que ";
		$output.= "suscribe, Certifica, que el inmueble individualizado en la copia que precede, se ";
		$output.= "encuentra inscrito a fojas ".;  
		$total_registros=$result1->num_rows;  //total de registro de la consulta
		$contador_registros=1;  //inicializamos la variable para contar la cantidad de
								// registros de la consulta para la comparación
	while ($row1 = $result1->fetch_array()) 
	{
		if ($total_registros==1) 
		{
			$output.= $row1['FOJAS']." ".$row1['vuelta']." número ".$row1['NUMERO'];  
			$output.= " del Registro de Propiedad del año ".$row1['NUMERO'].".-";  
		}
		elseif ($contador_registros<$total_registros)
		{
			$output.= $row1['FOJAS']." ".$row1['vuelta']." número ".$row1['NUMERO'];  
			$output.= " del Registro de Propiedad del año ".$row1['NUMERO'].", ";  
		}
		else
		{
			$output.= "y a fojas ".$row1['FOJAS']." ".$row1['vuelta']." número ".$row1['NUMERO'];  
			$output.= " del Registro de Propiedad del año ".$row1['NUMERO'].".-";  			
		}
		$contador_registros=$contador_registros+1;
    } //fin while de consulta ordenada por título
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "CHILLAN, ".$fecha_form.".-"; 
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "LUIS A. GONZALEZ ALVARADO";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "Conservador - Archivero";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "{\\fs24 \\qc {\\ul CERTIFICADO DE VIGENCIA } }";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "{\\fs20 \\qj El Conservador de Bienes Raíces de la agrupación de las }";  
		$output.= "comunas de Chillán, Chillán Viejo, Coihueco y Pinto, ";  
		$output.= "Provincia de Ñuble, Octava Región que suscribe, Certifica, ";  
		$output.= "que la inscripción del inmueble, que en copia autorizada ";  
		$output.= "precede, se encuentra vigente a nombre de:";  
		$output.= "\\par ";  //<-- ENTER
	while ($row2 = $result2->fetch_array()) 
	{
		$output.= "{\\b * ".$row2['NOMBRE'].".- } \\par ";  
	}  //fin while de la consulta ordenada por nombre
		$output.= "Por no existir anotaciones marginales a la misma que ";  
		if ($opcion_form=="total") 
		{
			$output.= "indique su cancelación total ni parcial a esta fecha.-";
			}else{
			$output.= "indique su cancelación total a esta fecha.-";
		} 
		$output.= "\\par ";  //<-- ENTER
		$output.= "CHILLAN, ".$fecha_form.".-";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER   */
		$output.= "LUIS A. GONZALEZ ALVARADO";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "Conservador - Archivero";  
		$output.=" \page"; //salto pagina



		$output.="}"; //<-- Terminador del RTF
					
		/* En los encabezados indicamos que se trata de un documento de MS-WORD
		  y en el nombre de archivo le ponemos la extensión RTF.            */
		header('Content-type: application/msword');
		header('Content-Disposition: inline; filename='.$fsalida.".rtf"); 
		/*  Enviamos el documento completo a la salida  */
	
		echo $output; 						

}
else
{
    echo "No se encontraron datos para este Folio Real<br><br>";
}


				
					
?> <!-- Fin PHP -->








	</div> <!-- /container -->
</body>
</html>