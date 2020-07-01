<?php
include ("../../partes/conexion.php");
$desNut = $_GET['desNut'];

$sql = "INSERT INTO nutrientes(DesNut) VALUES ('".$desNut."')";

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