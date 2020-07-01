var canNutrientes=0;
function agregarNutriente()
{
	canNutrientes=0;
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar;
	    }
	};
	xhttp.open("GET", "nutrientes/formularioNutriente.php", true);
	xhttp.send();
}



function agregarNutrienteBD()
{
	var desNut = document.getElementById("desNut").value;
	if(desNut=="")
	{
		document.getElementById("desNut").style.border= "1px solid red";
		alert("Inserte Nombre.");
		return;
	}
	
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	console.log(validar);

	    	getNutrientes();
	    	alert("Se ha creado un nutriente. \nActualizar para que funcione correctamente.");
	    }
	};
	xhttp.open("GET", "nutrientes/agregarNutriente.php?desNut="+desNut, true);
	xhttp.send();
}



var nutrientesSeleccionadosAux = [];
var nutrientesSeleccionados = [];




function eliminarNutriente()
{
	getNutrientesSeleccionados();

	if(nutrientesSeleccionados.length==0)
	{
		alert("Seleccione algún nutriente");
		return;
	}

	if(nutrientesSeleccionados.length>1)
	{
		alert("Por seguridad solo se permite eliminar uno por uno.");	
	}
	if(nutrientesSeleccionados.length==1)
	{		
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {			    		
			   	nutrientesSeleccionados = [];
				alert("Nutriente eliminado.");					
				location.reload();		
				return;	
		    }
		}
		xhttp.open("GET", "nutrientes/eliminarNutriente.php?idNut="+nutrientesSeleccionados[0], true);
		xhttp.send();		
	}
}


function clicCheck(idNut)
{
	var pos = nutrientesSeleccionadosAux.indexOf(idNut);
	if(pos==-1)
	{
		nutrientesSeleccionadosAux.push(idNut);	
	}
	else
	{
		delete nutrientesSeleccionadosAux[pos]; 
	}
}

function getNutrientesSeleccionados()
{
	nutrientesSeleccionados = [];
	for (var i = 0; i < nutrientesSeleccionadosAux.length ; i++) 
	{
		if(nutrientesSeleccionadosAux[i]!=undefined)
		{
			nutrientesSeleccionados.push(nutrientesSeleccionadosAux[i]);	
		}
	}
}
