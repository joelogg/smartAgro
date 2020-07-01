function editarNodTer()
{
	document.getElementById('dirFisNodTer').disabled = false;
	document.getElementById('idCam').disabled = false;
	document.getElementById('idNodRut').disabled = false;
	document.getElementById('canSen').disabled = false;
	document.getElementById('dirFisNodTer').style.border = "1px solid #0A0";
	document.getElementById('idCam').style.border = "1px solid #0A0";
	document.getElementById('idNodRut').style.border = "1px solid #0A0";
	document.getElementById('canSen').style.border = "1px solid #0A0";
}

function guardarCambioNodTer(idNodTer)
{	
	var dirFisNodTer = document.getElementById("dirFisNodTer").value;
	if(dirFisNodTer=="")
	{
		document.getElementById("dirFisNodTer").style.border= "1px solid red";
		alert("Inserte Dirección Física.");
		return;
	}

	var canSen = document.getElementById("canSen").value;
	if(canSen=="" || canSen>4 || canSen<1)
	{
		document.getElementById("canSen").style.border= "1px solid red";
		alert("Inserte un numero entre 1 y 4.");
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
	xhttp.open("GET", "nodoTerminal/guardarCambiosNodoTerminal.php?idNodTer="+idNodTer+"&idCam="+idCam+"&canSen="+canSen+"&dirFisNodTer="+dirFisNodTer+"&idNodRut="+idNodRut, true);
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
