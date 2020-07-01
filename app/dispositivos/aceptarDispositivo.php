<?php
include ("../../partes/conexion.php");
$idDis = $_GET['idDis'];

$sql = "UPDATE dispositivospermitjoin SET EstDis='1' WHERE IdDis='".$idDis."'";

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