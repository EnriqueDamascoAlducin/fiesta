<?php 
	include_once 'conexion.php';
	if(isset($_POST['contrasena']) && isset($_POST['email'])){
		$graduado = $con->consulta("*","graduados","id='".$_POST['contrasena']."' and correo ='".$_POST['email']."'");
		if (sizeof($graduado)<=0) {
			header("Location: index.php");
			exit();
		}
		$mesas = $con->consulta("m.mesa, lm.lugares, m.id","lugaresxMesa lm INNER JOIN mesas m ON m.id=lm.mesa","graduado=".$graduado[0]->id);
	}	
?>
<!DOCTYPE html>
<html>
<head>
<title>Fiesta</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<style type="text/css">
	.selectBonito{
		width: 50%;
		max-width: 49%;
		background-color: #0099CC;
		border-color:  #0099CC;
		color: white;
		height: 35px;
		box-sizing: border-box;
		float: left;

	}
	.selectBonito1{
		width: 49%;
		max-width: 49%;
		background-color: #0099CC;
		border-color:  #0099CC;
		color: white;
		height: 35px;
	}
	.selectBonito option{
		background-color: #2BBBAD;
	}
	.selectBonito option:hover{
		background-color: #00695c;
	}
	@media (max-width: 760px){
	.selectBonito{
		width: 100%;
		max-width: 100%;
		background-color: #0099CC;
		border-color:  #0099CC;
		color: white;
		height: 35px;
	}
	.selectBonito1{
		width: 100%;
		max-width: 95%;
		background-color: #0099CC;
		border-color:  #0099CC;
		color: white;
		height: 35px;
	}

	}
</style>
</head>
<body class="bg-agileinfo">
   <h1 class="agile-head text-center" >Graduación 17/Agosto/2019</h1>
	<div class="container-w3">
		<div class="w3ls-subhead">
			<i class="fa fa-clock-o" aria-hidden="true"></i>
		</div>
		<h2 style="background: lightblue">
		<?php
			if(!isset($_POST['contrasena']) && !isset($_POST['email'])){
			 ?>Pronto...!
		<?php } else { ?>
		
		<?php echo $graduado[0]->nombre. " ".$graduado[0]->apellidos; } ?>

		</h2>
		<div class="demo2"></div>
		<div class="content2-w3-agileits">
			<?php
			if(!isset($_POST['contrasena']) && !isset($_POST['email'])){
			 ?>
			   <form action="index.php" method="post" class="agile-info-form">
					<input type="email"  class="email" name="email" placeholder="Escribe tu Correo"   required="">
					<input type="password" class="email" name="contrasena" placeholder="Contraseña"   required="">
				
					<input type="submit" value="Entrar!">
				</form>	


			<hr>
			<br>
			<?php } else{ ?>
				<form  class="agile-info-form" onsubmit="enviarDatos(event)">
					<input type="hidden" id="graduado" value="<?php echo $graduado[0]->id; ?>">
					<select  class="selectBonito" id="mesas" onchange="verInvitados();">
						<option disabled selected="">Selecciona una mesa</option>
						<?php foreach ($mesas as $mesa) { ?>
							<option value="<?php echo $mesa->id ?>"><?php echo $mesa->mesa ?></option>
						<?php } ?>
					</select>
					<select multiple="" class=" select2 selectBonito1"  id="invitados">
						<option  disabled>Selecciona una mesa</option>
					</select>

					<input type="email"  class="email" name="email" id="correo" placeholder="A que correo se lo mandamos"   required="">
					<input type="submit" value="Enviar!">
					<p id="mensajeF" style="background-color: #ff4444;color:white"></p>
					<p id="mensajeOk" style="background-color:white;color:black"></p>
				</form>
			<?php } ?>
		</div>
		<div class="wthree-social-icons">
			<ul class="w3-links">
				
			</ul>
		</div>
	</div>	
    <div class="agileits-w3layouts-copyright text-center">
		<!--<p>© 2017 Inventive. All rights reserved | Design by <a href="//w3layouts.com/">W3layouts</a></p>-->
	</div>
	
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<!-- //js -->

	<link rel="stylesheet" href='css/dscountdown.css' type='text/css' media='all' />
	<!-- Counter required files -->
		<script type="text/javascript" src="js/dscountdown.min.js"></script>
		<script>					
			$('.demo2').dsCountDown({
				endDate: new Date("augost 17, 2019 20:00:00"),
				theme: 'black',
				titleDays:'Dias',
				titleHours:'Horas',
				titleMinutes:'Minutos',
				titleSeconds:'Segundos',
			});	

			$('.select2').select2();
			function verInvitados(){
				mesas=$("#mesas").val();
				graduado= $("#graduado").val();

		$("#invitados").empty();
		var1="id as value, nombre as text";
		var2="invitados";
		var3="codigo is null AND graduado="+graduado+" AND mesa="+mesas;
		$("#invitados").empty().append("<option value=''  disabled>Selecciona un invitado</option>");
		//abrir_gritter("a","select " + var1 + " from "+ var2+ " where " + var3, "info");
        parametros={var1:var1,var2:var2,var3:var3};
		$.ajax({
	      data: parametros,
	      dataType:"json",
	      url:'query_json.php',
	      type:"POST",
	      success: function(data){	
	        $.each( data, function( key, value ) {
			  text=value.text;
			  val=value.value;
			  $("#invitados").append("<option value='"+val+"' >"+text+"</option>");
			});
	      },
	      error:function(){
	      	alert("Error al cargar habitación");
	      }
		    });
		}
		function enviarDatos(e){
				$("#mensajeF").html('');
				$("#mensajeOk").html('');
			e.preventDefault();
			invitados= $("#invitados").val();
			mesa= $("#mesas").val();
			correo= $("#correo").val();
			graduado= $("#graduado").val();
			if(invitados==null){
				$("#mensajeF").html("Selecciona tus invitados");
				$("#invitados").focus();
				return false;
			}
			parametros={invitados:invitados,mesa:mesa,correo:correo,graduado:graduado};
			$.ajax({
		      data: parametros,
		      url:'enviarCorreo.php',
		      type:"POST",
		      success: function(data){	
				$("#mensajeOk").html(data);
		      },
		      error:function(){
		      	alert("Error al cargar habitación");
		      }
			});
		
			/*$("form")[0].reset();
		$("#invitados").empty();*/
		}
		</script>
	<!-- //Counter required files -->
</body>
</html>