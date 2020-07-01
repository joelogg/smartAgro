<?php
include ("../../partes/conexion.php");
$idTarVal = $_GET['idTarVal'];

$sql = "DELETE FROM tareavalvula WHERE IdTarVal='".$idTarVal."'";
if ($conexion->query($sql) === TRUE) 
{
    echo "Record deleted successfully";
} 
else 
{
    echo "Error deleting record: " . $conexion->error;
}




$conexion->close();
?>