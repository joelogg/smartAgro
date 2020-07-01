<?php
include ("../../partes/conexion.php");
$idVal = $_GET['idVal'];
$nomVal = $_GET['nomVal'];

$sql = "UPDATE valvula SET NomVal='".$nomVal."' WHERE IdVal='".$idVal."'";

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