<?php
include ("../../partes/conexion.php");
$idNut = $_GET['idNut'];


echo $idNut;

$sql = "DELETE FROM nutrientes WHERE IdNut='".$idNut."'";
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