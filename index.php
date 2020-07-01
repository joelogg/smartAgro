<?php include ("partes/sesionStart.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SmartAgro</title>
	<link rel="icon" href="img/icono.png">
	<!--<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=1;" />-->
	<link rel="stylesheet" type="text/css" href="css/estiloInicio.css">
</head>
<body>
	<section>
		<img id="logo" src="img/logo.png">
		<span id="error" ></span>
		
			<table>
				<tr>
					<td><label>Usuario:</label> </td>
					<td><input type="text" id="usuario" autofocus></td>
				</tr>
				<tr>
					<td><label>Constraseña:</label></td>
					<td><input type="password" id="clave"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" id="boton" onclick="validar()" value="Iniciar"></td>
				</tr>		
			</table>
		
	</section>
	
<script>
console.log(window.innerWidth);
	 console.log(window.innerHeight);
function validar() 
{
	var usuario = document.getElementById("usuario").value;
	var clave = document.getElementById("clave").value;
console.log(usuario);
	
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

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	if(validar == "app")
	    	{//tamaño de la pantalla
	    		var ancho = screen.width;
	    		var alto = screen.height;
	    		//tamaño de la ventana
	    		/*var ancho = window.innerWidth; 
    			var alto = window.innerHeight;*/
	    		if(ancho>1300 && alto>700)
	    		{
	    			location.href="app/";
	    		}
	    		else
	    		{
	    			location.href="web/";
	    		}
	    	}
	    	else if(validar == "movil")
	    	{
	    		location.href="movil/";
	    	}
	    	else if(validar == "tablet")
	    	{
	    		location.href="web/";
	    	}
	    	else
	    	{
	    		document.getElementById("error").innerHTML = validar;
	    	}	      	
	    }
	};
	xhttp.open("GET", "partes/validarIniciarSesion.php?usuario="+usuario+"&clave="+clave, true);
	xhttp.send();
}

</script>
<script> 
	document.onkeypress = KeyPressed; 
	function KeyPressed(e) 
	{ 
		tecla = (document.all) ? e.keyCode :e.which;
	  	// si la tecla no es 13 devuelve verdadero,  si es 13 devuelve false y la pulsación no se ejecuta
	  	if(tecla!=13)
	  	{
	  		//console.log("no enter");
	  	}
	  	else
	  	{
	  		//console.log("enter");
	  		validar();
	  	}
	} 
</script>
</body>
</html>