<?php
include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];

//Se elimina (deshilita) el campo
$sql = "UPDATE campo SET ActCam=0 WHERE IdCam='".$idCam."'";

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


//Se consulta si no hay mas campos con ese cultivo activo
$sql = "SELECT cultivo.IdCul FROM cultivo, campo WHERE campo.IdCul=cultivo.IdCul AND EstCul=1 
	AND ActCam=1 AND cultivo.IdCul='".$idCul."' AND IdCam!='".$idCam."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{    echo "Hay mas";
} 
else
{
    //Se actualiza el estado del cultivo
	$sql2 = "UPDATE cultivo SET EstCul=0 WHERE IdCul='".$idCul."'";

	if ($conexion->query($sql2) === TRUE) 
	{
	    echo "Record updated successfully";
	} 
	else 
	{
	    echo "Error updating record: " . $conexion->error;
	}echo "cero";
}


$conexion->close();
?>