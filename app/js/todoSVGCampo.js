/* -----Adaptar Puntos ----*/
function adaptarSVG() 
{	
	if(tipoMenu==1)
	{
		var eleImg = document.getElementById('imgMapa'); 
		
		if(eleImg!=null)
		{
			var anchoV = document.getElementById('imgMapa').width; 
			var altoV = document.getElementById('imgMapa').height; 

			xhttp.onreadystatechange = function() 
			{
			    if (xhttp.readyState == 4 && xhttp.status == 200) 
			    {
			    	var validar = xhttp.responseText;	
			    	document.getElementById('svgMapa').innerHTML = validar; 
			    	document.getElementById('svgMapa').style.height = document.getElementById('imgMapa').height; 
			    	   	
			    }
			};

			xhttp.open("GET", "campos/getSVG.php?anchoV="+anchoV+"&altoV="+altoV, true);
			xhttp.send();
		}
	}	
}

/* -----Editar Puntos ----*/
var editCampos="false";
var puntos = [];
var campoId = 0;

function position(event)
{
	if(editCampos=="true")
	{
		var x = event.clientX;
		var y = event.clientY;

		var elemento = document.getElementById('svgMapa');
		var posicion = elemento.getBoundingClientRect();

		var element = document.getElementById('imgMapa');
		var anchoSVG = element.offsetWidth;
		var altoSVG = element.offsetHeight;

		var elePosX = posicion.left;
		var elePosY = posicion.top;

		x = x-elePosX;
		y = y-elePosY;

		var xPor = Math.round(x*100/anchoSVG*1000)/1000;
		var yPor = Math.round(y*100/altoSVG*1000)/1000;

		var pos = {
		    posX:xPor,
		    posY:yPor,
		    fullName : function() {
       			return this.posX + "," + this.posY + " ";
    		}
		};
		puntos.push(pos)
		var circl = document.createElementNS("http://www.w3.org/2000/svg",'circle');
		circl.setAttribute("cx", x);
		circl.setAttribute("cy", y);
		circl.setAttribute("r", "3");
		circl.setAttribute("fill", "red");
		circl.innerHTML = "";
		elemento.appendChild(circl)

	}
	else
	{
		
	}
	
}

function editar()
{
	if(editCampos=="false")
	{
		var elemento = document.getElementById('boton').innerHTML = 'Finalizar';
		editCampos="true";

		checkSensoresClic();
		checkValvulasClic();
		checkTextoClic();
	}
	else
	{
		var elemento = document.getElementById('boton').innerHTML = 'Editar';
		editCampos="false";

		var texto = "";
		for (var i = 0; i < puntos.length; i++) 
		{
			texto = texto + puntos[i].fullName();			
		}


		var xhttp = new XMLHttpRequest();
	  	xhttp.onreadystatechange = function() 
	  	{
	  		
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {
		    	location.href="index.php";		    	
		    }
	  	};
	  	if(puntos.length<=0)
	  	{
	  		alert("Seleccione esquinas del campo");
	  	}
	  	else
	  	{	
	  		xhttp.open("GET", "campos/actualizarPuntos.php?idCam="+campoId+"&posGraCam="+texto, true);
	  		xhttp.send();
	  	}		
	}	
}

function seleccionarCampo()
{
	campoId = document.getElementById('campos').value;
	document.getElementById('boton').disabled = false;
}

var miActualizador;
//<button onclick="clearInterval(myVar)">Stop time</button>
function inicarActualizador()
{
	miActualizador = setInterval(actualizador ,1000);
}

