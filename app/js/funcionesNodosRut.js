var nodosRSeleccionadosAux = [];
var nodosRSeleccionados = [];

function agregarNodoRuteador()
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar;
	    }
	};
	xhttp.open("GET", "nodosRuteadores/formularioNodoRuteador.php", true);
	xhttp.send();
}

function agregarNodoRuteadorBD()
{
	var nomNR = document.getElementById("nomNR").value;
	if(nomNR=="")
	{
		document.getElementById("nomNR").style.border= "1px solid red";
		alert("Inserte Nombre.");
		return;
	}
	
	var dirFisNR = document.getElementById("dirFisNR").value;
	if(dirFisNR=="")
	{
		document.getElementById("dirFisNR").style.border= "1px solid red";
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
	    	console.log(validar);

	    	getRuteadores();
	    	if(validar=="Correcto")
	    		alert("Se ha creado un nodo ruteador. \nActualizar para que funcione correctamente.");
	    	else
	    		alert("Error. No se ha creado un nodo ruteador.");
	    }
	};
	xhttp.open("GET", "nodosRuteadores/agregarNodoRuteador.php?nomNR="+nomNR+"&dirFisNR="+dirFisNR+"&canValNodRut="+canValNodRut, true);
	xhttp.send();
}


function eliminarNodoRuteador()
{
	getNRSeleccionados();

	if(nodosRSeleccionados.length==0)
	{
		alert("Seleccione algún nodo ruteador");
		return;
	}

	if(nodosRSeleccionados.length>1)
	{
		alert("Por seguridad solo se permite eliminar uno por uno.");
		return;	
	}
	if(nodosRSeleccionados.length==1)
	{		
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {			    		
			    nodosRSeleccionados = [];
				alert("Nodo ruteador eliminado.");	
				location.reload();		
				return;					
		    }
		}
		xhttp.open("GET", "nodosRuteadores/eliminarNodoRuteador.php?idNodRut="+nodosRSeleccionados[0], true);
		xhttp.send();		
	}
}

function clicCheckNR(idNodRut)
{
	var pos = nodosRSeleccionadosAux.indexOf(idNodRut);
	if(pos==-1)
	{
		nodosRSeleccionadosAux.push(idNodRut);	
	}
	else
	{
		delete nodosRSeleccionadosAux[pos]; 
	}
}


function getNRSeleccionados()
{
	nodosRSeleccionados = [];
	for (var i = 0; i < nodosRSeleccionadosAux.length ; i++) 
	{
		if(nodosRSeleccionadosAux[i]!=undefined)
		{
			nodosRSeleccionados.push(nodosRSeleccionadosAux[i]);	
		}
	}
}