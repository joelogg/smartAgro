function graficarV(datos)
{
	{
		var i = 0;
		//console.log(datos);
		var nombres = [];
		//var nombres = ["0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23"];
		var auxNombre = "";
		for (; i< datos.length; i++) 
		{
			datoActual = datos.charAt(i);
			if(datoActual == ",")
			{			
				nombres.push(auxNombre);
				auxNombre = "";
			}
			else if(datoActual == "%")
			{
				nombres.push(auxNombre);
				auxNombre = "";
				i++;
				break;
			}
			else
			{
				auxNombre = auxNombre + datoActual;
			}
		}

		var puntosH = [];
		//puntosH.push(20,20,50,20,50,20,50);
		var auxNombre = "";
		for (; i< datos.length; i++) 
		{
			datoActual = datos.charAt(i);
			if(datoActual == ",")
			{			
				puntosH.push(auxNombre);
				auxNombre = "";
			}
			else if(datoActual == "%")
			{
				puntosH.push(auxNombre);
				auxNombre = "";
				i++;
				break;
			}
			else
			{
				auxNombre = auxNombre + datoActual;
			}
		}

		
		var resto = "";
		for (; i< datos.length; i++) 
		{
		  	resto = resto + datos.charAt(i);
		}
		
		console.log(resto);
		

		var barChartData = {
			labels : nombres,
			datasets : [
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,0.8)",
					highlightFill : "rgba(151,187,205,0.75)",
					highlightStroke : "rgba(151,187,205,1)",
					data : puntosH
				}
			]
		}
	
	/*
		var lineChartData = 
			{
				labels : nombres,
				datasets : 
						[
							{
								label: "Abierto",
								fillColor : "rgba(210,100,100,0.2)",
								strokeColor : "rgba(210,100,100,1)",
								pointColor : "rgba(210,100,100,1)",
								pointStrokeColor : "#fff",
								pointHighlightFill : "#fff",
								pointHighlightStroke : "rgba(210,100,100,1)",
								data : puntosH
							}
						]

		}*/
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Bar(barChartData, {responsive: true});

		/*var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {responsive: true});*/
	}
}

function graficarNT(datos, tituloGra)
{
	document.getElementById("tituloGrafica").innerHTML = tituloGra;
	{
	var i = 0;
	
	// Para ver cuantos sensores hay
	var canSensores = "";
	var auxCanSen = "";
	for (; i< datos.length; i++) 
	{
		datoActual = datos.charAt(i);
		if(datoActual == "%")
		{
			canSensores = auxCanSen;
			i++;
			break;
		}
		else
		{
			auxCanSen = auxCanSen + datoActual;
		}
	}

	// Para los nombre que va en la parte inferior de la grafica
	var nombres = [];
	var auxNombre = "";
	for (; i< datos.length; i++) 
	{
		datoActual = datos.charAt(i);
		if(datoActual == ",")
		{			
			nombres.push(auxNombre);
			auxNombre = "";
		}
		else if(datoActual == "%")
		{
			nombres.push(auxNombre);
			auxNombre = "";
			i++;
			break;
		}
		else
		{
			auxNombre = auxNombre + datoActual;
		}
	}


	// Extrar todos los datos dependiendo la cantidad de sensores
	var todosDatos = [];
	for (var j=0; j< canSensores; j++) 
	{
		var puntos = [];
		var auxNombre = "";
		for (; i< datos.length; i++) 
		{
			datoActual = datos.charAt(i);
			if(datoActual == ",")
			{			
				puntos.push(auxNombre);
				auxNombre = "";
			}
			else if(datoActual == "%")
			{
				puntos.push(auxNombre);
				auxNombre = "";
				i++;
				todosDatos.push(puntos);
				puntos = [];
				break;
			}
			else
			{
				auxNombre = auxNombre + datoActual;
			}
		}
	}

	
	var resto = "";
	for (; i< datos.length; i++) 
	{
	  	resto = resto + datos.charAt(i);
	}
	

	var lineChartData = 
		{
			labels : nombres,
			datasets : 
					[
						{
							label: "Dispositivo 1",
							fillColor : "rgba(210,10,10,0.2)",//rojo
							strokeColor : "rgba(210,10,10,1)",
							pointColor : "rgba(210,10,10,1)",
							pointStrokeColor : "#fff",
							pointHighlightFill : "#fff",
							pointHighlightStroke : "rgba(210,10,10,1)",																				
							data : todosDatos[0]
						},
						{
							label: "Dispositivo 2",
							fillColor : "rgba(134,115,161,0.2)",//lila
							strokeColor : "rgba(134,115,161,1)",
							pointColor : "rgba(134,115,161,1)",
							pointStrokeColor : "#fff",
							pointHighlightFill : "#fff",
							pointHighlightStroke : "rgba(134,115,161,1)",														
							data : todosDatos[1]
						},
						{
							label: "Dispositivo 3",
							fillColor : "rgba(151,187,205,0.2)",//azul
							strokeColor : "rgba(151,187,205,1)",
							pointColor : "rgba(151,187,205,1)",
							pointStrokeColor : "#fff",
							pointHighlightFill : "#fff",
							pointHighlightStroke : "rgba(151,187,205,1)",							
							data : todosDatos[2]
						},
						{
							label: "Dispositivo 4",
							fillColor : "rgba(137,172,118,0.2)",//verde
							strokeColor : "rgba(137,172,118,1)",
							pointColor : "rgba(137,172,118,1)",
							pointStrokeColor : "#fff",
							pointHighlightFill : "#fff",
							pointHighlightStroke : "rgba(137,172,118,1)",	
							data : todosDatos[3]
						}
					]

		}
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {responsive: true});
	}
	
}

