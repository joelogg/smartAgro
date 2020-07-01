<?php
include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];

$sql = "DELETE FROM campo WHERE IdCam='".$idCam."'";

if ($conexion->query($sql) === TRUE) 
{
    echo "Record deleted successfully";
} 
else 
{
    echo "Error deleting record: " . $conexion->error;
}

$conexion->close();
?>