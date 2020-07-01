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


function accionarSwitchValvulaMapaAntigua (idVal) 
{
	var accionSV = document.getElementById("switchValvula"+idVal).checked;
	var image = document.getElementById('imagenValvula');
	var accVal="";
	if(accionSV==true)
		accVal="1";
	else
		accVal="0";

	if ($("#valvula"+idVal).hasClass('rectValvulaAbierta'))
	{
        document.getElementById("valvula"+idVal).classList.remove('rectValvulaAbierta');        
        document.getElementById("valvula"+idVal).classList.add('rectValvulaAccionCerrar');
		accVal = 0;
    }
    else if ($("#valvula"+idVal).hasClass('rectValvulaAccionCerrar'))
    {
        document.getElementById("valvula"+idVal).classList.remove('rectValvulaAccionCerrar'); 
        document.getElementById("valvula"+idVal).classList.add('rectValvulaAbierta');	
        return;
    }
    else if ($("#valvula"+idVal).hasClass('rectValvulaAccionAbrir'))
    {
    	document.getElementById("valvula"+idVal).classList.remove('rectValvulaAccionAbrir');
    	document.getElementById("valvula"+idVal).classList.add('rectValvulaCerrada');
    	return;
    }
    else if ($("#valvula"+idVal).hasClass('rectValvulaCerrada'))
    {
    	document.getElementById("valvula"+idVal).classList.remove('rectValvulaCerrada');
    	document.getElementById("valvula"+idVal).classList.add('rectValvulaAccionAbrir');
    	accVal = 1;
    }

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	
	    	var validar = xhttp.responseText;
	    	console.log(validar);

	    	var accVal = 0;
			
	    	/*if(accionSV==true)
			{//de cerrado a abierto
				document.getElementById("valvula"+idVal).classList.remove('rectValvulaCerrada');
	    		document.getElementById("valvula"+idVal).classList.add('rectValvulaAbierta');

	    		//image.src = "img/valvulaAbierta.gif";
			}
			else
			{//de abierto a cerrado
	    		document.getElementById("valvula"+idVal).classList.remove('rectValvulaAbierta');
	    		document.getElementById("valvula"+idVal).classList.add('rectValvulaCerrada');

	    		//image.src = "img/valvulaCerrada.gif";
			}*/
	    }
	};
	xhttp.open("GET", "valvula/accionarSwitchValvula.php?idVal="+idVal+"&accVal="+accVal, true);
	xhttp.send();
}

function accionarSwitchValvulaMapa (idVal) 
{
	if(editarGraficos==true)
	{
		return;
	}

	/*if(event.button!=2)
	{
		return
	}*/
	var accVal = 0;
	if ($("#valvula"+idVal).hasClass('rectValvulaAbierta'))
	{
        document.getElementById("valvula"+idVal).classList.remove('rectValvulaAbierta');        
        document.getElementById("valvula"+idVal).classList.add('rectValvulaAccionCerrar');
		accVal = 0;
    }
    else if ($("#valvula"+idVal).hasClass('rectValvulaAccionCerrar'))
    {
        document.getElementById("valvula"+idVal).classList.remove('rectValvulaAccionCerrar'); 
        document.getElementById("valvula"+idVal).classList.add('rectValvulaAbierta');	
        return;
    }
    else if ($("#valvula"+idVal).hasClass('rectValvulaAccionAbrir'))
    {
    	document.getElementById("valvula"+idVal).classList.remove('rectValvulaAccionAbrir');
    	document.getElementById("valvula"+idVal).classList.add('rectValvulaCerrada');
    	return;
    }
    else if ($("#valvula"+idVal).hasClass('rectValvulaCerrada'))
    {
    	document.getElementById("valvula"+idVal).classList.remove('rectValvulaCerrada');
    	document.getElementById("valvula"+idVal).classList.add('rectValvulaAccionAbrir');
    	accVal = 1;
    }
	
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

var mostroSensor= false;
var anteriorIdNodTer=-1;
function clickSensorMapa(idDis)
{
	if(editarGraficos==false)
	{		
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {
		    	var validar = xhttp.responseText;	
		    	document.getElementById('contenidoPopUp').innerHTML = validar;
				abrirPopUp(700, 1, idDis);//ancho, tipo(sensor=1), idDispositivo
				mostrarUnNodoTerminalGraficaMapa(idDis);
		    }
		};
		xhttp.open("GET", "campos/getUnSensor.php?idNodTer="+idDis, true);
		xhttp.send();
	}
}


