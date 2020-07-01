<script>

var idTipoObjeto=1;//Campos=1, Campo=2, Valvula=3, Sensor=4, OtrosDispositivos=5, 
//NCoordinadores=6, NCoordinador=7, NRuteadores=8, NRuteador=9, 
//Cultivos=10, Cultivo=11, Nutrientes=12, Nutrientes=13
//NTerminales=14, NTerminal=15,
var ultimoIdObjeto=0;//id de campo, valvula, sensor, NC, NR,...
var tipoMenu=1; //Mapa=1, Graficos=2, Propiedades=3, Dispositivos=4,
// Valvulas=5, Sensores=6

/*------------------Camposss--------------------*/

function getCampos () 
{
	idTipoObjeto=1;
	habilitarMP () ;

	if(flechaDCampo == false)
	{
		clicFlechaC();
	}
		
	if (tipoMenu==1)
	{
		getCamposMapa ();
	}
	else if (tipoMenu==2)
	{
		getCamposMapa (); 
		seleccionarMenu(1);
	}
	else if (tipoMenu==3)
	{
		getCamposPropiedades () ;
	}
	else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
	{
		getCamposPropiedades () ;
		seleccionarMenu(3);
	}
}

function getCamposMapa () 
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar; 
	    	document.getElementById('editarMapaCheck').checked=editarGraficos;	
	    	adaptarSVG();    	   	
	    }
	};
	//desdeJava para verificar desde donde es llamado getCampos
	xhttp.open("GET", "campos/getCamposMapa.php?desdeJava="+1, true);
	xhttp.send();
}

function getCamposPropiedades () 
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar; 	
	    	   	   	
	    }
	};
	xhttp.open("GET", "campos/getCamposPropiedades.php", true);
	xhttp.send();
}






/*------------------Campo------------------------*/
function mostrarUnCampo(idCam)
{ 		
	if(editCampos=="false")
	{
		idTipoObjeto=2;
		ultimoIdObjeto = idCam;
		habilitarMP () ;

		flechaDCampo = false;
		clicFlechaC();
		clicFlechaCs(idCam);
		if (tipoMenu==1)
		{		
			mostrarUnCampoPropiedades(idCam);
			seleccionarMenu(3);
		}
		else if (tipoMenu==2)
		{	
			mostrarUnCampoPropiedades(idCam);
			seleccionarMenu(3);		
		}
		else if (tipoMenu==3)
		{
			mostrarUnCampoPropiedades(idCam);
		}
		else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
		{
			mostrarUnCampoPropiedades(idCam);
			seleccionarMenu(3);
		}
	}
	
}

function mostrarUnCampoPropiedades(idCam)
{ 
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar;  
	    }
	};
	xhttp.open("GET", "campo/getUnCampoPropiedades.php?idCam="+idCam, true);
	xhttp.send();
}

/*------------------Valvulas------------------------*/
function mostrarUnaValvula(idVal)
{ 				
	if(editCampos=="false")
	{
		idTipoObjeto=3;
		ultimoIdObjeto = idVal;
		habilitarMP () ;

		if (tipoMenu==1)
		{		
			mostrarUnaValvulaPropiedades(idVal);
			seleccionarMenu(3);
		}
		else if (tipoMenu==2)
		{			
			//mostrarUnaValvulaGrafica(idVal);
			mostrarUnaValvulaPropiedades(idVal);
			seleccionarMenu(3);
		}
		else if (tipoMenu==3)
		{
			mostrarUnaValvulaPropiedades(idVal);
		}
		else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
		{
			mostrarUnaValvulaPropiedades(idVal);
			seleccionarMenu(3);
		}
	}
	
}
function mostrarUnaValvulaGrafica(idVal)
{
	document.getElementById("idComponente").value = idVal;
	document.getElementById("tipoComponente").value = idTipoObjeto;

	var ancho = window.innerWidth;
	var alto = window.innerHeight;

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
			    	graficarV(validar);
			    }
			};
			xhttp2.open("GET", "valvula/getUnaValvulaGrafica.php?idVal="+idVal, true);
			xhttp2.send();
	    }
	};
	xhttp.open("GET", "valvula/getUnaValvulaGraficaMenu.php?idVal="+idVal+"&anchoV="+ancho+"&altoV="+alto, true);
	xhttp.send();		
}

