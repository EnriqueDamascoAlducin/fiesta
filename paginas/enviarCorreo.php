<?php 
require_once "phpqrcode/qrlib.php";
require_once "conexion.php";
$hora = time();
$dir ="codigos/";
if(!file_exists($dir)){
	mkdir($dir);
}
$invitadosID = $_POST['invitados'];
$invitados ="";
for ($i=0; $i < sizeof($invitadosID); $i++) { 
	$invitados.= $invitadosID[$i].',';
}
$invitados=substr($invitados, 0, strlen($invitados)-1);
$archivo =  $hora.'.png';
$filename = $dir.'Invitacion'.$hora.'.png';
$tamanio = 10;
$level = 'M';
$framezise = 3;
$contenido = '$_POST';
QRcode::png($contenido,$filename,$level,$tamanio,$framezise);
//echo '<img src="'.$filename.'">';
$afectados = $con->actualizar("invitados","codigo='".$archivo."'","id in (".$invitados.")");
echo $afectados;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Invitacion</title>
</head>
<body>
	<table style="width: 100%;max-width: 100%;" border="1">
		<thead>
			<tr>
				<th colspan="5"><b><i>Graduación - Generación 2015-2020</i></b></th>
			</tr>	
			<tr>
				
			</tr>
		</thead>
	</table>
</body>
</html>