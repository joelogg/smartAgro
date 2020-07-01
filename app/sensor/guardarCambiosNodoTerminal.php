<?php
include ("../../partes/conexion.php");
$idNodTer = $_GET['idNodTer'];
$idCam = $_GET['idCam'];
$nomNodTer = $_GET['nomNodTer'];
$canSen = $_GET['canSen'];
$dirFisNodTer = $_GET['dirFisNodTer'];
$idNodRut = $_GET['idNodRut'];

$sql = "UPDATE nodoterminal SET IdNodRutNodTer='".$idNodRut."', IdCamNodTer='".$idCam."', 
	NomNodTer='".$nomNodTer."', DirFisNodTer=CONV('".$dirFisNodTer."', 16, 10), CanSenNodTer='".$canSen."' WHERE IdNodTer='".$idNodTer."'";

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