function eliminarDispositivo(idDis)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	getAgregaciones();
	    }
	};
	xhttp.open("GET", "dispositivos/eliminarDispositivo.php?idDis="+idDis, true);
	xhttp.send();
}

function aceptarDispositivo(idDis)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	getAgregaciones();
	    }
	};
	xhttp.open("GET", "dispositivos/aceptarDispositivo.php?idDis="+idDis, true);
	xhttp.send();
}

function activarPermitJoim()
{
	if(segundoActual==30)
	{
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {
		    	inicarCronometro();
		    }
		};
		xhttp.open("GET", "dispositivos/activarPermitJoim.php", true);
		xhttp.send();
	}
}

var miCronometro;
var segundoActual=30;//maximo 255
function inicarCronometro()
{
	segundoActual=30;
	miCronometro = setInterval(accionarCronometro ,1000);
}

function accionarCronometro()
{
	if(segundoActual>=10)
	{
		if(document.getElementById('reloj')!=null)
			document.getElementById('reloj').innerHTML = "00:"+segundoActual;
		segundoActual--;
	}
	else if(segundoActual>0)
	{
		if(document.getElementById('reloj')!=null)
			document.getElementById('reloj').innerHTML = "00:0"+segundoActual;
		segundoActual--;
	}
	else
	{
		if(document.getElementById('reloj')!=null)
		{
			document.getElementById('reloj').innerHTML = "00:0"+segundoActual;
			document.getElementById('reloj').innerHTML = "Finalizado";
		}
		finalizarActualizador();
	}
}
function finalizarActualizador()
{
	getAgregaciones();
	clearInterval(miCronometro);
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	segundoActual=30;
	    }
	};
	xhttp.open("GET", "dispositivos/desactivarPermitJoim.php", true);
	xhttp.send();
}

function permitirConexionDis()
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	console.log(validar);
	    	getAgregaciones();
	    }
	};
	xhttp.open("GET", "dispositivos/permitirConexionDis.php", true);
	xhttp.send();
}