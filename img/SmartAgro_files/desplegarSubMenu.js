//accion para mostrar los campos, clic en la flecha
var flechaDCampo = false;
function clicFlechaC()
{
	if(flechaDCampo)
	{	//se oculta todo
		document.getElementById('icoEstadoC').style.backgroundImage = "url('img/comprimido.png')";	
		flechaDCampo = false;
		$("#divCs").slideUp(500);
		//$(".divCs").hide(100);
		//$("#divCs").fadeOut(0);
	}
	else
	{	//se muestra todo
		document.getElementById('icoEstadoC').style.backgroundImage = "url('img/extendido.png')";	
		flechaDCampo = true;
		$("#divCs").slideDown(500);
		//$(".divCs").show(100);
		//$("#divCs").fadeIn(1500);
	}	
}

//accion para mostrar los otros dispositivos, clic en la flecha
var flechaDODispositivos = false;
function clicFlechaOD()
{
	if(flechaDODispositivos)
	{	//se oculta todo
		document.getElementById('icoEstadoOD').style.backgroundImage = "url('img/comprimido.png')";	
		flechaDODispositivos = false;
		$("#divOD").slideUp(500);
	}
	else
	{	//se muestra todo
		document.getElementById('icoEstadoOD').style.backgroundImage = "url('img/extendido.png')";	
		flechaDODispositivos = true;
		$("#divOD").slideDown(500);
	}	
}

//accion para mostrar los cultivos, clic en la flecha
var flechaCultivos = false;
function clicFlechaCultivos()
{
	if(flechaCultivos)
	{	//se oculta todo
		document.getElementById('icoEstadoCultivos').style.backgroundImage = "url('img/comprimido.png')";	
		flechaCultivos = false;
		$("#divCultivos").slideUp(500);
	}
	else
	{	//se muestra todo
		document.getElementById('icoEstadoCultivos').style.backgroundImage = "url('img/extendido.png')";	
		flechaCultivos = true;
		$("#divCultivos").slideDown(500);
	}	
}


//accion para mostrar contenido de un campo, clic en la flecha
var idUltCam = -1;
var flechaDCampos = false;
function clicFlechaCs(id)
{
	if(flechaDCampos)
	{
		if(idUltCam != id)
		{
			document.getElementById('icoEstadoCs'+idUltCam).style.backgroundImage = "url('img/comprimido.png')";
			$("#divV"+idUltCam).slideUp(500);
			flechaDCampos = false;
		}
	}
	
	if(flechaDCampos)
	{
		document.getElementById('icoEstadoCs'+id).style.backgroundImage = "url('img/comprimido.png')";
		flechaDCampos = false;
		$("#divV"+id).slideUp(500);
	}
	else
	{
		document.getElementById('icoEstadoCs'+id).style.backgroundImage = "url('img/extendido.png')";
		flechaDCampos = true;
		$("#divV"+id).slideDown(500);
	}
	idUltCam = id;
}


//accion para mostrar contenido Nodos Coordinadores, clic en la flecha
var flechaDNCoordinadores = false;
function clicFlechaNCs()
{
	if(flechaDNCoordinadores)
	{	//se oculta todo
		document.getElementById('icoEstadoNCs').style.backgroundImage = "url('img/comprimido.png')";	
		flechaDNCoordinadores = false;
		$("#divNC").slideUp(500);
	}
	else
	{	//se muestra todo
		document.getElementById('icoEstadoNCs').style.backgroundImage = "url('img/extendido.png')";	
		flechaDNCoordinadores = true;
		$("#divNC").slideDown(500);

		//se oculta NR
		document.getElementById('icoEstadoNRs').style.backgroundImage = "url('img/comprimido.png')";	
		flechaDNRuteadores = false;
		$("#divNR").slideUp(500);
	}	
}

//accion para mostrar contenido Nodos Ruteadores, clic en la flecha
var flechaDNRuteadores = false;
function clicFlechaNRs()
{
	if(flechaDNRuteadores)
	{	//se oculta todo
		document.getElementById('icoEstadoNRs').style.backgroundImage = "url('img/comprimido.png')";	
		flechaDNRuteadores = false;
		$("#divNR").slideUp(500);
	}
	else
	{	//se muestra todo
		document.getElementById('icoEstadoNRs').style.backgroundImage = "url('img/extendido.png')";	
		flechaDNRuteadores = true;
		$("#divNR").slideDown(500);

		//se oculta NC
		document.getElementById('icoEstadoNCs').style.backgroundImage = "url('img/comprimido.png')";	
		flechaDNCoordinadores = false;
		$("#divNC").slideUp(500);
	}	
}
