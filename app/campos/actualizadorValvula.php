<?php
include ("../../partes/conexion.php");

$respuesta = "";
$sql = "SELECT IdVal, EstVal, AccVal, EstConec FROM valvula, nodoruteador, dispositivos WHERE valvula.IdNodRut=nodoruteador.IdNodRut AND nodoruteador.IdDis=dispositivos.IdDis AND (CambVal=1 OR CambVal=2)";


$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
		$idVal=$row["IdVal"];
        $estVal=$row["EstVal"];
        $accVal=$row["AccVal"];
        $estConec=$row["EstConec"];

		
		/*$sql2 = "UPDATE valvula SET CambVal=0 WHERE IdVal='".$idVal."'";
		if ($conexion->query($sql2) === TRUE) */
		{
			$respuesta = $respuesta.$estConec.$estVal.$accVal.$idVal.":";     
		}
    }
} 

echo $respuesta;				    			

$conexion->close();

?>
