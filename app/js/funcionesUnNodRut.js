function editarCambioNR()
{
	document.getElementById('nomNodRut').disabled = false;
	document.getElementById('dirFisNodRut').disabled = false;
	document.getElementById('canValNodRut').disabled = false;
	document.getElementById('nomNodRut').style.border = "1px solid #0A0";
	document.getElementById('dirFisNodRut').style.border = "1px solid #0A0";
	document.getElementById('canValNodRut').style.border = "1px solid #0A0";
}

function guardarCambioNR(idNR)
{
	var nomNR = document.getElementById("nomNodRut").value;
	if(nomNR=="")
	{
		document.getElementById("nomNodRut").style.border= "1px solid red";
		alert("Inserte Nombre.");
		return;
	}
	
	var dirFisNR = document.getElementById("dirFisNodRut").value;
	if(dirFisNR=="")
	{
		document.getElementById("dirFisNodRut").style.border= "1px solid red";
		alert("Inserte Dirección Física.");
		return;
	}


	var canValNodRut = document.getElementById("canValNodRut").value;
	if(canValNodRut=="")
	{
		document.getElementById("canValNodRut").style.border= "1px solid red";
		alert("Inserte cantidad máxima de valvulas.");
		return;
	}

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	    	
	    	var validar = xhttp.responseText;
	    	getRuteadores();
	    	
	    	if(validar == "Correcto")
	    		alert("Se guardo los cambios. \nActualizar para que funcione correctamente.");
	    	else
	    		alert("Error, no se guardo los cambios.");
	    }
	};
	xhttp.open("GET", "nodoRuteador/guardarCambiosUnNodoRuteador.php?idNR="+idNR+"&nomNR="+nomNR+"&dirFisNR="+dirFisNR+"&canValNodRut="+canValNodRut, true);
	xhttp.send();
}