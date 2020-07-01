<?php
include ("../../partes/conexion.php");

$respuesta = "";
$sql = "SELECT IdNodTer FROM nodoterminal WHERE CambNodTer=1";


$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
		$idNodTer=$row["IdNodTer"];
		
		/*$sql2 = "UPDATE nodoterminal SET CambNodTer=0 WHERE IdNodTer='".$idNodTer."'";
		if ($conexion->query($sql2) === TRUE) */
		{
			$respuesta = $respuesta.$idNodTer.":";     
		}
    }
} 

echo $respuesta;				    			

$conexion->close();

?>
