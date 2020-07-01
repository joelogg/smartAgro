function editarCambioNC()
{
	document.getElementById('nomNodCor').disabled = false;
	document.getElementById('dirFisNodCoor').disabled = false;
	document.getElementById('nomNodCor').style.border = "1px solid #0A0";
	document.getElementById('dirFisNodCoor').style.border = "1px solid #0A0";
}

function guardarCambioNC(idNC)
{
	var nomNC = document.getElementById("nomNodCor").value;
	if(nomNC=="")
	{
		document.getElementById("nomNodCor").style.border= "1px solid red";
		alert("Inserte Nombre.");
		return;
	}
	
	var dirFisNC = document.getElementById("dirFisNodCoor").value;
	if(dirFisNC=="")
	{
		document.getElementById("dirFisNodCoor").style.border= "1px solid red";
		alert("Inserte Dirección Física.");
		return;
	}


	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	    	
	    	getCoordinadores();
	    	alert("Se guardo los cambios. \nActualizar para que funcione correctamente.");
	    }
	};
	xhttp.open("GET", "nodoCoordinador/guardarCambiosUnNodoCoordinador.php?idNC="+idNC+"&nomNC="+nomNC+"&dirFisNC="+dirFisNC, true);
	xhttp.send();
}