<?php 
 include('funciones.php');
 session_start();
 sesion();



include('conexion/folio.php');
	// Variables rescatadas desde el formulario HTML 'vigencia_completa_0.php'
	$folio_form="";
	$fecha_ins=$_POST['fecha_ins'];
	$fecha_form=$_POST['fecha_form'];
	$periodo=30;
	$bien_familiar_sino='si';
	$litigio_sino='si';
	// Variable de Session que contiene las iniciales del funcionario obtenido de 'login.php'
	$iniciales=$_SESSION['iniciales'];

//echo "Folio Real N° : ".$folio_form."<br>";
//echo "Fecha emisión: ".$fecha_form."<br>";
//echo "Tipo Certificado : ".$opcion_form."<br>";
//echo "Iniciales funcionario : ".$iniciales."<br>";



$fecha_inscripcion=""; // inicializamos la variable que contendrá la fecha de la 1ª inscripción 

$fsalida="certificados/";  
	$fsalida.=$iniciales."_".$fecha_form."_grav_".$folio_form; 
//echo "Nombre del archivo : ".$fsalida."<br>";
//Buscar Folio en registro de PROPIEDAD ordenado por titulos sin repetir
$sql1="SELECT * FROM propiedad WHERE FOLIO ='$folio_form' GROUP BY FOJAS, VUELTA, NUMERO, ANO ORDER BY ANO, NUMERO"; //consulta sql
$result1 = $conexion->query($sql1); //usamos la conexion para dar un resultado a la variable
$row1 = $result1->fetch_array(); //Obtener el 1º registro para determinar el año de la 1ª Inscripción
$fecha_inscripcion=$row1['ANO_INS'];
$i=explode('/',$fecha_inscripcion); //extrae por separado el día, mes y año
$dia=$i[0]; 
$mes=$i[1]; 
$ano=$i[2]; 
$fecha_inscripcion=$dia."-".$mes."-".$ano;
if($dia=="dd" AND $mes="mm" AND $ano<>"aaaa") { ?>
        <script language="JavaScript"> 
            alert("Debe corregir la fecha de la primera Inscripci\u00F3n.");
            window.location="gravamen_0.php"; 
        </script>
    <?php
    exit;
}

// calcular fecha de la 1° inscrpción
$primera_inscripcion="durante 30 años hasta hoy, "; //inicializa por defecto a 30 años (Hipot. y Proh.)
$primera_inscripcion2="de 30 años hasta hoy, "; //inicializa por defecto a 30 años (Litigio)
$fecha = cambiaf_a_mysql($fecha_form);
$nuevafecha = strtotime('-'.$periodo.' year',strtotime($fecha)); //restar el periodo a la fecha de la emisión
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
if ($fecha_inscripcion<>"dd-mm-aaaa") {   //tiene fecha de 1° insc.
	// calcular la diferencia entre las fechas actual y 1° insc. 
	$fecha1 = new DateTime(cambiaf_a_mysql($fecha_inscripcion)); //fecha de la 1° inscripción
	$fecha2 = new DateTime($nuevafecha); //fecha actual - periodo 
	if($fecha1>=$fecha2) {

		$ano_busqueda=substr($fecha_inscripcion, -4);  //es el año para la busqueda de hipo y proh

		$primera_inscripcion="desde el ".fecha_certificado($fecha_inscripcion).", fecha de su primera inscripción hasta hoy, ";
		$primera_inscripcion2=$primera_inscripcion;
	}else{
		$ano_busqueda=substr($nuevafecha, 0, 4); //es el año para la busqueda de hipo y proh
		$primera_inscripcion="durante ".$periodo." años hasta hoy, "; //inicializa por defecto a 30 años
		$primera_inscripcion2="de ".$periodo." años hasta hoy, "; //inicializa por defecto a 30 años (Litigio)
	}
}else{
	$ano_busqueda=substr($nuevafecha, 0, 4); //es el año para la busqueda de hipo y proh
	$primera_inscripcion="durante ".$periodo." años hasta hoy, "; //inicializa por defecto a 30 años
	$primera_inscripcion2="de ".$periodo." años hasta hoy, "; //inicializa por defecto a 30 años (Litigio)
}


$result1->data_seek(0); //devuelve el puntero de la consulta sql al primer registro

//Buscar Folio en registro de PROPIEDAD ordenado por nombre sin repetir
$sql2="SELECT FOLIO, NOMBRE FROM propiedad WHERE FOLIO ='$folio_form' GROUP BY NOMBRE ORDER BY NOMBRE"; //consulta sql
$result2 = $conexion->query($sql2); //usamos la conexion para dar un resultado a la variable
$total_propiedad=$result2->num_rows;

