//Para resaltar elmenu seleccionado
var tipoMenu = 0;
function seleccionarMenu(idMenu)
{
	tipoMenu = idMenu;
	var i;
	var nombre;
	for (i = 1; i <=6; i++)
	{
		if(i==2)
		{
		}
	    else if(idMenu==i)
	    {	//opcion a resaltar
	    	document.getElementById("m"+i).style.background = 'rgba(192,240,224,1)';
			document.getElementById("m"+i).style.background = '-moz-linear-gradient(top, rgba(192,240,224,1) 0%, rgba(174,207,194,1) 50%, rgba(147,199,179,1) 51%, rgba(174,217,200,1) 100%)';
			document.getElementById("m"+i).style.background = '-webkit-gradient(left top, left bottom, color-stop(0%, rgba(192,240,224,1)), color-stop(50%, rgba(174,207,194,1)), color-stop(51%, rgba(147,199,179,1)), color-stop(100%, rgba(174,217,200,1)))';
			document.getElementById("m"+i).style.background = '-webkit-linear-gradient(top, rgba(192,240,224,1) 0%, rgba(174,207,194,1) 50%, rgba(147,199,179,1) 51%, rgba(174,217,200,1) 100%)';
			document.getElementById("m"+i).style.background = '-o-linear-gradient(top, rgba(192,240,224,1) 0%, rgba(174,207,194,1) 50%, rgba(147,199,179,1) 51%, rgba(174,217,200,1) 100%)';
			document.getElementById("m"+i).style.background = '-ms-linear-gradient(top, rgba(192,240,224,1) 0%, rgba(174,207,194,1) 50%, rgba(147,199,179,1) 51%, rgba(174,217,200,1) 100%)';
			document.getElementById("m"+i).style.background = 'linear-gradient(to bottom, rgba(192,240,224,1) 0%, rgba(174,207,194,1) 50%, rgba(147,199,179,1) 51%, rgba(174,217,200,1) 100%)';
	    }
	    else
	    {
	    	document.getElementById("m"+i).style.background = 'rgba(247,244,247,1)';
			document.getElementById("m"+i).style.background = '-moz-linear-gradient(top, rgba(247,244,247,1) 0%, rgba(219,219,219,1) 45%, rgba(209,209,209,1) 55%, rgba(226,226,226,1) 100%)';
			document.getElementById("m"+i).style.background = '-webkit-gradient(left top, left bottom, color-stop(0%, rgba(247,244,247,1)), color-stop(45%, rgba(219,219,219,1)), color-stop(55%, rgba(209,209,209,1)), color-stop(100%, rgba(226,226,226,1)))';
			document.getElementById("m"+i).style.background = '-webkit-linear-gradient(top, rgba(247,244,247,1) 0%, rgba(219,219,219,1) 45%, rgba(209,209,209,1) 55%, rgba(226,226,226,1) 100%)';
			document.getElementById("m"+i).style.background = '-o-linear-gradient(top, rgba(247,244,247,1) 0%, rgba(219,219,219,1) 45%, rgba(209,209,209,1) 55%, rgba(226,226,226,1) 100%)';
			document.getElementById("m"+i).style.background = '-ms-linear-gradient(top, rgba(247,244,247,1) 0%, rgba(219,219,219,1) 45%, rgba(209,209,209,1) 55%, rgba(226,226,226,1) 100%)';
			document.getElementById("m"+i).style.background = 'linear-gradient(to bottom, rgba(247,244,247,1) 0%, rgba(219,219,219,1) 45%, rgba(209,209,209,1) 55%, rgba(226,226,226,1) 100%)';
	
	    }
	}
}

//Para ver las alertas
function clickAlertas()
{	tipoMenu=3;
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	    	
	    	var validar = xhttp.responseText;
		    document.getElementById('cuerpo').innerHTML = validar; 
	    }
	};
	xhttp.open("GET", "notificaciones/getAlertas.php", true);
	xhttp.send();
}

//Para ver las tareas
function clickTareas()
{
	xhttp.onreadystatechange = function() 
	{
	    if (xhttp.readyState == 4 && xhttp.status == 200) 
	    {	    	
	    	var validar = xhttp.responseText;
		    document.getElementById('cuerpo').innerHTML = validar; 
	    }
	};
	xhttp.open("GET", "notificaciones/getTareas.php", true);
	xhttp.send();
}