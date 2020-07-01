function editarCambioNR()
{
	document.getElementById('nomNodRut').disabled = false;
	document.getElementById('dirFisNodRut').disabled = false;
	document.getElementById('idNodCoo').disabled = false;
	document.getElementById('nomNodRut').style.border = "1px solid #0A0";
	document.getElementById('dirFisNodRut').style.border = "1px solid #0A0";
	document.getElementById('idNodCoo').style.border = "1px solid #0A0";
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

	var idNodCoo = document.getElementById("idNodCoo").value;


	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	    	
	    	getRuteadores();
	    	alert("Se guardo los cambios. \nActualizar para que funcione correctamente.");
	    }
	};
	xhttp.open("GET", "nodoRuteador/guardarCambiosUnNodoRuteador.php?idNR="+idNR+"&nomNR="+nomNR+"&dirFisNR="+dirFisNR+"&idNodCoo="+idNodCoo, true);
	xhttp.send();
}