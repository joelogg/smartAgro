<?php
include ("../../partes/conexion.php");

$sql = "SELECT IdVal FROM valvula WHERE CambVal=1";
$result = $conexion->query($sql);

$respuesta = "";
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $idVal=$row["IdVal"];
        $respuesta = $respuesta.$idVal.",";
    }
    $respuesta = substr($respuesta, 0, -1);
}

echo $respuesta;
$conexion->close();
?>