var mostroValvula= false;
var anteriorIdVal=-1;
function verValvulaMapa(idVal)
{
	if(editarGraficos==false)
	{
		menuIzquierdo = false;
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {
		    	var validar = xhttp.responseText;	
		    	document.getElementById('contenidoPopUp').innerHTML = validar;
				abrirPopUp(700, 2, idVal);//ancho, tipo(valvula=2), idDispositivo
				mostrarUnaValvulaGraficaMapa(idVal);
		    }
		};
		xhttp.open("GET", "campos/getUnaValvula.php?idVal="+idVal, true);
		xhttp.send();
	}
}

function clickCampoMapa(idCam)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('contenidoPopUp').innerHTML = validar;
			abrirPopUp(500, 0, idCam);//ancho, tipo(valvula=2), idDispositivo
	    }
	};
	xhttp.open("GET", "campos/getUnCampo.php?idCam="+idCam, true);
	xhttp.send();
}


function mostrarUnNodoTerminalGraficaMapa(idDis)
{	
	xhttp2.onreadystatechange = function() 
	{
	    if (xhttp2.readyState == 4 && xhttp2.status == 200) 
	    {
	    	var validar = xhttp2.responseText;
	    	graficarNT(validar, "Últimos 12 Meses");
	    }
	};
	xhttp2.open("GET", "sensor/getUnNodoTerminalGraficaUltAnio.php?idDis="+idDis, true);
	xhttp2.send();	
}

function mostrarUnaValvulaGraficaMapa(idVal)
{	
	xhttp2.onreadystatechange = function() 
	{
	    if (xhttp2.readyState == 4 && xhttp2.status == 200) 
	    {
	    	var validar = xhttp2.responseText;
	    	graficarNT(validar, "Últimos 12 Meses");
	    }
	};
	xhttp2.open("GET", "valvula/getUnaValvulaGraficaUltAnio.php?idVal="+idVal, true);
	xhttp2.send();	
}

function agregarSensorMapa(idCam)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('contenidoPopUp').innerHTML = validar;
	    	abrirPopUp(500, 0, idCam);//ancho, tipo(valvula=2), idDispositivo
	    }
	};
	xhttp.open("GET", "campos/agregarSensorMapa.php?idCam="+idCam, true);
	xhttp.send();
}

function agregarValvulaMapa(idCam)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('contenidoPopUp').innerHTML = validar;
	    	abrirPopUp(500, 0, idCam);//ancho, tipo(valvula=2), idDispositivo
	    }
	};
	xhttp.open("GET", "campos/agregarValvulaMapa.php?idCam="+idCam, true);
	xhttp.send();
}

function relacionarSensorCampo(idCam)
{
	var idNodTer = document.getElementById('sensoresDisponibles').value;
	if(idNodTer==-1)
	{
		document.getElementById('sinSeleccionSensor').innerHTML="Elija un Sensor!"
		return;
	}

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById('sinSeleccionSensor').innerHTML = validar;
	    	document.getElementById('sinSeleccionSensor').style.color = "#0A0";
	    	setTimeout(clickCampoMapa2, 2000);
	    }
	};
	xhttp.open("GET", "campos/relacionarSensorCampo.php?idCam="+idCam+"&idNodTer="+idNodTer, true);
	xhttp.send();
}

function relacionarValvulaCampo(idCam)
{
	var idVal = document.getElementById('valvulasDisponibles').value;
	if(idVal==-1)
	{
		document.getElementById('sinSeleccionValvula').innerHTML="Elija una Valvula!"
		return;
	}

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById('sinSeleccionValvula').innerHTML = validar;
	    	document.getElementById('sinSeleccionValvula').style.color = "#0A0";
	    	setTimeout(clickCampoMapa2, 2000);
	    }
	};
	xhttp.open("GET", "campos/relacionarValvulaCampo.php?idCam="+idCam+"&idVal="+idVal, true);
	xhttp.send();
}


function clickCampoMapa2()
{
	clickCampoMapa(idDispositivoPopUp);
}

var editarGraficos=false;
function editarCampos()
{ 
	getMapa();
	if(editarGraficos)
	{
		//console.log("fin editarCampo");
		editarGraficos=false;
	}
	else
	{
		//console.log("editoCampo");
		editarGraficos=true;
	}
};

var mostrarMenuIz = false;
function mostrarMenuI()
{
	if(mostrarMenuIz)
	{
		mostrarMenuIz = false;
		document.getElementById('mostrarMenuIzquierdo').style.backgroundImage = "url('img/expandir.png')";	
		$("#menuIzqueirda").animate({left: '-260px'});
	}
	else
	{
		mostrarMenuIz = true;
		document.getElementById('mostrarMenuIzquierdo').style.backgroundImage = "url('img/contraer.png')";	
		$("#menuIzqueirda").animate({left: '0px'});
	}
}