<?php
include ("../../partes/conexion.php");

$idDis = $_GET['idDis'];
$idNodTer = $_GET['idNodTer'];
$nomNodTer = $_GET['nomNodTer'];
$dirFisNodTer = $_GET['dirFisNodTer'];
$canSenNodTer = $_GET['canSenNodTer'];

$sql = "UPDATE nodoterminal SET CanSenNodTer='".$canSenNodTer."' WHERE IdNodTer='".$idNodTer."'";

if ($conexion->query($sql) === TRUE) 
{	
} 
else 
{
    echo "Error";
}

$sql = "UPDATE dispositivos SET NomDis='".$nomNodTer."', 
	DirFisDis=CONV('".$dirFisNodTer."', 16, 10) WHERE IdDis='".$idDis."'";

if ($conexion->query($sql) === TRUE) 
{	
} 
else 
{
    echo "Error";
}



$conexion->close();
?>