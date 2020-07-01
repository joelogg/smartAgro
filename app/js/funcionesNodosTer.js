var nodosTSeleccionadosAux = [];
var nodosTSeleccionados = [];

function agregarNodoTerminal()
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar;
	    }
	};
	xhttp.open("GET", "nodosTerminales/formularioNodoTerminal.php", true);
	xhttp.send();
}

function agregarNodoTerminalBD()
{
	var nomNT = document.getElementById("nomNT").value;
	if(nomNT=="")
	{
		document.getElementById("nomNT").style.border= "1px solid red";
		alert("Inserte Nombre.");
		return;
	}
	
	var dirFisNT = document.getElementById("dirFisNT").value;
	if(dirFisNT=="")
	{
		document.getElementById("dirFisNT").style.border= "1px solid red";
		alert("Inserte Dirección Física.");
		return;
	}

	var canSenNodTer = document.getElementById("canSenNodTer").value;
	if(canSenNodTer=="")
	{
		document.getElementById("canSenNodTer").style.border= "1px solid red";
		alert("Inserte cantidad máxima de sensores.");
		return;
	}

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	console.log(validar);

	    	getTerminales();
	    	if(validar=="Correcto")
	    		alert("Se ha creado un nodo terminal. \nActualizar para que funcione correctamente.");
	    	else
	    		alert("Error. No se ha creado un nodo terminal.");
	    }
	};
	xhttp.open("GET", "nodosTerminales/agregarNodoTerminal.php?nomNT="+nomNT+"&dirFisNT="+dirFisNT+"&canSenNodTer="+canSenNodTer, true);
	xhttp.send();
}


function eliminarNodoTerminal()
{
	getNTSeleccionados();

	if(nodosTSeleccionados.length==0)
	{
		alert("Seleccione algún nodo terminal");
		return;
	}

	if(nodosTSeleccionados.length>1)
	{
		alert("Por seguridad solo se permite eliminar uno por uno.");
		return;	
	}
	if(nodosTSeleccionados.length==1)
	{		
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {			    		
			    nodosTSeleccionados = [];
				alert("Nodo terminal eliminado.");	
				location.reload();		
				return;					
		    }
		}
		xhttp.open("GET", "nodosTerminales/eliminarNodoTerminal.php?idNodTer="+nodosTSeleccionados[0], true);
		xhttp.send();		
	}
}

function clicCheckNT(idNodTer)
{
	var pos = nodosTSeleccionadosAux.indexOf(idNodTer);
	if(pos==-1)
	{
		nodosTSeleccionadosAux.push(idNodTer);	
	}
	else
	{
		delete nodosTSeleccionadosAux[pos]; 
	}
}


function getNTSeleccionados()
{
	nodosTSeleccionados = [];
	for (var i = 0; i < nodosTSeleccionadosAux.length ; i++) 
	{
		if(nodosTSeleccionadosAux[i]!=undefined)
		{
			nodosTSeleccionados.push(nodosTSeleccionadosAux[i]);	
		}
	}
}