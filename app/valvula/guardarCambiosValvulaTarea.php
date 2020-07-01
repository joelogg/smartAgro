<?php
include ("../../partes/conexion.php");
$idVal = $_GET['idVal'];
$idCam = $_GET['idCam'];
$nomVal = $_GET['nomVal'];
$idNodRut = $_GET['idNodRut'];
$tipTarVal = $_GET['tipTarVal'];

$fecIniTarVal = $_GET['fecIniTarVal'];
$fecFinTarVal = $_GET['fecFinTarVal'];
$horIniTarVal = $_GET['horIniTarVal'];
$horFinTarVal = $_GET['horFinTarVal'];


$sql = "UPDATE valvula SET IdNodRutVal='".$idNodRut."', IdCamVal='".$idCam."', NomVal='".$nomVal."', TipTarVal='".$tipTarVal."' WHERE IdVal='".$idVal."'";

if ($conexion->query($sql) === TRUE) 
{
    echo "Record updated successfully";
} 
else 
{
    echo "Error updating record: " . $conexion->error;
}

$sql = "INSERT INTO tareavalvula (IdVal, FecIniTarVal, FecFinTarVal, HorIniTarVal, HorFinTarVal) VALUES ('".$idVal."', '".$fecIniTarVal."', '".$fecFinTarVal."', '".$horIniTarVal."', '".$horFinTarVal."')";

if ($conexion->query($sql) === TRUE) 
{
    echo "Correcto";
} 
else 
{
    echo "Error";
}


$conexion->close();
?>