function mostrarUnaValvulaPropiedades(idVal)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar; 
	    }
	};
	xhttp.open("GET", "valvula/getUnaValvulaPropiedades.php?idVal="+idVal, true);
	xhttp.send();
}

/*------------------Sensor------------------------*/
function mostrarUnSensor(idNodTer)
{ 					
	if(editCampos=="false")
	{
		idTipoObjeto=4;
		ultimoIdObjeto = idNodTer;
		habilitarMP () ;

		if (tipoMenu==1)
		{		
			mostrarUnSensorPropiedades(idNodTer);
			seleccionarMenu(3);
		}
		else if (tipoMenu==2)
		{			
			mostrarUnSensorGrafica(idNodTer);
		}
		else if (tipoMenu==3)
		{
			mostrarUnSensorPropiedades(idNodTer);
		}
		else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
		{
			mostrarUnSensorPropiedades(idNodTer);
			seleccionarMenu(3);
		}
		
	}	
}

var ultimoNTG = -1;
function mostrarUnSensorGrafica(idNodTer)
{	
	document.getElementById("idComponente").value = idNodTer;
	document.getElementById("tipoComponente").value = idTipoObjeto;
	var ancho = window.innerWidth;
	var alto = window.innerHeight;
	console.log(alto);
	// para repetidor, evitar q funcione click en el mismo
	/*if(ultimoNTG == idNodTer)
	{
		console.log("Salio:"+ultimoNTG+":"+idNodTer);
		return;
	}
	else
	{
		console.log("Entro:"+ultimoNTG+":"+idNodTer);
		ultimoNTG = idNodTer;
	}*/

//se va a repetir en elegirRepetidor(), pero necesario para q cambie rapido sin esperar al timer
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
			    	var validar2 = xhttp2.responseText;
			    	graficarNT(validar2,"Hoy: "+ f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
			    }
			};
			xhttp2.open("GET", "Sensor/getUnSensorGrafica.php?idNodTer="+idNodTer, true);
			xhttp2.send();
	    }
	};
	xhttp.open("GET", "Sensor/getUnSensorGraficaMenu.php?idNodTer="+idNodTer+"&anchoV="+ancho+"&altoV="+alto, true);
	xhttp.send();		
}

function mostrarUnSensorPropiedades(idNodTer)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar;  
	    }
	};
	xhttp.open("GET", "Sensor/getUnSensorPropiedades.php?idNodTer="+idNodTer, true);
	xhttp.send();
}

/*------------------Otros Dispostivos--------------------*/

function getODispositivos() 
{
	idTipoObjeto=5;
	habilitarMP () ;

	if(flechaDODispositivos == false)
	{
		clicFlechaOD();
	}
		
	if (tipoMenu==1)
	{
		getOtrosDispositivosPropiedades (); 
		seleccionarMenu(3);
	}
	else if (tipoMenu==2)
	{
		getOtrosDispositivosPropiedades (); 
		seleccionarMenu(3);
	}
	else if (tipoMenu==3)
	{
		getOtrosDispositivosPropiedades () ;
	}
	else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
	{
		getOtrosDispositivosPropiedades () ;
		seleccionarMenu(3);
	}
}

function getOtrosDispositivosPropiedades () 
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar; 	
	    	   	   	
	    }
	};
	xhttp.open("GET", "otrosDispositivos/getODPropiedades.php", true);
	xhttp.send();
}

/*------------------Nodos Ruteadores--------------------*/

function getCoordinadores()
{
	idTipoObjeto=6;
	habilitarMP () ;

	if(flechaDNCoordinadores == false)
	{
		clicFlechaNCs();
	}
		
	if (tipoMenu==1)
	{
		getNodosCoordinadoresPropiedades (); 
		seleccionarMenu(3);
	}
	else if (tipoMenu==2)
	{
		getNodosCoordinadoresPropiedades (); 
		seleccionarMenu(3);
	}
	else if (tipoMenu==3)
	{
		getNodosCoordinadoresPropiedades () ;
	}
	else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
	{
		getNodosCoordinadoresPropiedades () ;
		seleccionarMenu(3);
	}
}

