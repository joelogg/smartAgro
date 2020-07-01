<?php
include ("../../partes/conexion.php");
$idNodCoo = $_GET['idNodCoo'];

$sql = "DELETE FROM nodocoordinador WHERE IdNodCoo='".$idNodCoo."'";
if ($conexion->query($sql) === TRUE) 
{
    echo "Correcto";
} 
else 
{
    echo "Error";
}




$conexion->close();
?>