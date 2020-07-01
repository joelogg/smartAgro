/**/
var camposOculto = false;
function checkCamposClic()
{
	var cant = document.getElementsByClassName("polygonCampo").length;
	if(camposOculto)
	{		
		for (var i=0; i<cant; i++)
		{
			document.getElementsByClassName("polygonCampo")[i].style.visibility="visible";
		}
		camposOculto = false;
	}
	else
	{		
		for (var i=0; i<cant; i++)
		{
			document.getElementsByClassName("polygonCampo")[i].style.visibility="hidden";
		}
		camposOculto = true;
	}	
}

var sensorOculto = false;
function checkSensoresClic() 
{
	var cant = document.getElementsByClassName("rectSensor").length;
	if(sensorOculto)
	{
		for (var i=0; i<cant; i++)
		{
			document.getElementsByClassName("rectSensor")[i].style.visibility="visible";
		}
		sensorOculto = false;
	}
	else
	{
		for (var i=0; i<cant; i++)
		{
			document.getElementsByClassName("rectSensor")[i].style.visibility="hidden";
		}
		sensorOculto = true;
	}	
}

var valculaOculta = false;
function checkValvulasClic()
{
	var cant = document.getElementsByClassName("rectValvula").length;
	if(valculaOculta)
	{		
		for (var i=0; i<cant; i++)
		{
			document.getElementsByClassName("rectValvula")[i].style.visibility="visible";
		}
		valculaOculta = false;
	}
	else
	{
		for (var i=0; i<cant; i++)
		{
			document.getElementsByClassName("rectValvula")[i].style.visibility="hidden";
		}
		valculaOculta = true;
	}	
}

var textoOculta = false;
function checkTextoClic()
{
	var cant = document.getElementsByClassName("textTexto").length;
	if(textoOculta)
	{		
		for (var i=0; i<cant; i++)
		{
			document.getElementsByClassName("textTexto")[i].style.visibility="visible";
		}
		textoOculta = false;
	}
	else
	{
		for (var i=0; i<cant; i++)
		{
			document.getElementsByClassName("textTexto")[i].style.visibility="hidden";
		}
		textoOculta = true;
	}
}


/*------over icono sensor en mapa*/
function overSensor(idCam)
{
	var cant = document.getElementsByClassName("valvulasCampo"+idCam).length;
	for (var i=0; i<cant; i++)
	{
		document.getElementsByClassName("valvulasCampo"+idCam)[i].style.visibility="hidden";
	}
}

/*------out icono sensor en mapa*/
function outSensor(idCam)
{
	var cant = document.getElementsByClassName("valvulasCampo"+idCam).length;
	for (var i=0; i<cant && valculaOculta==false; i++)
	{
		document.getElementsByClassName("valvulasCampo"+idCam)[i].style.visibility="visible";
	}
}

/*------over icono valvula en mapa*/
function overValvula(idCam)
{	
	var cant = document.getElementsByClassName("sensoresCampo"+idCam).length;
	for (var i=0; i<cant; i++)
	{
		document.getElementsByClassName("sensoresCampo"+idCam)[i].style.visibility="hidden";
	}
}

/*------out icono valvula en mapa*/
function outValvula(idCam)
{
	var cant = document.getElementsByClassName("sensoresCampo"+idCam).length;
	for (var i=0; i<cant && sensorOculto==false; i++)
	{
		document.getElementsByClassName("sensoresCampo"+idCam)[i].style.visibility="visible";
	}
}

function accionarSwitchValvulaMapa (idVal) 
{
	var accionSV = document.getElementById("switchValvula"+idVal).checked;
	var accVal="";
	if(accionSV==true)
		accVal="1";
	else
		accVal="0";

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	
	    	var validar = xhttp.responseText;
	    	console.log(validar);	    	
	    }
	};
	xhttp.open("GET", "valvula/accionarSwitchValvula.php?idVal="+idVal+"&accVal="+accVal, true);
	xhttp.send();
}