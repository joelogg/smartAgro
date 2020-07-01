var nodosCSeleccionadosAux = [];
var nodosCSeleccionados = [];

function agregarNodoCoordinador()
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar;
	    }
	};
	xhttp.open("GET", "nodosCoordinadores/formularioNodoCoordinado.php", true);
	xhttp.send();
}

function agregarNodoCoordinadorBD()
{
	var nomNC = document.getElementById("nomNC").value;
	if(nomNC=="")
	{
		document.getElementById("nomNC").style.border= "1px solid red";
		alert("Inserte Nombre.");
		return;
	}
	
	var dirFisNC = document.getElementById("dirFisNC").value;
	if(dirFisNC=="")
	{
		document.getElementById("dirFisNC").style.border= "1px solid red";
		alert("Inserte Dirección Física.");
		return;
	}

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	console.log(validar);

	    	getCoordinadores();
	    	alert("Se ha creado un nodo coordinador. \nActualizar para que funcione correctamente.");
	    }
	};
	xhttp.open("GET", "nodosCoordinadores/agregarNodoCoordinador.php?nomNC="+nomNC+"&dirFisNC="+dirFisNC, true);
	xhttp.send();
}


function eliminarNodoCoordinador()
{
	getNCSeleccionados();

	if(nodosCSeleccionados.length==0)
	{
		alert("Seleccione algún nodo coordinador");
		return;
	}

	if(nodosCSeleccionados.length>1)
	{
		alert("Por seguridad solo se permite eliminar uno por uno.");
		return;	
	}
	if(nodosCSeleccionados.length==1)
	{		
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {			    		
			    nodosCSeleccionados = [];
				alert("Nodo coordinador eliminado.");	
				location.reload();		
				return;					
		    }
		}
		xhttp.open("GET", "nodosCoordinadores/eliminarNodoCoordinador.php?idNodCoo="+nodosCSeleccionados[0], true);
		xhttp.send();		
	}
}

function clicCheckNC(idNodCoo)
{
	var pos = nodosCSeleccionadosAux.indexOf(idNodCoo);
	if(pos==-1)
	{
		nodosCSeleccionadosAux.push(idNodCoo);	
	}
	else
	{
		delete nodosCSeleccionadosAux[pos]; 
	}
}


function getNCSeleccionados()
{
	nodosCSeleccionados = [];
	for (var i = 0; i < nodosCSeleccionadosAux.length ; i++) 
	{
		if(nodosCSeleccionadosAux[i]!=undefined)
		{
			nodosCSeleccionados.push(nodosCSeleccionadosAux[i]);	
		}
	}
}