//Buscar Folio en registro de HIPOTECA por orden cronológico
$sql3="SELECT FOLIO,TIPO,FOJAS, VUELTA, NUMERO, ANO, ACREEDOR FROM hipoteca WHERE FOLIO ='$folio_form' AND ANO>='$ano_busqueda' GROUP BY FOJAS, VUELTA, NUMERO, ANO ORDER BY ANO, NUMERO"; //consulta sql
$result3 = $conexion->query($sql3); //usamos la conexion para dar un resultado a la variable
$total_hipotecas=$result3->num_rows;

//Buscar Folio en registro de PROHIBICION por orden cronológico
$sql4="SELECT FOLIO,TIPO,FOJAS, VUELTA, NUMERO, ANO, ACREEDOR FROM prohibicion WHERE FOLIO ='$folio_form' AND ANO>='$ano_busqueda' GROUP BY FOJAS, VUELTA, NUMERO, ANO ORDER BY ANO, NUMERO"; //consulta sql
$result4 = $conexion->query($sql4); //usamos la conexion para dar un resultado a la variable
$total_prohibicion=$result4->num_rows;

if ($total_propiedad > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
		/*  Comandos RTF

			RTF code	Significado
			\\fs32   equivale a tamaño letra 16
			\\fs24   equivale a tamaño letra 12
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
		$output="{\\rtf1 \\paperh18710";   //<-- Iniciamos un documento RTF
		$output.= "\\margl1500"; //<-- márgenes izquierdo y derecho de las celdas=70
		$output.= "\\margr2000"; // <-- Posición izquierda la primera celda = -10
		$output.= "\\qc {\\fs32  {\\ul \\b CONSERVADOR DE BIENES RAICES DE CHILLAN}} ";
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "(".$iniciales.")".str_repeat(' ', 60)."{\\b Folio : ".$folio_form.".-} \\par ";  
		$output.= "\\qc {\\fs26  {\\ul \\b C E R T I F I C A D O S}} ";
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\qj {\\fs24 HIPOTECAS Y GRAVAMENES, INTERDICCIONES Y PROHIBICIONES, Y DE LITIGIOS, del inmueble inscrito }";
		// Determinar los títulos de dominio en orden cronológico
		$total_registros=$result1->num_rows;  //total de registro de la consulta
		$contador_registros=1;  //inicializamos la variable para contar la cantidad de
								// registros de la consulta para la comparación
		$bien_fam_encontrado=0;  //Inicializamos variable 0="no encontrado"   1="encontrado"
		$litigio_encontrado=0;  //Inicializamos variable 0="no encontrado"   1="encontrado"
	while ($row1 = $result1->fetch_array()) 
	{
		if ($total_registros==1) 
		{
			$output.= "a fojas ".$row1['FOJAS']." ".(($row1['VUELTA']=='v') ? 'vta.' : '')." número ".$row1['NUMERO'];  
			$output.= " del Registro de Propiedad del año ".$row1['ANO'].".-";  
		}
		elseif ($contador_registros<$total_registros)
		{
			$output.= "a fojas ".$row1['FOJAS']." ".(($row1['VUELTA']=='v') ? 'vta.' : '')." número ".$row1['NUMERO'];  
			$output.= " del Registro de Propiedad del año ".$row1['ANO'].", ";  
		}
		else
		{
			$output.= "y a fojas ".$row1['FOJAS']." ".(($row1['VUELTA']=='v') ? 'vta.' : '')." número ".$row1['NUMERO'];  
			$output.= " del Registro de Propiedad del año ".$row1['ANO'].".-";  			
		}
		$contador_registros=$contador_registros+1;
    	if ($row1['BIEN_FAM']=="S") { //si encuentra el bien familiar en cualquier título 
    		$bien_fam_encontrado=1;      // pone la variable en 1 (activado) hasta el final
    	}
    	if ($row1['LITIGIO']=="S") { //si encuentra el LITIGIO en cualquier título 
    		$litigio_encontrado=1;      // pone la variable en 1 (activado) hasta el final
    	}
    } //fin while de consulta ordenada por título
		$output.= " A nombre de: \\par ";  //<-- ENTER
		//Determinar los nombres de los propietarios en orden alfabético.-
//		while ($row2 = $result2->fetch_array()) 
//		{
		$row2 = $result2->fetch_array();
		if ($total_propiedad==1) {
			$output.= "{\\b * ".$row2['NOMBRE'].".- }";  
		} elseif ($total_propiedad==2) {
			$output.= "{\\b * ".$row2['NOMBRE']." y OTRO.- }";  
		} else {
			$output.= "{\\b * ".$row2['NOMBRE']." y OTROS.- }";  
		}
		
			$output.= "\\par ";  //<-- ENTER
//		}  //fin while de la consulta ordenada por nombre
		//MUESTRA LAS INSCRIPCIONES ENCONTRADAS EN HIPOTECA
		$output.= "\\fs24 \\qj Revisados los índices del Registro de Hipotecas y Gravámenes, ".$primera_inscripcion;
		$output.= "por los nombres y apellidos de las personas que han sido dueñas desde esa fecha ";  
		$output.= "hasta hoy, de la propiedad individualizada precedentemente, el Conservador ";  
		$output.= "de Bienes Raíces de la agrupación de las comunas de Chillán, Chillán Viejo, ";  
		$output.= "Coihueco y Pinto, Provincia de Ñuble, Octava Región, que suscribe, CERTIFICA: ";  
		if ($total_hipotecas==0) {
			$output.= "No haber encontrado inscripciones vigentes en dicho periodo.- \\par ";  //<-- ENTER
			$output.= str_repeat('/~/', 33)."\\par ";
		} elseif($total_hipotecas==1) {
			$output.= "Haber encontrado 1 inscripción vigente en dicho periodo.- \\par ";  //<-- ENTER
			$contador_hipotecas=0;
			while ($row3 = $result3->fetch_array()) 
			{
				$contador_hipotecas=$contador_hipotecas+1;
				$output.= $contador_hipotecas.".- ".$row3['TIPO']." a fojas ".$row3['FOJAS']." ".(($row3['VUELTA']=='v') ? 'vta.' : '')." número ".$row3['NUMERO']." en el Registro año ".$row3['ANO'].", a favor de ".trim($row3['ACREEDOR']).".-";  
				$output.= "\\par ";  //<-- ENTER
			}  //fin while de la consulta 
		} else {
			$output.= "Haber encontrado ".$total_hipotecas." inscripciones vigentes en dicho periodo.- \\par ";  //<-- ENTER
			$contador_hipotecas=0;
			while ($row3 = $result3->fetch_array()) 
			{
				$contador_hipotecas=$contador_hipotecas+1;
				$output.= $contador_hipotecas.".- ".$row3['TIPO']." a fojas ".$row3['FOJAS']." ".(($row3['VUELTA']=='v') ? 'vta.' : '')." número ".$row3['NUMERO']." en el Registro año ".$row3['ANO'].", a favor de ".trim($row3['ACREEDOR']).".-";  
				$output.= "\\par ";  //<-- ENTER
			}  //fin while de la consulta 
		}
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
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\tab \\tab \\tab \\tab \\tab \\tab \\tab  LUIS A. GONZALEZ ALVARADO";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\tab \\tab \\tab \\tab \\tab \\tab \\tab \\tab Conservador - Archivero";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		//MUESTRA LAS INSCRIPCIONES ENCONTRADAS EN PROHIBICION
		$output.= "\\fs24 \\qj Revisados igualmente, ".$primera_inscripcion."los índices del Registro de ";  
		$output.= "Interdicciones y Prohibiciones de Enajenar, por los mismos nombres y apellidos, el ";  
		$output.= "Conservador de Bienes Raíces de la agrupación de las comunas de Chillán, Chillán Viejo, ";  
		$output.= "Coihueco y Pinto, Provincia de Ñuble, Octava Región, que suscribe, CERTIFICA: ";  
		if ($total_prohibicion==0) {
			$output.= "No haber encontrado inscripciones vigentes en dicho periodo.- \\par ";  //<-- ENTER
			$output.= str_repeat('/~/', 33)."\\par ";
		} elseif($total_prohibicion==1) {
			$output.= "Haber encontrado 1 inscripción vigente en dicho periodo.- \\par ";  //<-- ENTER
			$contador_prohibicion=0;
			while ($row4 = $result4->fetch_array()) 
			{
				$contador_prohibicion=$contador_prohibicion+1;
				$output.= $contador_prohibicion.".- ".$row4['TIPO']." a fojas ".$row4['FOJAS']." ".(($row4['VUELTA']=='v') ? 'vta.' : '')." número ".$row4['NUMERO']." en el Registro año ".$row4['ANO'].", a favor de ".trim($row4['ACREEDOR']).".-";  
				$output.= "\\par ";  //<-- ENTER
			}  //fin while de la consulta 
		} else {
			$output.= "Haber encontrado ".$total_prohibicion." inscripciones vigentes en dicho periodo.- \\par ";  //<-- ENTER
			$contador_prohibicion=0;
			while ($row4 = $result4->fetch_array()) 
			{
				$contador_prohibicion=$contador_prohibicion+1;
				$output.= $contador_prohibicion.".- ".$row4['TIPO']." a fojas ".$row4['FOJAS']." ".(($row4['VUELTA']=='v') ? 'vta.' : '')." número ".$row4['NUMERO']." en el Registro año ".$row4['ANO'].", a favor de ".trim($row4['ACREEDOR']).".-";  
				$output.= "\\par ";  //<-- ENTER
			}  //fin while de la consulta 
		}
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
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\tab \\tab \\tab \\tab \\tab \\tab \\tab  LUIS A. GONZALEZ ALVARADO";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\tab \\tab \\tab \\tab \\tab \\tab \\tab \\tab Conservador - Archivero";  
		$output.= "\\par ";  //<-- ENTER
	if ($litigio_sino=="si") //condicional para imprimir el certificado litigio
	{
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		// MOSTRAR EL CERTIFICADO DE LITIGIO
		$output.= "\\fs24 \\qj Revisadas las inscripciones de dominio que forman los títulos ".$primera_inscripcion2."de la ";  
		$output.= "propiedad a que se refieren los Certificados anteriores, el Conservador de Bienes Raíces de la ";  
		$output.= "agrupación de las comunas de Chillán, Chillán Viejo, Coihueco y Pinto, Provincia de Ñuble, ";  
		$output.= "Octava Región, que suscribe, CERTIFICA: ";  
    	if ($litigio_encontrado==1) {
			$output.= "Que existe constancia en ellas que la propiedad es objeto de litigios.-";  
    	} else {
			$output.= "Que no hay constancia en ellas que la propiedad sea objeto de litigios.-";  
    	} 
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
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\tab \\tab \\tab \\tab \\tab \\tab \\tab  LUIS A. GONZALEZ ALVARADO";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\tab \\tab \\tab \\tab \\tab \\tab \\tab \\tab Conservador - Archivero";  
		$output.= "\\par ";  //<-- ENTER
	} //Fin de condicional para imprimir el litigio
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
	if ($bien_familiar_sino=="si") //condicional para imprimir el certificado Bien Familiar
	{
		$output.= "\\qc {\\ul \\b BIEN FAMILIAR} ";
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\fs24 \\qj El Conservador de Bienes Raíces de la agrupación de las comunas de Chillán, Chillán Viejo, ";  
		$output.= "Coihueco y Pinto, Provincia de Ñuble, Octava Región, que suscribe, CERTIFICA: Que al margen ";  
		$output.= "de la(s) inscripción(es) de "; 
		$result1->data_seek(0); //devuelve el puntero de la consulta sql al primer registro
		$contador_registros=1;  //inicializamos la variable para contar la cantidad de
								// registros de la consulta para la comparación
	while ($row1 = $result1->fetch_array()) 
	{
		if ($total_registros==1) 
		{
			$output.= "fojas ".$row1['FOJAS']." ".(($row1['VUELTA']=='v') ? 'vta.' : '')." número ".$row1['NUMERO'];  
			$output.= " del Registro de Propiedad del año ".$row1['ANO'].",";  
		}
		elseif ($contador_registros<$total_registros)
		{
			$output.= "fojas ".$row1['FOJAS']." ".(($row1['VUELTA']=='v') ? 'vta.' : '')." número ".$row1['NUMERO'];  
			$output.= " del Registro de Propiedad del año ".$row1['ANO'].", ";  
		}
		else
		{
			$output.= "y fojas ".$row1['FOJAS']." ".(($row1['VUELTA']=='v') ? 'vta.' : '')." número ".$row1['NUMERO'];  
			$output.= " del Registro de Propiedad del año ".$row1['ANO'].",";  			
		}

		$contador_registros=$contador_registros+1;
    } //fin while de consulta ordenada por título
    	if ($bien_fam_encontrado==1) {
    		$output.=" existe ";
    	} else {
    		$output.=" no hay ";
    	}
    	
    	$output.="constancia a la fecha de haber sido declarado bien familiar, de conformidad a la Ley Nº 19.335.-";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER   */
		$output.= "\\tab \\tab \\tab \\tab \\tab \\tab \\tab  LUIS A. GONZALEZ ALVARADO";  
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\tab \\tab \\tab \\tab \\tab \\tab \\tab \\tab Conservador - Archivero";  
	} //Fin de condicional para imprimir el bien familiar
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\par ";  //<-- ENTER
		$output.= "\\ql CHILLAN, Siendo las ".date("H:i")." Hrs. del ".fecha_certificado($fecha_form).".-"; 



		$output.="}"; //<-- Terminador del RTF
					
		/* En los encabezados indicamos que se trata de un documento de MS-WORD
		  y en el nombre de archivo le ponemos la extensión RTF.            */
		header('Content-type: application/msword');
		header('Content-Disposition: inline; filename='.$fsalida.".rtf"); 
		/*  Enviamos el documento completo a la salida  */
	
		echo utf8_decode($output); 						

}
else
{
?>
        <script language="JavaScript"> 
            alert("No se encontraron datos para este Folio Real.");
            window.location="gravamen_0.php"; 
        </script>
    <?php
    exit;   
}


				
					
?>

