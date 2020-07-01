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
			if(datoActual == "&")
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
		for (var j=0; j< 4; j++) 
		{
			var puntos = [];
			var auxNombre = "";
			for (; i< datos.length; i++) 
			{
				datoActual = datos.charAt(i);
				if(datoActual == ",")
				{			
					puntos.push(parseInt(auxNombre));
					auxNombre = "";
				}
				else if(datoActual == "%")
				{
					puntos.push(parseInt(auxNombre));
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

		// Para los datos de las valvulas
		var valorValvulas = [];
		for (; i< datos.length; i++) 
		{
			datoActual = datos.charAt(i);
			if(datoActual == "&")
			{			
				valorValvulas.push(auxNombre);
				auxNombre = "";
			}
			else if(datoActual == "%")
			{
				valorValvulas.push(auxNombre);
				auxNombre = "";
				i++;
				break;
			}
			else
			{
				auxNombre = auxNombre + datoActual;
			}
		}
		

		if(canSensores==1)
			generarGrafico(nombres, todosDatos[0], null, null, null, valorValvulas) ;
		else if(canSensores==2)
			generarGrafico(nombres, todosDatos[0], todosDatos[1], null, null, valorValvulas) ;
		else if(canSensores==3)
			generarGrafico(nombres, todosDatos[0], todosDatos[1], todosDatos[2], null, valorValvulas) ;
		else
			generarGrafico(nombres, todosDatos[0], todosDatos[1], todosDatos[2], todosDatos[3], valorValvulas) ;
		
	}
	
}

var colores = ["#FF0000", "#1B7B20", "#0000FF", "#BFBC33", "#99F3FD"];
var canvas;
var context;
var canvasTexto;
var contextTexto;



function generarGrafico(datosX, datosY1, datosY2, datosY3, datosY4, xValvula) 
{
	canvas = document.getElementById('miCanvasGrafico');
	context = canvas.getContext('2d');
	canvasTexto = document.getElementById('miCanvasTexto');
	contextTexto = canvasTexto.getContext('2d');

	var contenedorGrafico = document.getElementById('contenedorGrafico'); 
	
	if(contenedorGrafico!=null)
	{
		var anchoC = contenedorGrafico.style.width; 
		var altoC = contenedorGrafico.style.height; 

		document.getElementById('miCanvasGrafico').width =  (anchoC.substring(0,  anchoC.length-2))-50; 
		document.getElementById('miCanvasGrafico').height = (altoC.substring(0,  altoC.length-2))-40;
		document.getElementById('miCanvasTexto').width =  (anchoC.substring(0,  anchoC.length-2)); 
		document.getElementById('miCanvasTexto').height = (altoC.substring(0,  altoC.length-2));
		

	    /*var datosX = ["2016-09-15,23:25:00","2016-09-16,23:25","2016-09-17,20:25","2016-09-17,20:43","2016-09-17,21:15",    
	    "2016-09-17,23:25","2016-09-18,20:25","2016-09-18,23:25","2016-09-18,23:55","2016-09-19,12:25",         
	    "2016-09-19,23:25","2016-09-20,23:25","2016-09-21,23:25"];
	    /*var datosY1 = [11,16,11, 8, 8, 9,10, 5, 3, 2, 8, 7, 7];
	    var datosY2 = [19,22,11,12,13,14,15,16, 9,10,11, 2, 4];
	    var datosY3 = [ 5, 4, 5, 6, 8, 4, 2,13,10,13,29,20,20];
	    var datosY4 = [17,17,20,22,24,20,23,28,27,25,24,23,23];

	    //Desde, Hasta, Desde, Hasta...
	    var xValvula = ["2016-09-16,08:26","2016-09-16,23:25",
	    "2016-09-17,20:25","2016-09-18,23:25",
	    "2016-09-19,21:15","2016-09-20,18:25"];*/
	    
	    pintarGrafica(datosX, datosY1, datosY2, datosY3, datosY4, xValvula);
	}	
}

var yMayor, yMenor;
function pintarGrafica(datosX, datosY1, datosY2, datosY3, datosY4, xValvula)
{
	var tamanio = datosX.length;

	if(tamanio<=1)
		return;

	var datosXNumeros = new Array();
	datosXNumeros = generarFechasANumeros(datosX); 

	var diferenciaX = datosXNumeros[datosXNumeros.length-1] - datosXNumeros[0];
	calcularYMayorMenor(tamanio, datosY1, datosY2, datosY3, datosY4); 
	var diferenciaY = yMayor - yMenor;	

	pintarLetrasX(datosXNumeros[datosXNumeros.length-1], datosXNumeros[0]);


	pintarLetrasY(yMayor, yMenor);

	var datosXNumerosValvula = new Array();
	if(xValvula!=null)
	{
		datosXNumerosValvula = generarFechasANumeros(xValvula);
		pintarGraficaValvula(datosXNumerosValvula, datosXNumeros[0], datosXNumeros[datosXNumeros.length-1], yMenor, yMayor, diferenciaX, diferenciaY, colores[4]);
	}

	//---------pintando las lineas de los datos--------------
	pintarUnaGrafica (datosXNumeros, datosY1, diferenciaX, diferenciaY, tamanio, colores[0]);
	if(datosY2!=null)
		pintarUnaGrafica (datosXNumeros, datosY2, diferenciaX, diferenciaY, tamanio, colores[1]);
	if(datosY3!=null)
		pintarUnaGrafica (datosXNumeros, datosY3, diferenciaX, diferenciaY, tamanio, colores[2]);
	if(datosY4!=null)
		pintarUnaGrafica (datosXNumeros, datosY4, diferenciaX, diferenciaY, tamanio, colores[3]);
	
	
}


function pintarUnaGrafica (datosXNumeros, datosY, diferenciaX, diferenciaY, tamanio, color)
{
	var x1, x2, y1, y2;
	for(i=1; i<tamanio; i++)
	{
		x1 = ((datosXNumeros[i-1]-datosXNumeros[0])*canvas.width)/diferenciaX;
		x2 = ((datosXNumeros[i]-datosXNumeros[0])*canvas.width)/diferenciaX;
	   	
	   	y1 = ((datosY[i-1]-yMenor)*canvas.height)/diferenciaY;
		y2 = ((datosY[i]-yMenor)*canvas.height)/diferenciaY;
	   	pintarLinea(x1, y1, x2, y2, color);
	}
}

function pintarLinea(x1, y1, x2, y2, color, grosor)
{  	
	y1 = canvas.height - y1;
	y2 = canvas.height - y2;
	context.beginPath();
  	context.moveTo(x1, y1);
  	context.lineTo(x2, y2);
  	context.lineWidth = 1;
  	context.strokeStyle = color;
  	context.lineCap = 'round';
  	context.stroke();
}

function generarFechasANumeros (fechasDatos)
{
	var datosNumeros = new Array();
	var valor, valor1, valor2, valor3, valor4, valor5, valor6;
	for(i=0; i<fechasDatos.length; i++)
	{
		valor1 = (fechasDatos[i].substring(0, 4)*365*24*60*60)+(6*60*60);//año
		valor2 = fechasDatos[i].substring(5, 7)*30*24*60*60;//mes
		valor3 = fechasDatos[i].substring(8, 10)*24*60*60;//dias
		valor4 = fechasDatos[i].substring(11, 13)*60*60;//horas
		valor5 = fechasDatos[i].substring(14, 16)*60;//min
		valor6 = fechasDatos[i].substring(17, 19) * 1;//seg
		valor = valor1+valor2+valor3+valor4+valor5+valor6;
		datosNumeros[i] = valor; 
	}
	return datosNumeros;
}

function calcularYMayorMenor(tamanio, datosY1, datosY2, datosY3, datosY4)
{
	yMayor=datosY1[0];
  	yMenor=datosY1[0];

  	//para hallar el menor y mayor "datosY"
  	for(i=1; i<tamanio; i++)
  	{
	    if(yMayor<datosY1[i])
    	{
      		yMayor= datosY1[i];
    	}
    	if(yMenor>datosY1[i])
    	{
      		yMenor= datosY1[i];
    	}
  	}
  	if(datosY2!=null)
  	{
    	for(i=0; i<tamanio; i++)
    	{
      		if(yMayor<datosY2[i])
      		{
        		yMayor= datosY2[i];
      		}
      		if(yMenor>datosY2[i])
      		{
        		yMenor= datosY2[i];
      		}
    	}
  	}
  	if (datosY3!=null)
  	{
		for(i=0; i<tamanio; i++)
    	{
      		if(yMayor<datosY3[i])
      		{
        		yMayor= datosY3[i];
      		}
      		if(yMenor>datosY3[i])
      		{
        		yMenor= datosY3[i];
      		}
    	}
  	}
  	if (datosY4!=null)
  	{
	    for(i=0; i<tamanio; i++)
    	{
      		if(yMayor<datosY4[i])
      		{
        		yMayor= datosY4[i];
      		}
      		if(yMenor>datosY4[i])
      		{
        		yMenor= datosY4[i];
      		}
    	}
  	}
}


function pintarLetrasX(xMayor, xMenor)
{
	var diferencia = xMayor - xMenor;
	
	var cantidadPintar = canvas.width/65;
	var saltos = diferencia/cantidadPintar;
	var num;

	for(i=0; i<cantidadPintar; i++)
	{
		num = xMenor+(saltos*i);
		num = Math.round(  num );
		pintarLetraX(i*65, num);
	}		
}

function pintarLetraX(x, texto)
{
	var v1, v2, v3, v4, v5, v6, resto;
	texto = texto-21600;
	v1 = Math.floor (texto/(365*24*60*60));
	texto = texto - v1*(365*24*60*60);

	v2 = Math.floor (texto/(30*24*60*60));
	if(v2<10)
		v2 = "0" + v2;
	texto = texto - v2*(30*24*60*60);

	v3 = Math.floor (texto/(24*60*60));
	if(v3<10)
		v3 = "0" + v3;
	texto = texto - v3*(24*60*60);

	v4 = Math.floor (texto/(60*60));
	if(v4<10)
		v4 = "0" + v4;
	texto = texto - v4*(60*60);

	v5 = Math.floor (texto/(60));
	if(v5<10)
		v5 = "0" + v5;
	texto = texto - v5*(60);

	v6 = texto;
	if(v6<10)
		v6 = "0" + v6;

	//console.log(resto);
	contextTexto.fillStyle = "black";
	contextTexto.font = '12px Arial';
	contextTexto.textAlign = 'center';
	contextTexto.fillText(v1+"-"+v2+"-"+v3, x+51, canvas.height + 22);
	contextTexto.fillText(v4+":"+v5+":"+v6, x+51, canvas.height + 37);

	contextTexto.beginPath();
	contextTexto.moveTo(x+51, canvas.height);
	contextTexto.lineTo(x+51, canvas.height+5);
	contextTexto.lineWidth = 2;
	contextTexto.strokeStyle = "red";
	contextTexto.stroke();
}



function pintarLetrasY(yMayor, yMenor)
{
	var diferencia = yMayor - yMenor;
	
	var cantidadPintar = canvas.height/30;
	var saltos = diferencia/cantidadPintar;
	var num;
	for(i=0; i<=cantidadPintar; i++)
	{
		num = Math.round(  (yMenor+(saltos*i)) ) ;
		pintarLetraY(canvas.height-i*30, num);
	}		
}

function pintarLetraY(y, texto)
{
	contextTexto.fillStyle = "black";
	contextTexto.font = '12px Arial';
	contextTexto.textAlign = 'right';
	contextTexto.fillText(texto, 40, y+4);

	contextTexto.beginPath();
	contextTexto.moveTo(45, y);
	contextTexto.lineTo(50, y);
	contextTexto.lineWidth = 2;
	contextTexto.strokeStyle = "red";
	contextTexto.stroke();
}

function pintarGraficaValvula(datosXNumerosValvula, xMenor, xMayor, yMenor, yMayor, diferenciaX, diferenciaY, color)
{
	var x1, x2, y1, y2;
	for(i=1; i<datosXNumerosValvula.length; i++)
	{
		if(datosXNumerosValvula[i-1]<xMayor)
		{
			x1 = ((datosXNumerosValvula[i-1]-xMenor)*canvas.width)/diferenciaX;
			x2 = ((datosXNumerosValvula[i]-xMenor)*canvas.width)/diferenciaX;
		   	
		   	y1 = ((yMenor-yMenor)*canvas.height)/diferenciaY;
			y2 = ((yMayor-yMenor)*canvas.height)/diferenciaY;
		   	pintarRectangulo(x1, y1, x2, y2, color);
		}
	   	i++;
	}
}

function pintarRectangulo(x1, y1, x2, y2, color, grosor)
{  	
  	context.beginPath();
    context.rect(x1, y1, x2-x1, y2-y1);
    context.fillStyle = color;
    context.fill();
    context.lineWidth = 1;
    context.strokeStyle = color;
    context.stroke();
}