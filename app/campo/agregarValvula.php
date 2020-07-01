<?php
include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];
$nomVal = $_GET['nomVal'];
$idNodRut = $_GET['idNodRut'];
$ordVal = $_GET['ordVal'];

$sql = "INSERT INTO valvula(IdNodRutVal, IdCamVal, NomVal, OrdVal) 
	VALUES ('".$idNodRut."', '".$idCam."', '".$nomVal."', '".$ordVal."')";

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