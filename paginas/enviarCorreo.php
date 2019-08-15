<?php 
require_once "phpqrcode/qrlib.php";
require_once "conexion.php";
$hora = time();
$dir ="codigos/";
$titulo = "Invitado de ";

if(!file_exists($dir)){
	mkdir($dir);
}
$invitadosID = $_POST['invitados'];
if(sizeof($invitadosID)>1){
	$titulo = "Invitados de ";
}
$invitados ="";
for ($i=0; $i < sizeof($invitadosID); $i++) { 
	$invitados.= $invitadosID[$i].',';
}
$invitados=substr($invitados, 0, strlen($invitados)-1);
$archivo = 'Invitacion'.$hora.'.png';
$filename = $dir.'Invitacion'.$hora.'.png';
$tamanio = 10;
$level = 'L';
$framezise = 1;
$info ="";
$invitadosInfo = $con->consulta ("nombre, tipo","invitados","id in($invitados)");
foreach ($invitadosInfo as $invitadoInfo) {
	$tipo="";
	if($invitadoInfo->tipo == 'A'){
		$tipo = "Adulto";
	}else if($invitadoInfo->tipo="B"){
		$tipo = "Bebé";
	}else if ($invitadoInfo->tipo == "N") {
		$tipo = "Niño/a";
	}
	$info .= $invitadoInfo->nombre . ' ('.$tipo.'),';
}

$info=substr($info, 0, strlen($info)-1);
$graduado = $con->consulta("CONCAT(g.nombre, ' ',g.apellidos) as nombre, m.mesa,g.correo","graduados g INNER JOIN invitados i on i.graduado = g.id INNER JOIN mesas m ON i.mesa = m.id","i.id in ($invitados)");
$contenido = $titulo . $graduado[0]->nombre . ": ". $info.'.'.$graduado[0]->mesa;
QRcode::png($contenido,$filename,$level,$tamanio,$framezise);
//$afectados = $con->actualizar("invitados","codigo='".$archivo."'","id in (".$invitados.")");
$ruta = $_SERVER['DOCUMENT_ROOT'].'/fiesta/paginas/';
$cuerpo ='
<!DOCTYPE html>
<html>
<head>
	<title>Invitacion</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<style type="text/css">
	a{
		color:black;
	}
	a:visited{
		color:black;
	}
</style>

</head>
<body>
	<table style="width: 100%;background-image: url(\'https://siswebs.com.mx/fiesta/paginas/images/salon.jpg\');background-repeat: no-repeat;background-size: 100%;background-clip: content-box; " >
		<tr>
			<th colspan="2" style="vertical-align: top;" >
				<img src="https://siswebs.com.mx/fiesta/paginas/images/logotec.png" style=" max-height: 140px;height: 150px">
			</th>
			<th colspan="4"  valign="center" style="vertical-align: top;">
				<h1 class="agile-head text-center" style="font-size: 23px;color:#000  ;" > Graduación </h1>
				<h1 class="agile-head text-center" style="font-size: 22px;color:#000  ;" > Ingeniería en Sistemas Computacionales </h1>
			</th>
			
			<th colspan="2" style="vertical-align: top;" >
				<img src="https://siswebs.com.mx/fiesta/paginas/images/sist.png" style="max-height: 140px;height: 150px">
			</th>
		</tr>	
		<tr>
			<th style="text-align:center" colspan="8">
				<h1 class="agile-head text-center" style="font-size: 21px;color: #000 ;" > Generación 2015 - 2020 </h1>	
			</th>
		</tr>
		<tr>
			<td colspan="2" style="text-align: left;">
				<h1 class="agile-head text-center" style="font-size: 22px;color:#000 ; " >Fecha</h1>
			</td>
			<td colspan="4" style="text-align: left;">
				<h1 class="agile-head text-center" style="font-size: 20px;color: #000 ; " >17 de Agosto de 2019 </h1>
			</td>
			<td colspan="2">
				<h1 class="agile-head text-center" style="font-size: 20px;color: #000 ; " >20:00h </h1>
			</td>
		</tr>
			
		<tr>

			<td colspan="2" valign="center" style="vertical-align: middle;">
				<h1 class="agile-head text-center" style="font-size: 19px;;color: #000 ;" >Graduado </h1>
				
			</td>
			<td colspan="4" valign="center" style="vertical-align: middle;">
				<h1 class="agile-head text-center" style="font-size: 19px;;color: #000 ;" >'. $graduado[0]->nombre .' </h1>
			</td>
			<td colspan="2">
				
				<h1 class="agile-head text-center" style="font-size: 20px;;color: #000 ;" >'.  $graduado[0]->mesa .' </h1>
			</td>
		</tr>
		<tr>
			<td colspan="5" valign="center" style="vertical-align: middle;">
				<a href="https://www.google.com/maps/dir//Sal%C3%B3n+y+Jard%C3%ADn+Quinta+Para%C3%ADso.,+Rosa+Violeta+1,+Granjas+Lomas+de+Guadalupe,+54760+Cuautitl%C3%A1n+Izcalli,+M%C3%A9x./@19.6217487,-99.2285937,17z/data=!4m16!1m6!3m5!1s0x85d21e790d5b7d89:0x41badbba1a96b63!2zU2Fsw7NuIHkgSmFyZMOtbiBRdWludGEgUGFyYcOtc28u!8m2!3d19.6217437!4d-99.226405!4m8!1m0!1m5!1m1!1s0x85d21e790d5b7d89:0x41badbba1a96b63!2m2!1d-99.226405!2d19.6217437!3e1">
					<h1 class="agile-head text-center" style="font-size: 15px;;color: #000; " >
						Dirección: Rosa Violeta 1, 
							Grajas Lomas de Guadalupe, 54760, Cuautitlan Izcalli
						 </h1>
				</a>
				<a href="https://www.google.com/maps/@19.6215693,-99.2263385,3a,75y,256.94h,91.57t/data=!3m6!1e1!3m4!1sZt02fe9pTITIe3o1eRSwBQ!2e0!7i13312!8i6656">
					<h1 class="agile-head text-center" style="font-size: 15px;;color: #000; " >
						Vista
					 </h1>
				 </a>
			</td>
			<td colspan="3" style="align-items: center; text-align: right;vertical-align: middle;" >
				<img src="https://siswebs.com.mx/fiesta/paginas/'. $filename.'" style="max-width: 100%;max-height: 150px;">
			</td>
		</tr>
	</table>
</body>
</html>';
echo $cuerpo;
$asunto = "Invitación";
$correoTo = $_POST['correo'];
$correoFrom = $graduado[0]->correo;
$nameFrom = $graduado[0]->nombre;
	include_once 'PHPMailer/mail.php';
?>
