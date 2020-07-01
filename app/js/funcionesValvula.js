var editarValvulaFlag = false;
function editarValvula()
{
	document.getElementById('nomVal').disabled = false;
	/*document.getElementById('idCam').disabled = false;
	document.getElementById('idNodRut').disabled = false;
	document.getElementById('tipTarVal').disabled = false;*/
	document.getElementById('nomVal').style.border = "1px solid #0A0";
	/*document.getElementById('idCam').style.border = "1px solid #0A0";
	document.getElementById('idNodRut').style.border = "1px solid #0A0";
	document.getElementById('tipTarVal').style.border = "1px solid #0A0";*/

	if(document.getElementById('franajaAgregarTarea')!=null)
	{
		document.getElementById('franajaAgregarTarea').innerHTML = '<span id="icoAgregar"></span> Agregar Tareas Programadas';
		document.getElementById('franajaAgregarTarea').style.cursor = "pointer";
	}
	editarValvulaFlag = true;
}

function guardarCambioValvula(idVal)
{
	editarValvulaFlag = false;

	var nomVal = document.getElementById("nomVal").value;	
	if(nomVal=="")
	{
		document.getElementById("nomVal").style.border= "1px solid red";
		alert("Inserte Nombre.");
		return;
	}

	/*var idCam = document.getElementById("idCam").value;
	var idNodRut = document.getElementById("idNodRut").value;
	var tipTarVal = document.getElementById("tipTarVal").value;*/

	/*if (document.getElementById("fecIniTarVal")!=null)
	{		
		var fecIniTarVal = document.getElementById("fecIniTarVal").value;
		if(fecIniTarVal=="")
		{
			document.getElementById("fecIniTarVal").style.border= "1px solid red";
			alert("Inserte Fecha de Inicio.");
			return;
		}

		var fecFinTarVal = document.getElementById("fecFinTarVal").value;
		if(fecFinTarVal=="")
		{
			document.getElementById("fecFinTarVal").style.border= "1px solid red";
			alert("Inserte Fecha de Finalización.");
			return;
		}

		var horIniTarVal = document.getElementById("horIniTarVal").value;
		if(horIniTarVal=="")
		{
			document.getElementById("horIniTarVal").style.border= "1px solid red";
			alert("Inserte Hora de Inicio.");
			return;
		}

		var horFinTarVal = document.getElementById("horFinTarVal").value;
		if(horFinTarVal=="")
		{
			document.getElementById("horFinTarVal").style.border= "1px solid red";
			alert("Inserte Hora de Finalización.");
			return;
		}

		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {	    	
		    	var value = xhttp.responseText;
		    	console.log(value);
		    	mostrarUnaValvula(idVal);
		    	alert("Se guardo los cambios. \nActualizar para que funcione correctamente.");
		    }
		};
		xhttp.open("GET", "valvula/guardarCambiosValvulaTarea.php?idVal="+idVal+"&idCam="+idCam+"&nomVal="+nomVal+"&idNodRut="+idNodRut+"&tipTarVal="+tipTarVal+"&fecIniTarVal="+fecIniTarVal+"&fecFinTarVal="+fecFinTarVal+"&horIniTarVal="+horIniTarVal+"&horFinTarVal="+horFinTarVal, true);
		xhttp.send();
	}
	else
	{*/
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {	    	
		    	var value = xhttp.responseText;
		    	//console.log(value);
		    	mostrarUnaValvula(idVal);
		    	alert("Se guardo los cambios. \nActualizar para que funcione correctamente.");
		    }
		};
		xhttp.open("GET", "valvula/guardarCambiosValvula.php?idVal="+idVal+"&nomVal="+nomVal, true);
		xhttp.send();
	//}
}

function eliminarValvula(idVal)
{
	editarValvulaFlag = false;

	confirmar=confirm("¿Realmente desa eliminar esta valvula?"); 
	if (confirmar)
	{
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {	    	
		    	location.reload();
		    	alert("Se elimino un valvula.");
		    }
		};
		xhttp.open("GET", "valvula/eliminarValvula.php?idVal="+idVal, true);
		xhttp.send();
	} 
	else 
	{		
	}
}

function quitarValvula(idCam, idVal)
{
	confirmar=confirm("¿Realmente desa eliminar esta valvula?"); 
	if (confirmar)
	{
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {	    	
		    	clickCampoMapa(idCam);
		    }
		};
		xhttp.open("GET", "valvula/quitarValvula.php?idCam="+idCam+"&idVal="+idVal, true);
		xhttp.send();
	} 
	else 
	{		
	}
}

function accionarSwitchValvula (idVal) 
{
	var accionSV = document.getElementById("switchValvula").checked;

	var image = document.getElementById('imagenValvula');

	var accVal="";
	if(accionSV==true)
	{
		accVal="1";
		document.getElementById("estVal").value = "Abierta";
		document.getElementById("accVal").value = "Abrir";
		image.src = "img/valvulaAbierta.gif";
	}
	else
	{
		accVal="0";
		document.getElementById("estVal").value = "Cerrada";
		document.getElementById("accVal").value = "Cerrar";
		image.src = "img/valvulaCerrada.gif";
	}

	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {		    	
	    }
	};
	xhttp.open("GET", "valvula/accionarSwitchValvula.php?idVal="+idVal+"&accVal="+accVal, true);
	xhttp.send();
}


function agregarCeldaTarea()
{	
	if (!editarValvulaFlag)
	{
		return;
	}
	if (document.getElementById("fecIniTarVal")!=null)
	{
		return;
	}
	
	var table = document.getElementById("tablaFormularioAumentar");
	//Fecha inicio
	var row1 = table.insertRow(0);
	var cell11 = row1.insertCell(0);
	var cell12 = row1.insertCell(1);		  	
	cell11.innerHTML = "Fecha de Inicio:";
	cell12.innerHTML = '<input type="date" id="fecIniTarVal" style="border: 1px solid #0A0;">';
	//Fecha Fin
	var row2 = table.insertRow(1);
	var cell21 = row2.insertCell(0);
	var cell22 = row2.insertCell(1);		  	
	cell21.innerHTML = "Fecha de Finalización:";
	cell22.innerHTML = '<input type="date" id="fecFinTarVal" style="border: 1px solid #0A0;">';
	//Fecha inicio
	var row3 = table.insertRow(2);
	var cell31 = row3.insertCell(0);
	var cell32 = row3.insertCell(1);		  	
	cell31.innerHTML = "Hora de Inicio:";
	cell32.innerHTML = '<input type="time" id="horIniTarVal" style="border: 1px solid #0A0;">';
	//Fecha inicio
	var row4 = table.insertRow(3);
	var cell41 = row4.insertCell(0);
	var cell42 = row4.insertCell(1);		  	
	cell41.innerHTML = "Hora de Finalización:";
	cell42.innerHTML = '<input type="time" id="horFinTarVal" style="border: 1px solid #0A0;">';
	
	document.getElementById('franajaAgregarTarea').innerHTML = 'Tarea Nueva';
	document.getElementById('franajaAgregarTarea').style.cursor = "initial";
}

function eliminarTareaP(idTarVal, idVal)
{
	confirmar=confirm("¿Realmente desa eliminar esta tarea programada?"); 	
	if (confirmar)
	{
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {	   	
		    	mostrarUnaValvula(idVal);
		    	alert("Se elimino un tarea programada.");
		    }
		};
		xhttp.open("GET", "valvula/eliminarTareaP.php?idTarVal="+idTarVal, true);
		xhttp.send();
	} 
	else 
	{		
	}
}