var camposSeleccionadosActivosAux = [];
var camposSeleccionadosVaciosAux = [];
var camposSeleccionadosActivos = [];
var camposSeleccionadosVacios = [];

function agregarCampo()
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {
	    	getCamposPropiedades();
	    	alert("Se ha creado un campo. \nPara agregar sus propiedades dirijase al campo creado. \nActualizar para que funcione correctamente.");
	    }
	};
	xhttp.open("GET", "campos/agregarCampo.php", true);
	xhttp.send();
}

function eliminarCampo()
{
	getCamposSeleccionadosActivos();
	getCamposSeleccionadosVacios();

	if(camposSeleccionadosActivos.length==0 && camposSeleccionadosVacios.length==0)
	{
		alert("Seleccione algún campo");
		return;
	}

	if(camposSeleccionadosActivos.length>0 && camposSeleccionadosVacios.length>0)
	{
		alert("Seleccione solo un tipo de campos (Activos o Vacios)");
		return;
	}

	if(camposSeleccionadosActivos.length>1)
	{
		alert("Por seguridad solo se permite eliminar uno por uno.");	
	}
	if(camposSeleccionadosActivos.length==1)
	{		
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {		  		
			    camposSeleccionadosActivos = [];
				alert("Campo eliminado.");					
				location.reload();		
				return;	
		    }
		}
		xhttp.open("GET", "campos/eliminarCampoActivo.php?idCam="+camposSeleccionadosActivos[0], true);
		xhttp.send();		
	}

	if(camposSeleccionadosVacios.length>1)
	{
		alert("Por seguridad solo se permite eliminar uno por uno.");	
	}
	if(camposSeleccionadosVacios.length==1)
	{		
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {			    		
			    camposSeleccionadosVacios = [];
				alert("Campo eliminado.");	
				location.reload();		
				return;					
		    }
		}
		xhttp.open("GET", "campos/eliminarCampoVacio.php?idCam="+camposSeleccionadosVacios[0], true);
		xhttp.send();		
	}
}
function restaurarCampo()
{
	getCamposSeleccionadosActivos();
	getCamposSeleccionadosVacios();

	if(camposSeleccionadosActivos.length==0 && camposSeleccionadosVacios.length==0)
	{
		alert("Seleccione algún campo Vacio");
		return;
	}

	if(camposSeleccionadosActivos.length>0 && camposSeleccionadosVacios.length>0)
	{
		alert("Seleccione solo Campos Vacios");
		return;
	}

	if(camposSeleccionadosActivos.length>0)
	{
		alert("Sin Acciones");
		return;
	}

	if(camposSeleccionadosVacios.length>1)
	{
		alert("Por seguridad solo se permite restaurar uno por uno.");	
	}
	if(camposSeleccionadosVacios.length==1)
	{
		xhttp.onreadystatechange = function() 
		{
		    if (xhttp.readyState == 4 && xhttp.status == 200) 
		    {		   		
			    camposSeleccionadosVacios = [];
				alert("Restaurado");					
				location.reload();		
				return;	
		    }
		}
		xhttp.open("GET", "campos/restaurarCampoVacio.php?idCam="+camposSeleccionadosVacios[0], true);
		xhttp.send();
	}
}

function clicCheckActivo(idCam)
{
	var pos = camposSeleccionadosActivosAux.indexOf(idCam);
	if(pos==-1)
	{
		camposSeleccionadosActivosAux.push(idCam);	
	}
	else
	{
		delete camposSeleccionadosActivosAux[pos]; 
	}
}

function clicCheckVacio(idCam)
{
	var pos = camposSeleccionadosVaciosAux.indexOf(idCam);
	if(pos==-1)
	{
		camposSeleccionadosVaciosAux.push(idCam);
	}
	else
	{
		delete camposSeleccionadosVaciosAux[pos]; 
	}
	
}
function getCamposSeleccionadosActivos()
{
	camposSeleccionadosActivos = [];
	for (var i = 0; i < camposSeleccionadosActivosAux.length ; i++) 
	{
		if(camposSeleccionadosActivosAux[i]!=undefined)
		{
			camposSeleccionadosActivos.push(camposSeleccionadosActivosAux[i]);	
		}
	}
}

function getCamposSeleccionadosVacios()
{
	camposSeleccionadosVacios = [];
	for (var i = 0; i < camposSeleccionadosVaciosAux.length ; i++) 
	{
		if(camposSeleccionadosVaciosAux[i]!=undefined)
		{
			camposSeleccionadosVacios.push(camposSeleccionadosVaciosAux[i]);
		}
	}
}