function getNodosCoordinadoresPropiedades () 
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar; 	
	    	   	   	
	    }
	};
	xhttp.open("GET", "nodosCoordinadores/getNCsPropiedades.php", true);
	xhttp.send();
}


/*------------------Un Nodo Coordinador--------------------*/
function mostrarUnNodoCoordinador(idNC)
{ 				
	idTipoObjeto=7;
	ultimoIdObjeto = idNC;
	habilitarMP () ;

	if (tipoMenu==1)
	{		
		mostrarUnNodoCoordinadorPropiedades(idNC);
		seleccionarMenu(3);
	}
	else if (tipoMenu==2)
	{			
		mostrarUnNodoCoordinadorGrafica(idNC);
	}
	else if (tipoMenu==3)
	{
		mostrarUnNodoCoordinadorPropiedades(idNC);
	}	
	else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
	{
		mostrarUnNodoCoordinadorPropiedades(idNC);
		seleccionarMenu(3);
	}	
}
function mostrarUnNodoCoordinadorGrafica(idNC)
{
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
			    	graficarV(validar);
			    }
			};
			xhttp2.open("GET", "nodoCoordinador/getUnNodoCoordinadorGrafica.php?idNC="+idNC, true);
			xhttp2.send();
	    }
	};
	xhttp.open("GET", "nodoCoordinador/getUnNodoCoordinadorMenu.php?idNC="+idNC, true);
	xhttp.send();		
}

function mostrarUnNodoCoordinadorPropiedades(idNC)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar; 
	    }
	};
	xhttp.open("GET", "nodoCoordinador/getUnNodoCoordinadorPropiedades.php?idNC="+idNC, true);
	xhttp.send();
}


/*------------------Nodos Ruteadores--------------------*/

function getRuteadores()
{
	idTipoObjeto=8;
	habilitarMP () ;

	if(flechaDNRuteadores == false)
	{
		clicFlechaNRs()
	}
		
	if (tipoMenu==1)
	{
		getNodosRuteadoresPropiedades (); 
		seleccionarMenu(3);
	}
	else if (tipoMenu==2)
	{
		getNodosRuteadoresPropiedades (); 
		seleccionarMenu(3);
	}
	else if (tipoMenu==3)
	{
		getNodosRuteadoresPropiedades () ;
	}
	else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
	{
		getNodosRuteadoresPropiedades () ;
		seleccionarMenu(3);
	}
}

function getNodosRuteadoresPropiedades () 
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar; 	
	    	   	   	
	    }
	};
	xhttp.open("GET", "nodosRuteadores/getNRsPropiedades.php", true);
	xhttp.send();
}

/*------------------Un Nodo Ruteador--------------------*/
function mostrarUnNodoRuteador(idNR)
{ 				
	idTipoObjeto=9;
	ultimoIdObjeto = idNR;
	habilitarMP () ;

	if (tipoMenu==1)
	{		
		mostrarUnNodoRuteadorPropiedades(idNR);
		seleccionarMenu(3);
	}
	else if (tipoMenu==2)
	{			
		mostrarUnNodoRuteadorGrafica(idNR);
	}
	else if (tipoMenu==3)
	{
		mostrarUnNodoRuteadorPropiedades(idNR);
	}
	else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
	{
		mostrarUnNodoRuteadorPropiedades(idNR);
		seleccionarMenu(3);
	}		
}
function mostrarUnNodoRuteadorGrafica(idNR)
{
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
			    	graficarV(validar);
			    }
			};
			xhttp2.open("GET", "nodoRuteador/getUnNodoRuteadorGrafica.php?idNR="+idNR, true);
			xhttp2.send();
	    }
	};
	xhttp.open("GET", "nodoRuteador/getUnNodoRuteadorMenu.php?idNR="+idNR, true);
	xhttp.send();		
}

function mostrarUnNodoRuteadorPropiedades(idNR)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar; 
	    }
	};
	xhttp.open("GET", "nodoRuteador/getUnNodoRuteadorPropiedades.php?idNR="+idNR, true);
	xhttp.send();
}

/*------------------Nodos Terminal--------------------*/

