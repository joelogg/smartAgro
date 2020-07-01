<?php
include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];
$idNodTer = $_GET['idNodTer'];

$sql = "INSERT INTO camponodoterminal(IdCam, IdNodTer) VALUES ('".$idCam."','".$idNodTer."')";

if ($conexion->query($sql) === TRUE) 
{
    $sql = "UPDATE nodoterminal SET UsaNodTer=1 WHERE IdNodTer='".$idNodTer."'";

	if ($conexion->query($sql) === TRUE) 
	{
	    echo 'Sensor Agregado!';
	} 
} 
else 
{
    echo "Error, no agregado!" ;
}

$conexion->close();
?>