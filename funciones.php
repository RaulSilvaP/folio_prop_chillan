<?php

//////////////////////////////////////////////////// 
//Convierte fecha de mysql a normal aaaa-mm-dd  -->  dd-mm-aaaa
//////////////////////////////////////////////////// 
function cambiaf_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
    return $lafecha; 
} 
 
 
//////////////////////////////////////////////////// 
//Convierte fecha de normal a mysql dd-mm-aaaa   --> aaaa-mm-dd
//////////////////////////////////////////////////// 

function cambiaf_a_mysql($fecha){ 
    ereg( "([0-9]{1,2})-([0-9]{1,2})-([0-9]{2,4})", $fecha, $mifecha);
	 	if (($mifecha[3]=="") OR ($mifecha[2]=="") OR ($mifecha[1]=="")) {$lafecha="";} else {
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];}
    return $lafecha; 
} 


function cambiaf_a_mysql2($fecha){ 
	$i=explode('-',$fecha); 
	$dia=$i[0]; 
	$mes=$i[1]; 
	$ano=$i[2]; 
  	$lafecha=$ano."-".$mes."-".$dia;
    return $lafecha; 
} 

function mes_a_palabra($fecha){
//PASAR EL MES DE LA FECHA DE NUMEROS A PALABRA
$i=explode('-',$fecha); 
$dia=$i[0]; 
$mes=$i[1]; 
$ano=$i[2]; 
  switch ($mes) {
    case "1":
        $mes_palabras="Enero";
      break;    
    case "2":
        $mes_palabras="Febrero";
      break;    
    case "3":
        $mes_palabras="Marzo";
      break;    
    case "4":
        $mes_palabras="Abril";
      break;    
    case "5":
        $mes_palabras="Mayo";
      break;    
    case "6":
        $mes_palabras="Junio";
      break;    
    case "7":
        $mes_palabras="Julio";
      break;    
    case "8":
        $mes_palabras="Agosto";
      break;    
    case "9":
        $mes_palabras="Septiembre";
      break;    
    case "10":
        $mes_palabras="Octubre";
      break;    
    case "11":
        $mes_palabras="Noviembre";
      break;    
    case "12":
        $mes_palabras="Diciembre";
      break;    
  }
return $mes_palabras; 
}

function fecha_certificado($fecha) {
//PASAR la fecha  A PALABRA   ej. 12-01-2014  ---> 12 de Enero de 2014
$i=explode('-',$fecha); 
$dia=$i[0]; 
$mes=$i[1]; 
$ano=$i[2]; 
$mes=mes_a_palabra($fecha);
$fecha_cert=$dia." de ".$mes." de ".$ano;
    return $fecha_cert; 
}


function sesion(){
    if ($_SESSION['funcionario']=="") {    ?>
        <script language="JavaScript"> 
            alert("Se ha cerrado la Sesión, debe volver a logearse");
            window.location="index.php"; 
        </script>
    <?php 
    }
}

function quitar_tildes($str) 
{ 
//  $str=utf8_decode($str);
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ'); 
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'Ç', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'Ñ', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'ç', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'ñ', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'Ñ', 'ñ', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o'); 
//  return utf8_decode(str_replace($a, $b, $str)); 
  return str_replace($a, $b, $str); 
} 



?>
