function editarCambioCampo()
{
	document.getElementById('nomCam').disabled = false;
	document.getElementById('idCul').disabled = false;
	document.getElementById('nomCam').style.border = "1px solid #0A0";
	document.getElementById('idCul').style.border = "1px solid #0A0";
}

var moverIcono= false;
function guardarCambioCampo(idCam)
{
	var nomCam = document.getElementById('nomCam').value;
	if(nomCam=="")
	{
		document.getElementById("nomCam").style.border= "1px solid red";
		alert("Inserte Nombre.");
		return;
	}


	var idCul = document.getElementById('idCul').value;
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	
	    	/*if(ediValNodTer==1)
	    	{	moverIcono= true;
	    		habilitarMoverEnCampo(idCam);//funcion encontrada en moverSeparador.js
	    	}
	    	else
	    	{
	    		habilitarMoverEnCampo(-1);
	    		moverIcono= false;
	    	}*/
	    	getCampos();
	    	alert("Se guardo los cambios. \nActualizar para que funcione correctamente.");
	    }
	};
	xhttp.open("GET", "campo/guardarCambiosCampo.php?idCam="+idCam+"&nomCam="+nomCam+"&idCul="+idCul, true);
	xhttp.send();
}

/*---------------------*/

function agregarValvula(idCam)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar;
	    }
	};
	xhttp.open("GET", "campo/formularioValvula.php?idCam="+idCam, true);
	xhttp.send();
}

function mostrarOrdenDisponibleNR()
{
	var idNodRut = document.getElementById('idNodRut').value;
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('ordVal').innerHTML = validar;
	    }
	};
	xhttp.open("GET", "campo/getOrdDisponible.php?idNodRut="+idNodRut, true);
	xhttp.send();
}

function agregarValvulaBD()
{
	var idCam = document.getElementById("idCam").value;

	var nomVal = document.getElementById("nomVal").value;
	if(nomVal=="")
	{
		document.getElementById("nomVal").style.border= "1px solid red";
		alert("Inserte Nombre.");
		return;
	}
	
	var idNodRut = document.getElementById("idNodRut").value;
	var ordVal = document.getElementById("ordVal").value;


	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	console.log(validar);

	    	getCampos();
	    	alert("Se ha creado una valvula. \nActualizar para que funcione correctamente.");
	    }
	};
	xhttp.open("GET", "campo/agregarValvula.php?idCam="+idCam+"&nomVal="+nomVal+"&idNodRut="+idNodRut+"&ordVal="+ordVal, true);
	xhttp.send();
}


function agregarSensor(idCam)
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;	
	    	document.getElementById('cuerpo').innerHTML = validar;
	    }
	};
	xhttp.open("GET", "campo/formularioSensor.php?idCam="+idCam, true);
	xhttp.send();
}

function agregarSensorBD()
{
	var idCam = document.getElementById("idCam").value;

	
	var nomNodTer = document.getElementById("nomNodTer").value;
	if(nomNodTer=="")
	{
		document.getElementById("nomNodTer").style.border= "1px solid red";
		alert("Inserte Un Nombre.");
		return;
	}
	var dirFisNodTer = document.getElementById("dirFisNodTer").value;
	if(dirFisNodTer=="")
	{
		document.getElementById("dirFisNodTer").style.border= "1px solid red";
		alert("Inserte Una Dirección Física.");
		return;
	}
	var canSenNodTer = document.getElementById("canSenNodTer").value;
	if(canSenNodTer=="" || canSenNodTer>4 || canSenNodTer<1)
	{
		document.getElementById("canSenNodTer").style.border= "1px solid red";
		alert("Inserte un numero entre 1 y 4.");
		return;
	}
	var idNodRut = document.getElementById("idNodRut").value;


	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	var validar = xhttp.responseText;
	    	console.log(validar);

	    	getCampos();
	    	alert("Se ha creado un sensor. \nActualizar para que funcione correctamente.");
	    }
	};
	xhttp.open("GET", "campo/agregarSensor.php?idCam="+idCam+"&dirFisNodTer="+dirFisNodTer+"&nomNodTer="+nomNodTer+"&canSenNodTer="+canSenNodTer+"&idNodRut="+idNodRut, true);
	xhttp.send();
}