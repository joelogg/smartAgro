var ancho = window.innerWidth;
var alto = window.innerHeight;
function onResizeVentana()
{
	ancho = window.innerWidth;
	alto = window.innerHeight;
}

/*---------Para saber habilitar mover sensor y valvula----------*/

/*---------Para la sensor----------*/
var presionadoSensorMapa = false;
var idNodTerAux = "";
function mouseDownSensor(idNodTer)
{	
	idNodTerAux = idNodTer;
	if(editarGraficos)
		presionadoSensorMapa = true;
	return false;
}

/*---------Para la valvula----------*/
var presionadoValvulaMapa = false;
var idValAux = "";
function mouseDownValvula(idVal)
{
	idValAux = idVal;
	if(editarGraficos)
		presionadoValvulaMapa = true;
	return false;
}

/*---------Para dispositivos----------*/
var presionadoDispositivoMapa = false;
var idDisAux = "", tipDisAux="";
function mouseDownDispositivo(idDis, tipDis)
{
	idDisAux = idDis;
	tipDisAux = tipDis;
	if(editarGraficoDispositivo)
		presionadoDispositivoMapa = true;
	return false;
}

/*--------Levantar el mouse para todos ------*/
function mouseUpDis()
{
	if(presionadoSensorMapa && editarGraficos==true)
	{
		presionadoSensorMapa = false;
		guardarPuntosSensor();
	}
	if(presionadoValvulaMapa && editarGraficos==true)
	{
		presionadoValvulaMapa = false;
		guardarPuntosValvula();
	}
	if(presionadoDispositivoMapa && editarGraficoDispositivo==true)
	{
		presionadoDispositivoMapa = false;
		guardarPuntosDispositivos();
	}
}



