<?php
include ("../../partes/conexion.php");
$idNodTer = $_GET['idNodTer'];
$idCam = $_GET['idCam'];

$sql = "DELETE FROM camponodoterminal WHERE IdNodTer='".$idNodTer."' AND IdCam='".$idCam."'";
if ($conexion->query($sql) === TRUE) 
{
    echo "Record deleted successfully";
} 
else 
{
    echo "Error deleting record: " . $conexion->error;
}

$sql = "UPDATE nodoterminal SET UsaNodTer=0 WHERE IdNodTer='".$idNodTer."'";

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