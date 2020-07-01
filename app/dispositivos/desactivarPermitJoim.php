<?php
include ("../../partes/conexion.php");


$sql = "UPDATE actividades SET EstAct='0' WHERE CodAct='01'";

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