function onMouseMove(e)
{
	/*---------Para la sensor----------*/
	if (presionadoSensorMapa)
	{
		var nuevoX = e.clientX;
		//nuevoX = nuevoX- ancho*0.205;
		var nuevoY = e.clientY;
		nuevoY = nuevoY- alto*0.11;
		if(4.5<nuevoX)
		{
			//document.getElementById("sensorCam2"+idNodTerAux).style.left=(nuevoX-5)+"px";
			document.getElementById("sensor"+idNodTerAux).style.cx=(nuevoX)+"px";
		}
		if(4.5<nuevoY)
		{
			//document.getElementById("sensorCam2"+idNodTerAux).style.top=(nuevoY-5)+"px";
			document.getElementById("sensor"+idNodTerAux).style.cy=(nuevoY)+"px";
		}
		// Devolvemos false para no realizar ninguna acción posterior
		return false;
	}
	/*---------Para la valvula----------*/
	else if (presionadoValvulaMapa)
	{
		var nuevoX = e.clientX;
		//nuevoX = nuevoX- ancho*0.205;
		var nuevoY = e.clientY;
		nuevoY = nuevoY- alto*0.11;
		if(4.5<nuevoX)
		{
			document.getElementById("valvula"+idValAux).style.left=(nuevoX-11.5)+"px";			
		}
		if(4.4<nuevoY)
		{
			document.getElementById("valvula"+idValAux).style.top=(nuevoY-11.5)+"px";
		}
		if(4.5<nuevoX && 4.4<nuevoY)
		{
			//document.getElementById("valvula"+idValAux).style.left=(nuevoX-5)+"px";
			//document.getElementById("valvula"+idValAux).style.top=(nuevoY-5)+"px";
			document.getElementById("valvula"+idValAux).points[0].x=nuevoX-11.5;
			document.getElementById("valvula"+idValAux).points[0].y=nuevoY-11.5;

			document.getElementById("valvula"+idValAux).points[1].x=(nuevoX+11.5);
			document.getElementById("valvula"+idValAux).points[1].y=nuevoY+11.5;

			document.getElementById("valvula"+idValAux).points[2].x=nuevoX+11.5;
			document.getElementById("valvula"+idValAux).points[2].y=nuevoY-11.5;

			document.getElementById("valvula"+idValAux).points[3].x=(nuevoX-11.5);
			document.getElementById("valvula"+idValAux).points[3].y=(nuevoY+11.5);;
		}
		// Devolvemos false para no realizar ninguna acción posterior
		return false;
	}
	/*---------Para dispositivo----------*/
	else if (presionadoDispositivoMapa)
	{
		var nuevoX = e.clientX;
		//nuevoX = nuevoX- ancho*0.205;
		var nuevoY = e.clientY;
		nuevoY = nuevoY- alto*0.11;

		var x1LineAntiguo;
		var x2LineAntiguo;
		if(4.5<nuevoX)
		{
			document.getElementById("dispositivo"+idDisAux).style.cx=(nuevoX)+"px";

			if(tipDisAux==1)//para coordinador
			{
				document.getElementsByClassName("lineasN"+idDisAux)[0].setAttribute('x1',(nuevoX-8));
				document.getElementsByClassName("lineasN"+idDisAux)[0].setAttribute('x2',(nuevoX+8));	

				document.getElementsByClassName("lineasN"+idDisAux)[1].setAttribute('x1',(nuevoX+8));
				document.getElementsByClassName("lineasN"+idDisAux)[1].setAttribute('x2',(nuevoX-8));	

				document.getElementsByClassName("lineasN"+idDisAux)[2].setAttribute('x1',(nuevoX));
				document.getElementsByClassName("lineasN"+idDisAux)[2].setAttribute('x2',(nuevoX));	

				document.getElementsByClassName("lineasN"+idDisAux)[3].setAttribute('x1',(nuevoX-11));
				document.getElementsByClassName("lineasN"+idDisAux)[3].setAttribute('x2',(nuevoX+11));	
			}
			else if(tipDisAux==20)//para ruteador
			{
				document.getElementsByClassName("lineasN"+idDisAux)[0].setAttribute('x1',(nuevoX-8));
				document.getElementsByClassName("lineasN"+idDisAux)[0].setAttribute('x2',(nuevoX+8));	

				document.getElementsByClassName("lineasN"+idDisAux)[1].setAttribute('x1',(nuevoX+8));
				document.getElementsByClassName("lineasN"+idDisAux)[1].setAttribute('x2',(nuevoX-8));	
			}
			else if(tipDisAux==10)//para terminal
			{
				document.getElementsByClassName("lineasN"+idDisAux)[0].style.cx=(nuevoX)+"px";
			}
							
		}

		var y1LineAntiguo;
		var y2LineAntiguo;
		if(4.5<nuevoY)
		{
			document.getElementById("dispositivo"+idDisAux).style.cy=(nuevoY)+"px";

			if(tipDisAux==1)//para coordinador
			{
				document.getElementsByClassName("lineasN"+idDisAux)[0].setAttribute('y1',(nuevoY-8));
				document.getElementsByClassName("lineasN"+idDisAux)[0].setAttribute('y2',(nuevoY+8));	

				document.getElementsByClassName("lineasN"+idDisAux)[1].setAttribute('y1',(nuevoY-8));
				document.getElementsByClassName("lineasN"+idDisAux)[1].setAttribute('y2',(nuevoY+8));	

				document.getElementsByClassName("lineasN"+idDisAux)[2].setAttribute('y1',(nuevoY-11));
				document.getElementsByClassName("lineasN"+idDisAux)[2].setAttribute('y2',(nuevoY+11));	

				document.getElementsByClassName("lineasN"+idDisAux)[3].setAttribute('y1',(nuevoY));
				document.getElementsByClassName("lineasN"+idDisAux)[3].setAttribute('y2',(nuevoY));	
			}
			else if(tipDisAux==20)//para ruteador
			{
				document.getElementsByClassName("lineasN"+idDisAux)[0].setAttribute('y1',(nuevoY-8));
				document.getElementsByClassName("lineasN"+idDisAux)[0].setAttribute('y2',(nuevoY+8));	

				document.getElementsByClassName("lineasN"+idDisAux)[1].setAttribute('y1',(nuevoY-8));
				document.getElementsByClassName("lineasN"+idDisAux)[1].setAttribute('y2',(nuevoY+8));	
			}
			else if(tipDisAux==10)//para terminal
			{
				document.getElementsByClassName("lineasN"+idDisAux)[0].style.cy=(nuevoY)+"px";
			}
		}
		// Devolvemos false para no realizar ninguna acción posterior
		return false;
	}
}
document.onmousemove = onMouseMove;
document.onmouseup = mouseUpDis;

window.onresize = onResizeVentana;



/*----------Guardar puntos Sensor-------------*/
function guardarPuntosSensor()
{
	var element = document.getElementById('imgMapa');
	var anchoSVG = element.offsetWidth;
	var altoSVG = element.offsetHeight;

	var x = document.getElementById("sensor"+idNodTerAux).style.cx;
	var y = document.getElementById("sensor"+idNodTerAux).style.cy;
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

	var x = document.getElementById("valvula"+idValAux).style.left;
	var y = document.getElementById("valvula"+idValAux).style.top;
	x = x.substring(0, (x.length-2) );
	y = y.substring(0, (y.length-2) );

	var posX = x*100/anchoSVG;
	var posY = y*100/altoSVG;

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	    	
	    	var validar = xhttp.responseText;
	    }
	};
	xhttp.open("GET", "campos/guardarPuntosValvula.php?idVal="+idValAux+"&posX="+posX+"&posY="+posY, true);
	xhttp.send();
}

/*----------Guardar puntos dispositivos-------------*/
function guardarPuntosDispositivos()
{
	var element = document.getElementById('imgMapa');
	var anchoSVG = element.offsetWidth;
	var altoSVG = element.offsetHeight;

	var x = document.getElementById("dispositivo"+idDisAux).style.cx;
	var y = document.getElementById("dispositivo"+idDisAux).style.cy;
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
	xhttp.open("GET", "mapaDispositivos/guardarPuntosDispositivo.php?idDis="+idDisAux+"&posX="+posX+"&posY="+posY, true);
	xhttp.send();
}