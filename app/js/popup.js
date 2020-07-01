var anchoV;
var altoV;

//ancho, tipo( campo=0, sensor=1, valvula=2, otros=10), idDispositivo
var tipoPopUp;
var idDispositivoPopUp;
function abrirPopUp(ancho, tipo, idDispositivo)
{
	//cerrarPopUp();
	tipoPopUp = tipo;
	idDispositivoPopUp = idDispositivo;

	anchoV = window.innerWidth;

	document.getElementById('contenidoPopUp').style.width = ancho+"px";
		

	/*document.getElementById('popup').style.maxWidth = "450px";*/
	document.getElementById('popup').style.maxHeight = "750px";	

	document.getElementById('popup').style.left = ((anchoV-ancho)/2)+"px";

	document.getElementById('popupFondo').style.visibility = "visible";
	document.getElementById('popup').style.visibility = "visible";
	$("#popup").animate({width: (ancho+'px'), opacity: '1'}, "slow");
	document.getElementsByTagName("html")[0].style.overflow = "hidden";

}

function cerrarPopUp()
{

	$("#popup").animate({width: '0px', opacity: '0.2'}, "slow");
	document.getElementById('popupFondo').style.visibility = "hidden";
	document.getElementById('popup').style.visibility = "hidden";
	document.getElementsByTagName("html")[0].style.overflow = "auto";
}