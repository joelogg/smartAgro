<?php
include ("../../partes/conexion.php");
$idVal = $_GET['idVal'];
$posX = $_GET['posX'];
$posY = $_GET['posY'];

$sql = "UPDATE valvula SET CambVal=1, PosXVal='".$posX."', PosYVal='".$posY."' 
	WHERE IdVal='".$idVal."'";

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