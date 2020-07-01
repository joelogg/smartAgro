<?php
include ("../../partes/conexion.php");
$idDis = $_GET['idDis'];
$posX = $_GET['posX'];
$posY = $_GET['posY'];

$sql = "UPDATE dispositivos SET CambDis=1, PosXDis='".$posX."', PosYDis='".$posY."'
	WHERE IdDis='".$idDis."'";

if ($conexion->query($sql) === TRUE) 
{
    echo "Record updated successfully";
} 
else 
{
    echo "Error updating record: " . $conexion->error;
}


$conexion->close();
?>