function actualizador()
{
	xhttpAct0.onreadystatechange = function() 
	{
	    if (xhttpAct0.readyState == 4 && xhttpAct0.status == 200) 
	    {
	    	var validar = xhttpAct0.responseText;		    	
	    	//if(validar.charAt(0)==1)//hay cambios
	    	{
	    		if(validar.charAt(0)==1)//conectado
	    		{
	    				document.getElementById('mensajeSistemaMotrar').innerHTML = "Conectado";
	    				document.getElementById('mensajeSistemaMotrar').style.color = "#00AA00";
	    		}
	    		else if(validar.charAt(0)==0)//desconectado
	    		{
	    			document.getElementById('mensajeSistemaMotrar').innerHTML = "Desconectado";
	    			document.getElementById('mensajeSistemaMotrar').style.color = "#AA0000";
	    			return;
	    		}
	    		/*if(validar.charAt(1)==1)//conectado
	    			document.getElementById('mensajeSistemaMotrar').innerHTML = "Conectado";
	    		if(validar.charAt(1)==1)//conectado
	    			document.getElementById('mensajeSistemaMotrar').innerHTML = "Conectado";*/
	    	}
	    }
	};

	xhttpAct0.open("GET", "propietario/actualizadorPropietario.php", true);
	xhttpAct0.send();
	

	//registrar historial valvula, cuando se abre o cierra
	xhttpAct5.onreadystatechange = function() 
	{
	    if (xhttpAct5.readyState == 4 && xhttpAct5.status == 200) 
	    {
	    	var validar = xhttpAct5.responseText;	
	    }
	};

	xhttpAct5.open("GET", "campos/actualizadorHistorialValvula.php", true);
	xhttpAct5.send();

	if(tipoMenu==1)//menu mapas
	{
		//actualiza campos
		xhttpAct1.onreadystatechange = function() 
		{
		    if (xhttpAct1.readyState == 4 && xhttpAct1.status == 200) 
		    {
		    	var validar = xhttpAct1.responseText;		    	
		    	extraerCambiosMapas(validar);
		    }
		};

		xhttpAct1.open("GET", "campos/actualizadorMapa.php", true);
		xhttpAct1.send();

		//actualiza valvula
		xhttpAct2.onreadystatechange = function() 
		{
		    if (xhttpAct2.readyState == 4 && xhttpAct2.status == 200) 
		    {
		    	var validar = xhttpAct2.responseText;	
		    	//console.log(validar)	    	;
		    	extraerCambiosValvulas(validar);
		    }
		};

		xhttpAct2.open("GET", "campos/actualizadorValvula.php", true);
		xhttpAct2.send();

		//actualiza iconos nodo terminal/sensor
		xhttpAct3.onreadystatechange = function() 
		{
		    if (xhttpAct3.readyState == 4 && xhttpAct3.status == 200) 
		    {
		    	var validar = xhttpAct3.responseText;		    	
		    	extraerCambiosNodTer(validar);
		    }
		};

		xhttpAct3.open("GET", "campos/actualizadorNodTer.php", true);
		xhttpAct3.send();
	}
	else if(tipoMenu==4)//menu dispositivos
	{
		xhttpAct4.onreadystatechange = function() 
		{
		    if (xhttpAct4.readyState == 4 && xhttpAct4.status == 200) 
		    {
		    	var validar = xhttpAct4.responseText;		    	;
		    	if(validar=="1")
		    	{
		    		getMapaDispositivos();
		    	}
		    }
		};

		xhttpAct4.open("GET", "mapaDispositivos/actualizadorDispositivos.php", true);
		xhttpAct4.send();
	}
	else if(tipoMenu==5)//menu valvulas
	{
		xhttpAct4.onreadystatechange = function() 
		{
		    if (xhttpAct4.readyState == 4 && xhttpAct4.status == 200) 
		    {
		    	var validar = xhttpAct4.responseText;
		    	if(validar.length>0)
		    		extraerCambiosValvulasRect(validar);
		    }
		};

		xhttpAct4.open("GET", "valvulas/actualizadorValvulas.php", true);
		xhttpAct4.send();
	}
	else if(tipoMenu==6)//menu sensores
	{
		xhttpAct4.onreadystatechange = function() 
		{
		    if (xhttpAct4.readyState == 4 && xhttpAct4.status == 200) 
		    {
		    	var validar = xhttpAct4.responseText;
		    	if(validar.length>0)
		    		extraerCambiosSensoresRect(validar);
		    }
		};

		xhttpAct4.open("GET", "sensores/actualizadorSensores.php", true);
		xhttpAct4.send();
	}	
}
function finalizarActualizador()
{
	clearInterval(miActualizador);
}

