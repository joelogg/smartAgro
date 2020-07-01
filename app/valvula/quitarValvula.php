<?php
include ("../../partes/conexion.php");
$idVal = $_GET['idVal'];
$idCam = $_GET['idCam'];

$sql = "DELETE FROM campovalvula WHERE IdVal='".$idVal."' AND IdCam='".$idCam."'";
if ($conexion->query($sql) === TRUE) 
{
    echo "Record deleted successfully";
} 
else 
{
    echo "Error deleting record: " . $conexion->error;
}

$sql = "UPDATE valvula SET UsaVal=0 WHERE IdVal='".$idVal."'";

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