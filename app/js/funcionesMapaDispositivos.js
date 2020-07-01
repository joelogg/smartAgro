var editarGraficoDispositivo=false;
function getMapaDispositivos()
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar; 	
	    	document.getElementById('editarDispositivosCheck').checked=editarGraficoDispositivo;
	    	adaptarSVGDispositivos();    	   	
	    }
	};
	xhttp.open("GET", "mapaDispositivos/getDispositivosMapa.php", true);
	xhttp.send();
}

function adaptarSVGDispositivos() 
{	
	if(tipoMenu==4)
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

			xhttp.open("GET", "mapaDispositivos/getSVGDispositivos.php?anchoV="+anchoV+"&altoV="+altoV+"&editableGD="+editarGraficoDispositivo, true);
			xhttp.send();
		}
	}
}


function editarCamposDispositivos()
{ 
	getMapaDispositivos();
	if(editarGraficoDispositivo)
	{
		//console.log("fin editarCampo");
		editarGraficoDispositivo=false;	
	}
	else
	{
		//console.log("editoCampo");
		editarGraficoDispositivo=true;
	}

}

function clickNTMapa(idDis)
{
	if(editarGraficoDispositivo==false)
	{		
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {
		    	var validar = xhttp.responseText;	
		    	document.getElementById('contenidoPopUp').innerHTML = validar;
				abrirPopUp(500, 1, idDis);//ancho, tipo(sensor=1), idDispositivo
		    }
		};
		xhttp.open("GET", "mapaDispositivos/getUnNodoTerminal.php?idDis="+idDis, true);
		xhttp.send();
	}
}

function clickNRMapa(idDis)
{
	if(editarGraficoDispositivo==false)
	{
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {
		    	var validar = xhttp.responseText;	
		    	document.getElementById('contenidoPopUp').innerHTML = validar;
				abrirPopUp(500, 2, idDis);//ancho, tipo(valvula=2), idDispositivo
		    }
		};
		xhttp.open("GET", "mapaDispositivos/getUnNodoRuteador.php?idDis="+idDis, true);
		xhttp.send();
	}
}

function clickNCMapa(idDis)
{
	if(editarGraficoDispositivo==false)
	{
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {
		    	var validar = xhttp.responseText;	
		    	document.getElementById('contenidoPopUp').innerHTML = validar;
				abrirPopUp(500, 2, idDis);//ancho, tipo(valvula=2), idDispositivo
		    }
		};
		xhttp.open("GET", "mapaDispositivos/getUnNodoCoordinador.php?idDis="+idDis, true);
		xhttp.send();
	}
}