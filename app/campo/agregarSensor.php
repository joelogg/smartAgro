<?php
include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];
$nomNodTer= $_GET['nomNodTer'];
$dirFisNodTer = $_GET['dirFisNodTer'];
$canSenNodTer = $_GET['canSenNodTer'];
$idNodRut = $_GET['idNodRut'];


$sql = "INSERT INTO nodoterminal(IdNodRutNodTer, IdCamNodTer, NomNodTer, DirFisNodTer, CanSenNodTer) 
VALUES ('".$idNodRut."', '".$idCam."', '".$nomNodTer."', CONV('".$dirFisNodTer."', 16, 10), '".$canSenNodTer."')";

if ($conexion->query($sql) === TRUE) 
{
    echo "New record created successfully";
} 
else 
{
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>