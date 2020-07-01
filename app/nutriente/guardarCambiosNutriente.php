<?php
include ("../../partes/conexion.php");
$idNut = $_GET['idNut'];
$desNut = $_GET['desNut'];



$sql = "UPDATE nutrientes SET desNut='".$desNut."' WHERE IdNut='".$idNut."'";

if ($conexion->query($sql) === TRUE) 
{
    echo "-Record updated successfully";
} 
else 
{
    echo "Error updating record: " . $conexion->error;
}



$conexion->close();
?>