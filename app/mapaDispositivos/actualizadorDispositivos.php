<?php
include ("../../partes/conexion.php");

$respuesta = "";
$sql = "SELECT COUNT(*) AS cantReg FROM dispositivos WHERE CambDis=1";


$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{		
		$cantReg=$row["cantReg"];

		$sql2 = "UPDATE dispositivos SET CambDis=0";
		if ($conexion->query($sql2) === TRUE) 
		{
			if($cantReg>0)
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
    }
} 


echo $respuesta;				    			

$conexion->close();

?>
