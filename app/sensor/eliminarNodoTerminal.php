<?php
include ("../../partes/conexion.php");
$idNodTer = $_GET['idNodTer'];

$sql = "DELETE FROM nodoterminal WHERE IdNodTer='".$idNodTer."'";
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