function extraerCambiosMapas(datos)
{
	var i = 0;
	var tipoCampo="";
	var idCam="";
	var flag = true;
	
	for (; i< datos.length; i++) 
	{
		datoActual = datos.charAt(i);

		if(datoActual == ":")
		{
			ejecutarCambiosMapa(tipoCampo, idCam);
			
			tipoCampo="";
			idCam="";
			flag = true;
			i++;
		}
		else if(flag)
		{
			tipoCampo = datoActual
			flag = false;
		}
		else
		{
			idCam = idCam + datoActual;
		}
	}
}

function ejecutarCambiosMapa(tipoCampo, idCam)
{
//	document.getElementById("numAlertas").innerHTML;
	//polygonCampoVacio
	if(tipoCampo==1)
	{
		if ( document.getElementById("campo"+idCam).classList.contains('polygonCampoAlerta') )
		{
			document.getElementById("campo"+idCam).classList.remove('polygonCampoAlerta');
			document.getElementById("numAlertas").innerHTML = parseInt(document.getElementById("numAlertas").innerHTML) -1;
		}
		else
		{
			document.getElementById("campo"+idCam).classList.remove('polygonCampoNormal');
		}		
		
		document.getElementById("campo"+idCam).classList.add('polygonCampoVacio');
	}
	//polygonCampoAlerta
	else if(tipoCampo==2)
	{//polygonCampo polygonCampoAlerta
		if ( document.getElementById("campo"+idCam).classList.contains('polygonCampoVacio') )
		{
			document.getElementById("campo"+idCam).classList.remove('polygonCampoVacio');
		}
		else
		{
			document.getElementById("campo"+idCam).classList.remove('polygonCampoNormal');
		}


		if ( !document.getElementById("campo"+idCam).classList.contains('polygonCampoAlerta') )
		{
			document.getElementById("numAlertas").innerHTML = parseInt(document.getElementById("numAlertas").innerHTML) +1;
		}
		document.getElementById("campo"+idCam).classList.add('polygonCampoAlerta');
	}
	//polygonCampoNormal
	else if(tipoCampo==3)
	{//polygonCampo polygonCampoNormal
		if ( document.getElementById("campo"+idCam).classList.contains('polygonCampoAlerta') )
		{
			document.getElementById("campo"+idCam).classList.remove('polygonCampoAlerta');
			document.getElementById("numAlertas").innerHTML = parseInt(document.getElementById("numAlertas").innerHTML) -1;
		}
		else
		{
			document.getElementById("campo"+idCam).classList.remove('polygonCampoVacio');
		}		
		
		document.getElementById("campo"+idCam).classList.add('polygonCampoNormal');
	}
}

function extraerCambiosValvulas(datos)
{
	var i = 0;
	var conVal="";
	var estVal="";
	var accVal="";
	var idVal="";
	var flag = true;
	
	for (; i< datos.length; i++) 
	{
		datoActual = datos.charAt(i);

		if(datoActual == ":")
		{	
			ejecutarCambiosValvula(conVal, estVal, accVal, idVal);
			conVal="";
			estVal="";
			accVal="";
			idVal="";
			flag = true;		
		}
		else if(flag)
		{
			conVal = datoActual;
			i++;
			estVal = datos.charAt(i);
			i++;
			accVal = datos.charAt(i);
			flag = false;
		}
		else
		{
			idVal = idVal + datoActual;
		}
	}
}

