<?php
include ("../../partes/conexion.php");

$sql = "SELECT IdNodTer FROM nodoterminal WHERE CambNodTer=1";
$result = $conexion->query($sql);

$respuesta = "";
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $idNodVal=$row["IdNodTer"];
        $respuesta = $respuesta.$idNodVal.",";
    }
    $respuesta = substr($respuesta, 0, -1);
}

echo $respuesta;
$conexion->close();
?>