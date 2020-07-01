<?php include ("../partes/sesionStart.php"); ?>
<?php include ("../partes/seguridad.php"); ?>
<?php include ("../partes/conexion.php"); ?>
<!DOCTYPE html>
<html>
<head>
<SCRIPT LANGUAGE=Javascript> 
/*var menuIzquierdo = true;
function inhabilitar()
{ //inabilita el menu contextual
	if (menuIzquierdo)
	{
		return true;
	}
	else 
	{		
		menuIzquierdo = true;
		return false;
	}
} 
document.oncontextmenu=inhabilitar */
</SCRIPT> 

	<meta charset="utf-8">
	<title>SmartAgro</title>
	<link rel="icon" href="../img/icono.png">

	<link rel="stylesheet" type="text/css" href="css/estiloGeneral.css">
	<link rel="stylesheet" type="text/css" href="css/mapa.css">
	<link rel="stylesheet" type="text/css" href="css/infoDispositivo.css">
	<link rel="stylesheet" type="text/css" href="css/botonesGrafica.css">
	<link rel="stylesheet" type="text/css" href="css/valvulasSensores.css">

	<link rel="stylesheet" type="text/css" href="css/switchValvula.css">

	<link rel="stylesheet" type="text/css" href="css/popup.css">

	<script src="js/jquery.min.js"></script>
	<script src="js/Chart.js"></script>

	<script src="js/graficos.js"></script>
	<script src="js/seleccionarMenu.js"></script>
	<script src="js/desplegarSubMenu.js"></script>
	<script src="js/moverSeparador.js"></script>
	<script src="js/todoSVGCampo.js"></script>
	<?php include("js/subMenuContenido.php"); ?>

	<script src="js/funcionesDispositivos.js"></script>
	<script src="js/funcionesCampos.js"></script>
	<script src="js/funcionesCampo.js"></script>
	<script src="js/funcionesCultivos.js"></script>
	<script src="js/funcionesCultivo.js"></script>
	<script src="js/funcionesNutrientes.js"></script>
	<script src="js/funcionesNutriente.js"></script>
	<script src="js/funcionesNodosCor.js"></script>
	<script src="js/funcionesUnNodCoo.js"></script>
	<script src="js/funcionesNodosRut.js"></script>
	<script src="js/funcionesUnNodRut.js"></script>
	<script src="js/funcionesNodosTer.js"></script>
	<script src="js/funcionesValvula.js"></script>
	<script src="js/funcionesNodoTer.js"></script>

	<script src="js/funcionesMapa.js"></script>
	<script src="js/funcionesMapaDispositivos.js"></script>
	<script src="js/funcionesValvulasMenu.js"></script>
	<script src="js/funcionesSensoresMenu.js"></script>

	<!--Para capturar pantalla en imagen-->
	<script type="text/javascript" src="js/html2canvas.js"></script>
	<script type="text/javascript" src="js/jquery.plugin.html2canvas.js"></script>

	<!--POP UP-->
	<script type="text/javascript" src="js/popup.js"></script>
	<!--POP UP FIN-->	
	

	
</head>
<body onload="adaptarSVG(), seleccionarMenu(1), inicarActualizador()" OnResize="adaptarSVG(), adaptarSVGDispositivos() ">

<header>
	<?php include ("partes/cabecera.php"); ?>
</header>

<aside id="menuIzqueirda">
	<?php include ("partes/menuIzquierda.php"); ?>
</aside>

<!--Necesario para utilizar la funcion de generar captura de panta del canvas-->
<form method="POST" enctype="multipart/form-data" action="exportarDocumentos/save.php" id="myForm" 	target="_blank">
	<input type="hidden" name="img_val" id="img_val" value="" />
	<input type="hidden" name="idComponente" id="idComponente" value="" />
	<input type="hidden" name="tipoComponente" id="tipoComponente" value="" />
	<input type="hidden" name="tipoGuardado" id="tipoGuardado" value="" />
</form>
<!---->
<div id="mostrarMenuIzquierdo" onclick="mostrarMenuI()"></div>
<section id="cuerpo">	
	<?php include ("campos/getCamposMapa.php"); ?>
</section>

<!--POP UP  contenido-->

<div id="popupFondo" onclick="cerrarPopUp()">
</div>
<div id="popup">
	<div id="contenidoPopUp">
	</div>
	<button id="btnCerrarPopUp" onclick="cerrarPopUp();"></button>
</div>
<!--POP UP FIN-->
</body>

<script>
	var xhttp;
	if (window.XMLHttpRequest) 
	{
	    xhttp = new XMLHttpRequest();
	} 
	else 
	{
	    // code for IE6, IE5
	    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var xhttp2;
	if (window.XMLHttpRequest) 
	{
	    xhttp2 = new XMLHttpRequest();
	} 
	else 
	{
	    // code for IE6, IE5
	    xhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var xhttpAct0;
	if (window.XMLHttpRequest) 
	{
	    xhttpAct0 = new XMLHttpRequest();
	} 
	else 
	{
	    // code for IE6, IE5
	    xhttpAct0 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var xhttpAct1;
	if (window.XMLHttpRequest) 
	{
	    xhttpAct1 = new XMLHttpRequest();
	} 
	else 
	{
	    // code for IE6, IE5
	    xhttpAct1 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var xhttpAct2;
	if (window.XMLHttpRequest) 
	{
	    xhttpAct2 = new XMLHttpRequest();
	} 
	else 
	{
	    // code for IE6, IE5
	    xhttpAct2 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var xhttpAct3;
	if (window.XMLHttpRequest) 
	{
	    xhttpAct3 = new XMLHttpRequest();
	} 
	else 
	{
	    // code for IE6, IE5
	    xhttpAct3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var xhttpAct4;
	if (window.XMLHttpRequest) 
	{
	    xhttpAct4 = new XMLHttpRequest();
	} 
	else 
	{
	    // code for IE6, IE5
	    xhttpAct4 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var xhttpAct5;
	if (window.XMLHttpRequest) 
	{
	    xhttpAct5 = new XMLHttpRequest();
	} 
	else 
	{
	    // code for IE6, IE5
	    xhttpAct5 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var xhttpPopUp;
	if (window.XMLHttpRequest) 
	{
	    xhttpPopUp = new XMLHttpRequest();
	} 
	else 
	{
	    // code for IE6, IE5
	    xhttpPopUp = new ActiveXObject("Microsoft.XMLHTTP");
	}
</script>

<!--Funcion para capturar la grafica de canvas-->
<script>
	function capture(opcion) 
	{
		document.getElementById("tipoGuardado").value = opcion;
		$('#capturaPantalla').html2canvas(
		{
			onrendered: function (canvas) 
			{
                //Set hidden field's value to image data (base-64 string)
				$('#img_val').val(canvas.toDataURL("image/jpeg"));
                //Submit the form manually
				document.getElementById("myForm").submit();
			}
		});
	}
</script>

</html>