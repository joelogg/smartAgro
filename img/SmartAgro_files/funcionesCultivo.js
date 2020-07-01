var idNutEliminados = [];
var canNutrientesN=0;

function editarCambioCul()
{
	idNutEliminados = [];
	canNutrientesN=0;
	document.getElementById('nomCul').disabled = false;
	document.getElementById('humMinCul').disabled = false;
	document.getElementById('humMaxCul').disabled = false;
	document.getElementById('nomCul').style.border = "1px solid #0A0";
	document.getElementById('humMinCul').style.border = "1px solid #0A0";
	document.getElementById('humMaxCul').style.border = "1px solid #0A0";

	var cant = document.getElementsByClassName("botonEliNut").length;
	for (var i=0; i<cant; i++)
	{
		document.getElementsByClassName("botonEliNut")[i].disabled = false;
		document.getElementsByClassName("botonEliNut")[i].style.border = "1px solid #0A0";
	}

	document.getElementById('franjaAux').style.visibility= "hidden";
	document.getElementById('franjaReal').style.visibility= "visible";
	document.getElementById('franjaReal').style.cursor = "pointer";
	document.getElementById('franjaReal').innerHTML = '<span id="icoAgregar"></span> Agregar Nutrientes';
}


function eliminarN(idNut)
{
	document.getElementById('idNut'+idNut).value = "";
	var valorIgual=false;
	for (var i=0 ; i<idNutEliminados.length; i++)
	{
		if(idNut==idNutEliminados[i])
		{
			valorIgual=true;
		}
	}
	if(!valorIgual)
		idNutEliminados.push(idNut);
	console.log(idNutEliminados);
}

function agregarCeldaUnNutriente()
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
		  	cell2.innerHTML = '<select onchange="nuevoN('+canNutrientesN+')" id="nutriente'+canNutrientesN+'">'+validar+'<input type="text" id="nomNutNue'+canNutrientesN+'" style="visibility: hidden;" >';
		  	canNutrientesN++;
		  	}
	    }
	};
	xhttp.open("GET", "cultivo/getNutrientes.php", true);
	xhttp.send();	
}

function guardarCambioCul(idCul)
{
	var nomCul = document.getElementById('nomCul').value;
	if(nomCul=="")
	{
		document.getElementById("nomCul").style.border= "1px solid red";
		alert("Inserte Nombre.");
		return;
	}
	
	var humMinCul = document.getElementById('humMinCul').value;
	var humMaxCul = document.getElementById('humMaxCul').value;

	var nutCul = "";
	for (var i = 0; i < canNutrientesN; i++) 
	{
		nutCul = nutCul + document.getElementById("nutriente"+i).value + ",";
	}

	var nutCulNue = "";
	for (var i = 0; i < canNutrientesN; i++) 
	{
		nutCulNue = nutCulNue + document.getElementById("nomNutNue"+i).value + ",";
	}

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	
	    	idNutEliminados = [];
	    	var validar = xhttp.responseText;
	    	console.log(validar);
	    	getCultivos();
	    	alert("Se guardo los cambios. \nActualizar para que funcione correctamente.");
	    }
	};
	xhttp.open("GET", "cultivo/guardarCambiosCultivo.php?idCul="+idCul+"&nomCul="+nomCul+"&humMinCul="+humMinCul+"&humMaxCul="+humMaxCul+"&idNutEliminados="+idNutEliminados+","+"&nutCul="+nutCul+"&nutCulNue="+nutCulNue, true);
	xhttp.send();
}