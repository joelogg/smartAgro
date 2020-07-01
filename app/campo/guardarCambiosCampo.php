<?php
include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];
$nomCam = $_GET['nomCam'];
$idCul = $_GET['idCul'];


$sql = "UPDATE campo SET IdCul='".$idCul."', NomCam='".$nomCam."' WHERE IdCam='".$idCam."'";

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