<?php
include ("../../partes/conexion.php");


$sql = "INSERT INTO actividades(CodAct) VALUES ('238')";

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