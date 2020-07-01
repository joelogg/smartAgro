<?php
include ("../../partes/conexion.php");
$idCul = $_GET['idCul'];

$sql = "DELETE FROM cultivonutrientes WHERE IdCul='".$idCul."'";
if ($conexion->query($sql) === TRUE) 
{
    echo "Record deleted successfully";
} 
else 
{
    echo "Error deleting record: " . $conexion->error;
}


$sql = "DELETE FROM cultivo WHERE IdCul='".$idCul."'";
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