var canNutrientes=0;
function agregarCultivo()
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
	xhttp.open("GET", "cultivos/formularioCultivo.php", true);
	xhttp.send();
}

function agregarCelda()
{	
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	var table = document.getElementById("tablaFormularioAumentar");
			{
		  	var row = table.insertRow(0);
		  	var cell1 = row.insertCell(0);
		  	var cell2 = row.insertCell(1);
		  	
		  	cell1.innerHTML = "Nutriente: ";
		  	cell2.innerHTML = '<select onchange="nuevoN('+canNutrientes+')" id="nutriente'+canNutrientes+'">'+validar+'<input type="text" id="nomNutNue'+canNutrientes+'" style="visibility: hidden;" >';
		  	canNutrientes++;
		  	}
	    }
	};
	xhttp.open("GET", "cultivos/getNutrientes.php", true);
	xhttp.send();	
}

function nuevoN(ob)
{
	var valorSelect = document.getElementById("nutriente"+ob).value;
	if(valorSelect==-2)
	{
		document.getElementById("nomNutNue"+ob).style.visibility = "visible";
	}
	else
	{
		document.getElementById("nomNutNue"+ob).style.visibility = "hidden";
	}
}

function agregarCultivoBD()
{
	var nomCul = document.getElementById("nomCul").value;
	if(nomCul=="")
	{
		document.getElementById("nomCul").style.border= "1px solid red";
		alert("Inserte Nombre.");
		return;
	}
	var humMinCul = document.getElementById("humMinCul").value;
	var humMaxCul = document.getElementById("humMaxCul").value;

	var nutCul = "";
	for (var i = 0; i < canNutrientes; i++) 
	{
		nutCul = nutCul + document.getElementById("nutriente"+i).value + ",";
	}

	var nutCulNue = "";
	for (var i = 0; i < canNutrientes; i++) 
	{
		nutCulNue = nutCulNue + document.getElementById("nomNutNue"+i).value + ",";
	}
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	console.log(validar);

	    	getCultivos();
	    	alert("Se ha creado un cultivo. \nActualizar para que funcione correctamente.");
	    }
	};
	xhttp.open("GET", "cultivos/agregarCultivo.php?nomCul="+nomCul+"&humMinCul="+humMinCul+"&humMaxCul="+humMaxCul+"&nutCul="+nutCul+"&nutCulNue="+nutCulNue, true);
	xhttp.send();
}



var cultivosSeleccionadosAux = [];
var cultivosSeleccionados = [];




function eliminarCultivo()
{
	getCultivosSeleccionados();

	if(cultivosSeleccionados.length==0)
	{
		alert("Seleccione algún cultivo");
		return;
	}

	if(cultivosSeleccionados.length>1)
	{
		alert("Por seguridad solo se permite eliminar uno por uno.");	
	}
	if(cultivosSeleccionados.length==1)
	{		
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {			    		
			   	cultivosSeleccionados = [];
				alert("Cultivo eliminado.");					
				location.reload();		
				return;	
		    }
		}
		xhttp.open("GET", "cultivos/eliminarCultivo.php?idCul="+cultivosSeleccionados[0], true);
		xhttp.send();		
	}
}


function clicCheck(idCul)
{
	var pos = cultivosSeleccionadosAux.indexOf(idCul);
	if(pos==-1)
	{
		cultivosSeleccionadosAux.push(idCul);	
	}
	else
	{
		delete cultivosSeleccionadosAux[pos]; 
	}
}

function getCultivosSeleccionados()
{
	cultivosSeleccionados = [];
	for (var i = 0; i < cultivosSeleccionadosAux.length ; i++) 
	{
		if(cultivosSeleccionadosAux[i]!=undefined)
		{
			cultivosSeleccionados.push(cultivosSeleccionadosAux[i]);	
		}
	}
}
