var idNutEliminados = [];
var canNutrientesN=0;

function editarCambioNut()
{
	idNutEliminados = [];
	canNutrientesN=0;
	document.getElementById('desNut').disabled = false;
	document.getElementById('desNut').style.border = "1px solid #0A0";
}



function guardarCambioNut(idNut)
{
	var desNut = document.getElementById('desNut').value;
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
	    	idNutEliminados = [];
	    	var validar = xhttp.responseText;
	    	console.log(validar);
	    	getNutrientes();
	    	alert("Se guardo los cambios. \nActualizar para que funcione correctamente.");
	    }
	};
	xhttp.open("GET", "nutriente/guardarCambiosNutriente.php?idNut="+idNut+"&desNut="+desNut, true);
	xhttp.send();
}