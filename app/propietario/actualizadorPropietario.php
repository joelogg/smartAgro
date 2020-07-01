<?php
include ("../../partes/conexion.php");

$respuesta = "";
$sql = "SELECT CambPro, EstPro, CenPro FROM propiterio LIMIT 1";


$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
		//$cambPro=$row["CambPro"];
		$estPro=$row["EstPro"];
		$cenPro=$row["CenPro"];
		
		/*$sql2 = "UPDATE propiterio SET CambPro=0";
		if ($conexion->query($sql2) === TRUE) 
		{*/
			$respuesta = $estPro.$cenPro;     
		/*}*/
    }
} 

echo $respuesta;				    			

$conexion->close();

?>
