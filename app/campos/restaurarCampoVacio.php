<?php
include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];

//Se restaura el campo
$sql = "UPDATE campo SET ActCam=1 WHERE IdCam='".$idCam."'";

if ($conexion->query($sql) === TRUE) 
{
    echo "Record updated successfully";
} 
else 
{
    echo "Error updating record: " . $conexion->error;
}

//Seleccionamos el Id del cultivo
$idCul = "";
$sql = "SELECT cultivo.IdCul FROM cultivo, campo WHERE campo.IdCul=cultivo.IdCul 
	AND IdCam='".$idCam."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $idCul = $row ["IdCul"];
    }
} 
else
{
    echo "0 results";
}

//Actualizamos el cultivo a 1=activo
$sql = "UPDATE cultivo SET EstCul='1' WHERE IdCul='".$idCul."'";

if ($conexion->query($sql) === TRUE) 
{
    echo "Record updated successfully";
} 
else 
{
    echo "Error updating record: " . $conexion->error;
}

$conexion->close();
?>