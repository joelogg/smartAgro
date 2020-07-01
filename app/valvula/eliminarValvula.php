<?php
include ("../../partes/conexion.php");
$idVal = $_GET['idVal'];

$sql = "DELETE FROM valvula WHERE IdVal='".$idVal."'";
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