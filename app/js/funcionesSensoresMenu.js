function getSensores () 
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar; 	  	   	
	    }
	};
	xhttp.open("GET", "sensores/getSensores.php", true);
	xhttp.send();
}