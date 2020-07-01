<?php
include ("../../partes/conexion.php");

$sql = "INSERT INTO campo(IdCul, NomCam, ActCam) VALUES (1,'Vacio', 0)";

if ($conexion->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>