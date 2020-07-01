<?php
include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];
$idVal = $_GET['idVal'];

$sql = "INSERT INTO campovalvula(IdCam, IdVal) VALUES ('".$idCam."','".$idVal."')";

if ($conexion->query($sql) === TRUE) 
{
    $sql = "UPDATE valvula SET UsaVal=1 WHERE IdVal='".$idVal."'";

	if ($conexion->query($sql) === TRUE) 
	{
	    echo 'Valvula Agregada!';
	} 
} 
else 
{
    echo "Error, no agregado!" ;
}

$conexion->close();
?>