function getTerminales()
{
	idTipoObjeto=14;
	habilitarMP () ;

	if(flechaDNTerminales == false)
	{
		clicFlechaNTs()
	}
		
	if (tipoMenu==1)
	{
		getNodosTerminalesPropiedades (); 
		seleccionarMenu(3);
	}
	else if (tipoMenu==2)
	{
		getNodosTerminalesPropiedades (); 
		seleccionarMenu(3);
	}
	else if (tipoMenu==3)
	{
		getNodosTerminalesPropiedades () ;
	}
	else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
	{
		getNodosTerminalesPropiedades () ;
		seleccionarMenu(3);
	}
}

function getNodosTerminalesPropiedades () 
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar; 	
	    	   	   	
	    }
	};
	xhttp.open("GET", "nodosTerminales/getNTsPropiedades.php", true);
	xhttp.send();
}

/*------------------Un Nodo Terminal--------------------*/
function mostrarUnNodoTerminal(idNT)
{ 				
	idTipoObjeto=15;
	ultimoIdObjeto = idNT;
	habilitarMP () ;

	if (tipoMenu==1)
	{		
		mostrarUnNodoTerminalPropiedades(idNT);
		seleccionarMenu(3);
	}
	else if (tipoMenu==2)
	{			
		mostrarUnNodoTerminalGrafica(idNT);
	}
	else if (tipoMenu==3)
	{
		mostrarUnNodoTerminalPropiedades(idNT);
	}
	else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
	{
		mostrarUnNodoTerminalPropiedades(idNT);
		seleccionarMenu(3);
	}		
}
function mostrarUnNodoTerminalGrafica(idNT)
{
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
			    	graficarV(validar);
			    }
			};
			xhttp2.open("GET", "nodoTerminal/getUnNodoTerminalGrafica.php?idNT="+idNT, true);
			xhttp2.send();
	    }
	};
	xhttp.open("GET", "nodoTerminal/getUnNodoTerminalMenu.php?idNT="+idNT, true);
	xhttp.send();		
}

function mostrarUnNodoTerminalPropiedades(idNT)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar; 
	    }
	};
	xhttp.open("GET", "nodoTerminal/getUnNodoTerminalPropiedades.php?idNT="+idNT, true);
	xhttp.send();
}

/*------------------Cultivosss--------------------*/

function getCultivos() 
{
	idTipoObjeto=10;
	habilitarMP () ;

	if(flechaCultivos == false)
	{
		clicFlechaCultivos();
	}
		
	if (tipoMenu==1)
	{
		getCultivosPropiedades (); 
		seleccionarMenu(3);
	}
	else if (tipoMenu==2)
	{
		getCultivosPropiedades (); 
		seleccionarMenu(3);
	}
	else if (tipoMenu==3)
	{
		getCultivosPropiedades (); 
	}
	else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
	{
		getCultivosPropiedades (); 
		seleccionarMenu(3);
	}
}

function getCultivosPropiedades ()
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar; 	
	    	   	   	
	    }
	};
	xhttp.open("GET", "cultivos/getCultivosPropiedades.php", true);
	xhttp.send();
}

/*------------------Un Cultivo--------------------*/
function mostrarUnCultivo(idCul)
{ 				
	idTipoObjeto=11;
	ultimoIdObjeto = idCul;
	habilitarMP () ;

	if (tipoMenu==1)
	{		
		mostrarUnCultivoPropiedades(idCul);
		seleccionarMenu(3);
	}
	else if (tipoMenu==2)
	{			
		mostrarUnCultivoPropiedades(idCul);
		seleccionarMenu(3);
	}
	else if (tipoMenu==3)
	{
		mostrarUnCultivoPropiedades(idCul);
	}	
	else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
	{			
		mostrarUnCultivoPropiedades(idCul);
		seleccionarMenu(3);
	}	
}

function mostrarUnCultivoPropiedades(idCul)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar; 
	    }
	};
	xhttp.open("GET", "cultivo/getUnCultivoPropiedades.php?idCul="+idCul, true);
	xhttp.send();
}

/*------------------Nutrientesss--------------------*/

