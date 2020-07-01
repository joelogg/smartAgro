<?php
include ("../../partes/conexion.php");
$nomNC = $_GET['nomNC'];
$dirFisNC = $_GET['dirFisNC'];

$cantidadCoordinadores=0;
$sql = "SELECT COUNT(*) AS CantidadCoordinadores FROM nodocoordinador";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $cantidadCoordinadores=$row["CantidadCoordinadores"];
    }
} 

if($cantidadCoordinadores==0)
{
	$sql = "INSERT INTO nodocoordinador(NomNodCoo, DirFisNodCoo) VALUES ('".$nomNC."',CONV('".$dirFisNC."', 16, 10))";

	if ($conexion->query($sql) === TRUE) 
	{
	    echo "Correcto";
	} 
	else 
	{
	    echo "Error";
	}
}
else
{
	echo "Solo es posible tener un Nodo Coordinador";
}


$conexion->close();
?>