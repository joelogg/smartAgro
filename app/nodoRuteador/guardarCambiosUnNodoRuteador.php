<?php
include ("../../partes/conexion.php");
$idNR = $_GET['idNR'];
$nomNR = $_GET['nomNR'];
$dirFisNR = $_GET['dirFisNR'];
$canValNodRut = $_GET['canValNodRut'];

$sql = "UPDATE dispositivos SET NomDis='".$nomNR."', 
	DirFisDis=CONV('".$dirFisNR."', 16, 10) WHERE IdDis='".$idNR."'";

if ($conexion->query($sql) === TRUE) 
{
	$sql2 = "UPDATE nodoruteador SET CanValNodRut='".$canValNodRut."' WHERE IdDis='".$idNR."' ";

	if ($conexion->query($sql2) === TRUE) 
	{
	    echo "Correcto";
	} 
	else 
	{
	    echo "Error";
	}
} 
else 
{
    echo "Error";
}



$conexion->close();
?>