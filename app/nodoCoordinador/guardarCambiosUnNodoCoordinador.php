<?php
include ("../../partes/conexion.php");
$idNodCoo = $_GET['idNC'];
$nomNC = $_GET['nomNC'];
$dirFisNC = $_GET['dirFisNC'];

$sql = "UPDATE dispositivos SET NomDis='".$nomNC."', DirFisDis=CONV('".$dirFisNC."', 16, 10) WHERE IdDis='".$idNodCoo."'";

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