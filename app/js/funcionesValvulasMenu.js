function getValvulas ()  
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar; 	   	   	
	    }
	};
	xhttp.open("GET", "valvulas/getValvulas.php", true);
	xhttp.send();
}

function abrirValvula (idVal) 
{
	document.getElementById("on"+idVal).style.backgroundColor = "#0F0";
	document.getElementById("off"+idVal).style.backgroundColor = "#DDD";
    
	accVal = 1;    
	
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

function cerrarValvula (idVal) 
{
	document.getElementById("off"+idVal).style.backgroundColor = "#F00";
	document.getElementById("on"+idVal).style.backgroundColor = "#DDD";
    
	accVal = 0;    
	
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