<?php
include ("../../partes/conexion.php");

$idCam = $_GET["idCam"]; 
$posGraCam = $_GET["posGraCam"];


$posXLetra=100000;
$posYLetra=100000;
$numeroX="";
$numeroY="";
$tipoCaracter = "numero1";
for($i=0; $i<strlen($posGraCam); $i++)
{
	$caracter = substr($posGraCam, $i, 1 );
	if($caracter == ",")
	{
		$tipoCaracter = "numero2";
	}
	elseif ($caracter == " ") 
	{
		if($numeroX<$posXLetra)
		{
			$posXLetra = $numeroX;
			$posYLetra = $numeroY;
		}
		$tipoCaracter = "numero1";
		$numeroX="";
		$numeroY="";
	}
	else
	{
		if($tipoCaracter == "numero1")
		{
			$numeroX = $numeroX.$caracter;
		}	
		elseif($tipoCaracter == "numero2")
		{
			$numeroY = $numeroY.$caracter;
		}	
	}
	
}
if($numeroX<$posXLetra)
{
	$posXLetra = $numeroX;
	$posYLetra = $numeroY;
}


$sql = "UPDATE campo SET PosGraCam='".$posGraCam."', PosXTexCam='".$posXLetra."', 
	PosYTexCam='".$posYLetra."' WHERE IdCam='".$idCam."'";

if ($conexion->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conexion->error;
}


/*----Reicinicando puntos de sensores---*/
$sql = "UPDATE nodoterminal SET PosXNodTer='0', PosYNodTer='0' 
	WHERE IdCamNodTer='".$idCam."'";

if ($conexion->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conexion->error;
}


/*----Reicinicando puntos de valvulas---*/
$sql = "UPDATE valvula SET PosXVal='0', PosYVal='0' WHERE IdCamVal='".$idCam."'";;

if ($conexion->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conexion->error;
}

$conexion->close();
?>