function ejecutarCambiosValvula(conVal, estVal, accVal, idVal)
{
	if(conVal==1)
	{
		document.getElementById("valvula"+idVal).classList.remove('objetoDesconectado');
		if(estVal==1 && accVal==1)
		{	//rectValvulaAbierta
			document.getElementById("valvula"+idVal).classList.remove('rectValvulaAccionCerrar');
			document.getElementById("valvula"+idVal).classList.remove('rectValvulaAccionAbrir');
			document.getElementById("valvula"+idVal).classList.remove('rectValvulaCerrada');
		    document.getElementById("valvula"+idVal).classList.add('rectValvulaAbierta');
		}
		else if(estVal==1 && accVal==0)
		{	//rectValvulaAccionCerrar
			document.getElementById("valvula"+idVal).classList.remove('rectValvulaAbierta');
			document.getElementById("valvula"+idVal).classList.remove('rectValvulaAccionAbrir');
			document.getElementById("valvula"+idVal).classList.remove('rectValvulaCerrada');
		    document.getElementById("valvula"+idVal).classList.add('rectValvulaAccionCerrar');
		}
		else if(estVal==0 && accVal==1)
		{	//rectValvulaAccionAbrir
			document.getElementById("valvula"+idVal).classList.remove('rectValvulaAbierta');
			document.getElementById("valvula"+idVal).classList.remove('rectValvulaAccionCerrar');
			document.getElementById("valvula"+idVal).classList.remove('rectValvulaCerrada');
		    document.getElementById("valvula"+idVal).classList.add('rectValvulaAccionAbrir');
		}
		else if(estVal==0 && accVal==0)
		{	//rectValvulaCerrada
			document.getElementById("valvula"+idVal).classList.remove('rectValvulaAbierta');
			document.getElementById("valvula"+idVal).classList.remove('rectValvulaAccionCerrar');
			document.getElementById("valvula"+idVal).classList.remove('rectValvulaAccionAbrir');
		    document.getElementById("valvula"+idVal).classList.add('rectValvulaCerrada');
		}
	}
	else
	{
		document.getElementById("valvula"+idVal).classList.remove('rectValvulaAbierta');
		document.getElementById("valvula"+idVal).classList.remove('rectValvulaAccionCerrar');
		document.getElementById("valvula"+idVal).classList.remove('rectValvulaAccionAbrir');
		document.getElementById("valvula"+idVal).classList.remove('rectValvulaCerrada');
		document.getElementById("valvula"+idVal).classList.add('objetoDesconectado');
	}
	
}


function extraerCambiosNodTer(datos)
{
	var i = 0;
	var idNodTer="";
	
	for (; i< datos.length; i++) 
	{
		datoActual = datos.charAt(i);

		if(datoActual == ":")
		{
			ejecutarCambiosNodTer(idNodTer);
			idNodTer="";
			i++;
		}
		else
		{
			idNodTer = idNodTer + datoActual;
		}
	}
}

function ejecutarCambiosNodTer(idNodTer)
{
    xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;

	    	var idDis = validar.substring(1);
	    	if (validar.charAt(0)=="1") //conectado
	    	{
	    		document.getElementById("sensor"+idDis).classList.remove('objetoDesconectado');
	    		document.getElementById("sensor"+idDis).classList.add('rectSensor');
	    	}
	    	else //desconectado
	    	{	    		
	    		document.getElementById("sensor"+idDis).classList.remove('rectSensor');
			    document.getElementById("sensor"+idDis).classList.add('objetoDesconectado');			    
	    	}
	    }
	};
	xhttp.open("GET", "campos/getCambioSensor.php?idNodTer="+idNodTer, true);
	xhttp.send();
}

function extraerCambiosValvulasRect(datos)
{
	var datosArray = new Array();
	datosArray = datos.split(",");
	//var tam = datosArray.length;

	//for (j = 0; j < tam; j++) 
	{
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {
		    	var validar = xhttp.responseText;
		    	document.getElementById("rectanguloValvula"+datosArray[0]).innerHTML = validar; 	
		    }
		};
		xhttp.open("GET", "valvulas/extraerCambiosValvula.php?idVal="+datosArray[0], true);
		xhttp.send();
	}
}
function extraerCambiosSensoresRect(datos)
{
	var datosArray = new Array();
	datosArray = datos.split(",");
	
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("rectanguloSensor"+datosArray[0]).innerHTML = validar; 	
	    }
	};
	xhttp.open("GET", "sensores/extraerCambiosSensor.php?idNodTer="+datosArray[0], true);
	xhttp.send();
}