function getNutrientes() 
{
	idTipoObjeto=12;
	habilitarMP () ;

	if(flechaNutrientes == false)
	{
		clicFlechaNutrientes();
	}
		
	if (tipoMenu==1)
	{
		getNutrientesPropiedades (); 
		seleccionarMenu(3);
	}
	else if (tipoMenu==2)
	{
		getNutrientesPropiedades (); 
		seleccionarMenu(3);
	}
	else if (tipoMenu==3)
	{
		getNutrientesPropiedades (); 
	}
	else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
	{
		getNutrientesPropiedades (); 
		seleccionarMenu(3);
	}
}

function getNutrientesPropiedades ()
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar; 		    	   	   	
	    }
	};
	xhttp.open("GET", "nutrientes/getNutrientesPropiedades.php", true);
	xhttp.send();
}

/*------------------Un Nutriente--------------------*/
function mostrarUnNutriente(idNut)
{ 				
	idTipoObjeto=13;
	ultimoIdObjeto = idNut;
	habilitarMP () ;

	if (tipoMenu==1)
	{		
		mostrarUnNutrientePropiedades(idNut);
		seleccionarMenu(3);
	}
	else if (tipoMenu==2)
	{			
		mostrarUnNutrientePropiedades(idNut);
		seleccionarMenu(3);
	}
	else if (tipoMenu==3)
	{
		mostrarUnNutrientePropiedades(idNut);
	}	
	else if (tipoMenu==4 || tipoMenu==5 || tipoMenu==6 )
	{			
		mostrarUnNutrientePropiedades(idNut);
		seleccionarMenu(3);
	}	
}

function mostrarUnNutrientePropiedades(idNut)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar; 
	    }
	};
	xhttp.open("GET", "nutriente/getUnNutrientePropiedades.php?idNut="+idNut, true);
	xhttp.send();
}
/*---------------Habilitar y deshabilitar menu principal---*/
function habilitarMP () 
{
	//Campos=1, Campo=2, Valvula=3, Sensor=4, OtrosDispositivos=5, 
	//NCoordinadores=6, NCoordinador=7, NRuteadores=8, NRuteador=9

	//Esta seleccionado Mapa
	/*if (idTipoObjeto==1)
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}
	//Esta seleccionado unCampo
	else if (idTipoObjeto==2) 
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}
	//Esta seleccionado una valvula
	else if (idTipoObjeto==3)
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}
	//Esta seleccionado un sensor
	else if (idTipoObjeto==4) 
	{
		document.getElementById("m2").disabled = false;
		document.getElementById("m2").style.cursor = 'pointer';
	}
	//Esta seleccionado otros dispositivos
	else if (idTipoObjeto==5) 
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}
	//Esta seleccionado nodos coordinadores
	else if (idTipoObjeto==6) 
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}
	//Esta seleccionado un nodo coordinador
	else if (idTipoObjeto==7) 
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}
	//Esta seleccionado nodos ruteadores
	else if (idTipoObjeto==8) 
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}
	//Esta seleccionado un nodo ruteador
	else if (idTipoObjeto==9) 
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}
	//Esta seleccionado cultivos
	else if (idTipoObjeto==10) 
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}
	//Esta seleccionado un cultivo
	else if (idTipoObjeto==11) 
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}
	//Esta seleccionado nutrientes
	else if (idTipoObjeto==12) 
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}
	//Esta seleccionado un nutriente
	else if (idTipoObjeto==13) 
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}
	//Esta seleccionado nodos termianles
	else if (idTipoObjeto==14) 
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}
	//Esta seleccionado un nodo terminal
	else if (idTipoObjeto==15) 
	{
		document.getElementById("m2").disabled = true;
		document.getElementById("m2").style.cursor = 'not-allowed';
	}*/
}

