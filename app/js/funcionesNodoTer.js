function editarCambioNT()
{
	document.getElementById('nomNodTer').disabled = false;
	document.getElementById('dirFisNodTer').disabled = false;
	document.getElementById('canSenNodTer').disabled = false;
	document.getElementById('nomNodTer').style.border = "1px solid #0A0";
	document.getElementById('dirFisNodTer').style.border = "1px solid #0A0";
	document.getElementById('canSenNodTer').style.border = "1px solid #0A0";
}

function guardarCambioNT(idNodTer, idDis)
{	
	var nomNodTer = document.getElementById("nomNodTer").value;
	if(nomNodTer=="")
	{
		document.getElementById("nomNodTer").style.border= "1px solid red";
		alert("Inserte Nombre.");
		return;
	}

	var dirFisNodTer = document.getElementById("dirFisNodTer").value;
	if(dirFisNodTer=="")
	{
		document.getElementById("dirFisNodTer").style.border= "1px solid red";
		alert("Inserte Dirección Física.");
		return;
	}

	var canSenNodTer = document.getElementById("canSenNodTer").value;
	if(canSenNodTer=="" || canSenNodTer>4 || canSenNodTer<1)
	{
		document.getElementById("canSenNodTer").style.border= "1px solid red";
		alert("Inserte un numero entre 1 y 4.");
		return;
	}

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	    	
	    	mostrarUnNodoTerminal(idDis);
	    	alert("Se guardo los cambios. \nActualizar para que funcione correctamente.");
	    }
	};
	xhttp.open("GET", "nodoTerminal/guardarCambiosUnNodoTerminal.php?idDis="+idDis+"&idNodTer="+idNodTer+"&canSenNodTer="+canSenNodTer+"&dirFisNodTer="+dirFisNodTer+"&nomNodTer="+nomNodTer, true);
	xhttp.send();
}

function eliminarNodTer(idNodTer)
{
	confirmar=confirm("¿Realmente desa eliminar este sensor?"); 
	if (confirmar)
	{
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {	    	
		    	location.reload();
		    	alert("Se elimino un sensor.");
		    }
		};
		xhttp.open("GET", "nodoTerminal/eliminarNodoTerminal.php?idNodTer="+idNodTer, true);
		xhttp.send();
	} 
	else 
	{		
	}
}

function quitarNodoTerrminal(idCam, idNodTer)
{
	confirmar=confirm("¿Realmente desa eliminar este sensor?"); 
	if (confirmar)
	{
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {	    	
		    	clickCampoMapa(idCam);
		    }
		};
		xhttp.open("GET", "nodoTerminal/quitarNodoTerminal.php?idCam="+idCam+"&idNodTer="+idNodTer, true);
		xhttp.send();
	} 
	else 
	{		
	}
}
