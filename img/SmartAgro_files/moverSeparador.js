var ancho = window.innerWidth;
var alto = window.innerHeight;
function onResizeVentana()
{
	ancho = window.innerWidth;
	alto = window.innerHeight;
}

/*---------Para la separador----------*/
var presionadoSeparador = false;
function mouseDownSeparador()
{
	presionadoSeparador = true;
	return false;
}

/*---------Para la sensor----------*/
var presionadoSensorMapa = false;
var idNodTerAux = "";
function mouseDownSensor(idNodTer)
{	
	idNodTerAux = idNodTer;
	presionadoSensorMapa = true;
	return false;
}

/*---------Para la valvula----------*/
var presionadoValvulaMapa = false;
var idValAux = "";
function mouseDownValvula(idVal, idCam)
{
	idValAux = idVal;
	presionadoValvulaMapa = true;
	return false;
}

/*--------Levantar el mouse para todos ------*/
function mouseUp()
{
	presionadoSeparador = false;	
	
	if(presionadoSensorMapa)
	{
		presionadoSensorMapa = false;
		guardarPuntosSensor();
	}
	if(presionadoValvulaMapa)
	{
		presionadoValvulaMapa = false;
		guardarPuntosValvula();
	}
}



function onMouseMove(e)
{
	/*---------Para la separador----------*/
	if (presionadoSeparador)
	{
		var nuevoX = e.clientX * 100 / ancho;
		if(5<nuevoX && nuevoX<50  )
		{
			document.getElementById("separador").style.left=nuevoX+"%";
			document.getElementById("menuIzqueirda").style.width=nuevoX+"%";
			document.getElementById("cuerpo").style.width=(99.5-nuevoX)+"%";
			adaptarSVG() ;
		}
		// Devolvemos false para no realizar ninguna acción posterior
		return false;
	}
	/*---------Para la sensor----------*/
	else if (presionadoSensorMapa)
	{
		var nuevoX = e.clientX;
		nuevoX = nuevoX- ancho*0.205;
		var nuevoY = e.clientY;
		nuevoY = nuevoY- alto*0.11;
		if(4.5<nuevoX)
		{
			document.getElementById("sensorCam"+idNodTerAux).style.left=(nuevoX-5)+"px";
		}
		if(4.5<nuevoY)
		{
			document.getElementById("sensorCam"+idNodTerAux).style.top=(nuevoY-5)+"px";
		}
		// Devolvemos false para no realizar ninguna acción posterior
		return false;
	}
	/*---------Para la valvula----------*/
	else if (presionadoValvulaMapa)
	{
		var nuevoX = e.clientX;
		nuevoX = nuevoX- ancho*0.205;
		var nuevoY = e.clientY;
		nuevoY = nuevoY- alto*0.11;
		if(4.5<nuevoX)
		{
			document.getElementById("valvulaCam"+idValAux).style.left=(nuevoX-5)+"px";
		}
		if(4.4<nuevoY)
		{
			document.getElementById("valvulaCam"+idValAux).style.top=(nuevoY-5)+"px";
		}
		// Devolvemos false para no realizar ninguna acción posterior
		return false;
	}
}
document.onmousemove = onMouseMove;
document.onmouseup = mouseUp;

window.onresize = onResizeVentana;



/*----------Guardar puntos Sensor-------------*/
function guardarPuntosSensor()
{
	var element = document.getElementById('imgMapa');
	var anchoSVG = element.offsetWidth;
	var altoSVG = element.offsetHeight;

	var x = document.getElementById("sensorCam"+idNodTerAux).style.left;
	var y = document.getElementById("sensorCam"+idNodTerAux).style.top;
	x = x.substring(0, (x.length-2) );
	y = y.substring(0, (y.length-2) );

	var posX = x*100/anchoSVG;
	var posY = y*100/altoSVG;

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	    	
	    	var validar = xhttp.responseText;
	    	console.log(validar);
	    }
	};
	xhttp.open("GET", "campos/guardarPuntosSensor.php?idNodTer="+idNodTerAux+"&posX="+posX+"&posY="+posY, true);
	xhttp.send();
}

/*----------Guardar puntos Valvula-------------*/
function guardarPuntosValvula()
{
	var element = document.getElementById('imgMapa');
	var anchoSVG = element.offsetWidth;
	var altoSVG = element.offsetHeight;

	var x = document.getElementById("valvulaCam"+idValAux).style.left;
	var y = document.getElementById("valvulaCam"+idValAux).style.top;
	x = x.substring(0, (x.length-2) );
	y = y.substring(0, (y.length-2) );

	var posX = x*100/anchoSVG;
	var posY = y*100/altoSVG;

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	    	
	    	var validar = xhttp.responseText;
	    	console.log(validar);
	    }
	};
	xhttp.open("GET", "campos/guardarPuntosValvula.php?idVal="+idValAux+"&posX="+posX+"&posY="+posY, true);
	xhttp.send();
}