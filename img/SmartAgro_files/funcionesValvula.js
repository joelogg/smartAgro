function editarValvula()
{
	document.getElementById('nomVal').disabled = false;
	document.getElementById('dirFisVal').disabled = false;
	document.getElementById('idCam').disabled = false;
	document.getElementById('idNodRut').disabled = false;
	document.getElementById('nomVal').style.border = "1px solid #0A0";
	document.getElementById('dirFisVal').style.border = "1px solid #0A0";
	document.getElementById('idCam').style.border = "1px solid #0A0";
	document.getElementById('idNodRut').style.border = "1px solid #0A0";
}

function guardarCambioValvula(idVal)
{
	var nomVal = document.getElementById("nomVal").value;
	if(nomVal=="")
	{
		document.getElementById("nomVal").style.border= "1px solid red";
		alert("Inserte Nombre.");
		return;
	}
	
	var dirFisVal = document.getElementById("dirFisVal").value;
	if(dirFisVal=="")
	{
		document.getElementById("dirFisVal").style.border= "1px solid red";
		alert("Inserte Dirección Física.");
		return;
	}

	var idCam = document.getElementById("idCam").value;
	var idNodRut = document.getElementById("idNodRut").value;


	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	    	
	    	getCampos();
	    	alert("Se guardo los cambios. \nActualizar para que funcione correctamente.");
	    }
	};
	xhttp.open("GET", "valvula/guardarCambiosValvula.php?idVal="+idVal+"&idCam="+idCam+"&nomVal="+nomVal+"&dirFisVal="+dirFisVal+"&idNodRut="+idNodRut, true);
	xhttp.send();
}

function eliminarValvula(idVal)
{
	confirmar=confirm("¿Realmente desa eliminar esta valvula?"); 
	if (confirmar)
	{
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {	    	
		    	location.reload();
		    	alert("Se elimino un valvula.");
		    }
		};
		xhttp.open("GET", "valvula/eliminarValvula.php?idVal="+idVal, true);
		xhttp.send();
	} 
	else 
	{		
	}
}

function accionarSwitchValvula (idVal) 
{
	var accionSV = document.getElementById("switchValvula").checked;

	var image = document.getElementById('imagenValvula');

	var accVal="";
	if(accionSV==true)
	{
		accVal="1";
		document.getElementById("estVal").value = "Abierta";
		document.getElementById("accVal").value = "Abrir";
		image.src = "img/valvulaAbierta.gif";
	}
	else
	{
		accVal="0";
		document.getElementById("estVal").value = "Cerrada";
		document.getElementById("accVal").value = "Cerrar";
		image.src = "img/valvulaCerrada.gif";
	}

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {		    	
	    }
	};
	xhttp.open("GET", "valvula/accionarSwitchValvula.php?idVal="+idVal+"&accVal="+accVal, true);
	xhttp.send();
}