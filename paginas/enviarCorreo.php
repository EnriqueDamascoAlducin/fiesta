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
$graduado = $con->consulta("CONCAT(g.nombre, ' ',g.apellidos) as nombre, m.mesa","graduados g INNER JOIN invitados i on i.graduado = g.id INNER JOIN mesas m ON i.mesa = m.id","i.id in ($invitados)");
$contenido = $titulo . $graduado[0]->nombre . ": ". $info.'.'.$graduado[0]->mesa;
QRcode::png($contenido,$filename,$level,$tamanio,$framezise);
$afectados = $con->actualizar("invitados","codigo='".$archivo."'","id in (".$invitados.")");
$ruta = $_SERVER['DOCUMENT_ROOT'].'/fiesta/paginas/';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Invitacion</title>

<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
</head>
<body>
	<table style="width: 100%;max-width: 100%;" border="1">
		<tr>
			<th colspan="2" >
				<img src="images/logotec.png" style="max-width: 100%;max-height: 120px;">
			</th>
			<th colspan="3"  valign="center" style="vertical-align: middle;">
				<h1 class="agile-head text-center" style="font-size: 20px;color: black" >Graduación </h1>	
				<h1 class="agile-head text-center" style="font-size: 17px;color: black" > 2015 - 2020 </h1>
				<h1 class="agile-head text-center" style="font-size: 20px;color: black" >Salón y Jardín Quinta Paraiso </h1>
			</th>
			
			<th colspan="2" >
				<img src="images/isc.png" style="max-height: 170px;height: 150px">
			</th>
		</tr>	
		<tr>
			<td colspan="2" style="text-align: left;">
				<h1 class="agile-head text-center" style="font-size: 20px;color: black" >Fecha y Hora </h1>
			</td>
			<td colspan="3" style="text-align: left;">
				<h1 class="agile-head text-center" style="font-size: 18px;color: black" >17 de Agosto de 2019 </h1>
			</td>
			<td colspan="2">
				<h1 class="agile-head text-center" style="font-size: 18px;color: black" >08:00 pm </h1>
			</td>
		</tr>
			
		<tr>

			<td colspan="3" valign="center" style="vertical-align: middle;">
				<h1 class="agile-head text-center" style="font-size: 19px;;color: black" >Graduado </h1>
				<h1 class="agile-head text-center" style="font-size: 15px;;color: black" ><?php echo $graduado[0]->nombre ?> </h1>
				<h1 class="agile-head text-center" style="font-size: 20px;;color: black" ><?php echo $graduado[0]->mesa ?> </h1>
				<h1 class="agile-head text-center" style="font-size: 18px;;color: black" >
				Dirección: <BR>Rosa Violeta 1, 
				Grajas Lomas de Guadalupe, 54760,<br> Cuautitlan Izcalli
				 </h1>
			</td>
			<td colspan="4" style="align-items: center; text-align: right;vertical-align: middle;" >
				<img src="<?php echo $filename; ?>" style="max-width: 100%;max-height: 150px;">
			</td>
		</tr>
	</table>
</body>
</html>