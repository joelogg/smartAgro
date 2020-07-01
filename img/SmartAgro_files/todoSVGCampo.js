/* -----Adaptar Puntos ----*/
function adaptarSVG() 
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

		xhttp.open("GET", "campos/getSVG.php?anchoV="+anchoV+"& altoV="+altoV, true);
		xhttp.send();

		xhttp2.onreadystatechange = function() 
		{
		    if (xhttp2.readyState == 4 && xhttp2.status == 200) 
		    {
		    	var validar2 = xhttp2.responseText;	
		    	document.getElementById('infoDispositivosCampo').innerHTML = validar2; 
		    	//document.getElementById('infoDispositivosCampo').style.height = document.getElementById('imgMapa').height; 
		    	   	
		    }
		};
		xhttp2.open("GET", "campos/getInfoDispositivos.php?anchoV="+anchoV+"& altoV="+altoV, true);
		xhttp2.send();
	}
	
}

/* -----Editar Puntos ----*/
var edit="false";
var puntos = [];
var campoId = 0;

function position(event)
{
	if(edit=="true")
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
	if(edit=="false")
	{
		var elemento = document.getElementById('boton').innerHTML = 'Finalizar';
		edit="true";
	}
	else
	{
		var elemento = document.getElementById('boton').innerHTML = 'Editar';
		edit="false";

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