/*---------------------Funciones del menu-------------------*/
function getMapa () 
{
	//Siempre mostrara todo el mapa
	idTipoObjeto=1;
	habilitarMP () ;
	getCamposMapa();
}
function getGraficas () 
{
	//Esta seleccionado Mapa
	if (idTipoObjeto==1)
	{	//nada
	}
	//Esta seleccionado unCampo
	else if (idTipoObjeto==2) 
	{	//nada
	}
	//Esta seleccionado una valvula
	else if (idTipoObjeto==3)
	{	
		//mostrarUnaValvulaGrafica(ultimoIdObjeto);
	}
	//Esta seleccionado un sensor
	else if (idTipoObjeto==4) 
	{
		mostrarUnSensorGrafica(ultimoIdObjeto);
	}
	//Esta seleccionado otros dispositivos
	else if (idTipoObjeto==5) 
	{
		//nada
	}
	//Esta seleccionado Nodos Coordinadores
	else if (idTipoObjeto==6) 
	{
		//nada
	}
	//Esta seleccionado un Nodo Coordinador
	else if (idTipoObjeto==7) 
	{
		//mostrarUnNodoCoordinadorGrafica(ultimoIdObjeto);
	}
	//Esta seleccionado Nodos Ruteadores
	else if (idTipoObjeto==8) 
	{
		//nada
	}
	//Esta seleccionado un Nodo Ruteador
	else if (idTipoObjeto==9) 
	{
		//mostrarUnNodoRuteadorGrafica(ultimoIdObjeto);
	}
	//Esta seleccionado Cultivos
	else if (idTipoObjeto==10) 
	{
		//nada
	}
	//Esta seleccionado un Cultivo
	else if (idTipoObjeto==11) 
	{
		//nada
	}
	//Esta seleccionado Nutrientes
	else if (idTipoObjeto==12) 
	{
		//nada
	}
	//Esta seleccionado un Nutriente
	else if (idTipoObjeto==13) 
	{
		//nada
	}
	//Esta seleccionado Nodos Termianles
	else if (idTipoObjeto==14) 
	{
		//nada
	}
	//Esta seleccionado un Nodo Termianl
	else if (idTipoObjeto==15) 
	{
		//nada
	}
}
function getPropiedades () 
{
	//Esta seleccionado Mapa
	if (idTipoObjeto==1)
	{
		habilitarMP () 
		getCamposPropiedades ();
	}
	//Esta seleccionado unCampo
	else if (idTipoObjeto==2) 
	{
		mostrarUnCampoPropiedades(ultimoIdObjeto);
	}
	//Esta seleccionado una valvula
	else if (idTipoObjeto==3)
	{
		mostrarUnaValvulaPropiedades(ultimoIdObjeto);
	}
	//Esta seleccionado un sensor
	else if (idTipoObjeto==4) 
	{
		mostrarUnSensorPropiedades(ultimoIdObjeto);
	}
	//Esta seleccionado Otros Dispositivos
	else if (idTipoObjeto==5) 
	{
		getOtrosDispositivosPropiedades ();
	}
	//Esta seleccionado Nodos Coordinadores
	else if (idTipoObjeto==6) 
	{
		getNodosCoordinadoresPropiedades ();
	}
	//Esta seleccionado un Nodo Coordinador
	else if (idTipoObjeto==7) 
	{
		getUnNodoCoordinadorPropiedades (ultimoIdObjeto);
	}
	//Esta seleccionado Nodos Ruteadores
	else if (idTipoObjeto==8) 
	{
		getNodosRuteadoresPropiedades ();
	}
	//Esta seleccionado un Nodo Ruteador
	else if (idTipoObjeto==9) 
	{
		getUnNodoRuteadorPropiedades (ultimoIdObjeto);
	}
	//Esta seleccionado Cultivos
	else if (idTipoObjeto==10) 
	{
		getCultivosPropiedades (ultimoIdObjeto);
	}
	//Esta seleccionado un Cultivo
	else if (idTipoObjeto==11) 
	{
		getUnCultivoPropiedades (ultimoIdObjeto);
	}
	//Esta seleccionado Nutrientes
	else if (idTipoObjeto==12) 
	{
		getNutrientesPropiedades (ultimoIdObjeto);
	}
	//Esta seleccionado un Nutriente
	else if (idTipoObjeto==13) 
	{
		getUnNutrientePropiedades (ultimoIdObjeto);
	}
	//Esta seleccionado Nodos Terminales
	else if (idTipoObjeto==8) 
	{
		getNodosTerminalesPropiedades ();
	}
	//Esta seleccionado un Nodo Terminal
	else if (idTipoObjeto==9) 
	{
		getUnNodoTerminalPropiedades (ultimoIdObjeto);
	}
}

function getAgregaciones() 
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	document.getElementById("cuerpo").innerHTML = validar; 
	    }
	};
	xhttp.open("GET", "dispositivos/getAgregaciones.php", true);
	xhttp.send();
}



</script>