var nodoTerminalTipo=0;//Hoy=0, Ver=1, ultimaSemana=2, ultimoMes=3, ultimosMeses=4 
function verG()
{
	nodoTerminalTipo = 1;
	var fechaSeleccionadaIni = document.getElementById("fechaSeleccionadaIni").value;
	var fechaSeleccionadaFin = document.getElementById("fechaSeleccionadaFin").value;

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar;
	    	xhttp2.onreadystatechange = function() 
			{
			    if (xhttp2.readyState == 4 && xhttp2.status == 200) 
			    {
			    	var validar = xhttp2.responseText;
			    	graficarNT(validar, "Desde: "+fechaSeleccionadaIni+ " Hasta: "+fechaSeleccionadaFin);
			    }
			};
			xhttp2.open("GET", "nodoTerminal/getUnNodoTerminalGraficaVer.php?idNodTer="+ultimoIdObjeto+"& FechaSeleccionadaIni="+fechaSeleccionadaFin+"& FechaSeleccionadaFin="+fechaSeleccionadaFin, true);
			xhttp2.send();
	    }
	};
	xhttp.open("GET", "nodoTerminal/getUnNodoTerminalGraficaMenu.php?idNodTer="+ultimoIdObjeto, true);
	xhttp.send();	
}

function hoyG()
{
	nodoTerminalTipo = 0;
	
	var ancho = window.innerWidth;
	var alto = window.innerHeight;

	var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	var f=new Date();
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar;
	    	xhttp2.onreadystatechange = function() 
			{
			    if (xhttp2.readyState == 4 && xhttp2.status == 200) 
			    {
			    	var validar = xhttp2.responseText;
			    	graficarNT(validar,"Hoy: "+ f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
			    }
			};
			xhttp2.open("GET", "nodoTerminal/getUnNodoTerminalGrafica.php?idNodTer="+ultimoIdObjeto, true);
			xhttp2.send();
	    }
	};
	xhttp.open("GET", "nodoTerminal/getUnNodoTerminalGraficaMenu.php?idNodTer="+ultimoIdObjeto+"&anchoV="+ancho+"&altoV="+alto, true);
	xhttp.send();	
}

function ultimaSemanaG()
{
	nodoTerminalTipo = 2;
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar;
	    	xhttp2.onreadystatechange = function() 
			{
			    if (xhttp2.readyState == 4 && xhttp2.status == 200) 
			    {
			    	var validar = xhttp2.responseText;
			    	graficarNT(validar, "Última Semana");
			    }
			};
			xhttp2.open("GET", "nodoTerminal/getUnNodoTerminalGraficaUltSem.php?idNodTer="+ultimoIdObjeto, true);
			xhttp2.send();
	    }
	};
	xhttp.open("GET", "nodoTerminal/getUnNodoTerminalGraficaMenu.php?idNodTer="+ultimoIdObjeto, true);
	xhttp.send();
}

function ultimoMes()
{
	nodoTerminalTipo = 3;
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar;
	    	xhttp2.onreadystatechange = function() 
			{
			    if (xhttp2.readyState == 4 && xhttp2.status == 200) 
			    {
			    	var validar = xhttp2.responseText;
			    	graficarNT(validar, "Último Mes");
			    }
			};
			xhttp2.open("GET", "nodoTerminal/getUnNodoTerminalGraficaUltMes.php?idNodTer="+ultimoIdObjeto, true);
			xhttp2.send();
	    }
	};
	xhttp.open("GET", "nodoTerminal/getUnNodoTerminalGraficaMenu.php?idNodTer="+ultimoIdObjeto, true);
	xhttp.send();
}

function todosMesesG()
{
	nodoTerminalTipo = 4;
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar;
	    	xhttp2.onreadystatechange = function() 
			{
			    if (xhttp2.readyState == 4 && xhttp2.status == 200) 
			    {
			    	var validar = xhttp2.responseText;
			    	graficarNT(validar, "Últimos 12 Meses");
			    }
			};
			xhttp2.open("GET", "nodoTerminal/getUnNodoTerminalGraficaUltAnio.php?idNodTer="+ultimoIdObjeto, true);
			xhttp2.send();
	    }
	};
	xhttp.open("GET", "nodoTerminal/getUnNodoTerminalGraficaMenu.php?idNodTer="+ultimoIdObjeto, true);
	xhttp.send();
}