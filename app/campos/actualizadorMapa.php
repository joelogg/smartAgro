<?php
include ("../../partes/conexion.php");
//polygonCampoVacio
//polygonCampoAlerta
//polygonCampoNormal

$respuesta = "";
$sql = "SELECT IdCam, NomCam, PosGraCam, PosXTexCam, PosYTexCam, HumCam, HumMinCul, HumMaxCul, ActCam, NomCul FROM campo, cultivo WHERE CambCam=1 AND campo.IdCul = cultivo.IdCul";

/*$sql = "SELECT COUNT(*) AS Contar FROM campo, cultivo WHERE ActCam=1 AND campo.IdCul = cultivo.IdCul";
$contar = $row["Contar"];
		echo $contar; */
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $idCam = $row["IdCam"];

		$humCam = $row["HumCam"];
		$humMinCul = $row["HumMinCul"];
		$humMaxCul = $row["HumMaxCul"];

		$actCam = $row["ActCam"];
		

		if($actCam==0)
		{
			//polygonCampoVacio
			$sql2 = "UPDATE campo SET CambCam=0 WHERE IdCam='".$idCam."'";
			if ($conexion->query($sql2) === TRUE) 
			{
			    $respuesta = $respuesta. "1".$idCam.":";
			} 
		}
		elseif($humCam<$humMinCul || $humCam>$humMaxCul)
		{
			//polygonCampoAlerta
			$sql2 = "UPDATE campo SET CambCam=0 WHERE IdCam='".$idCam."'";
			if ($conexion->query($sql2) === TRUE) 
			{
				$respuesta = $respuesta. "2".$idCam.":";
			}
		}
		else
		{
			//polygonCampoNormal
			/*$sql2 = "UPDATE campo SET CambCam=0 WHERE IdCam='".$idCam."'";
			if ($conexion->query($sql2) === TRUE) */
			{
				$respuesta = $respuesta. "3".$idCam.":";
			}
		}	      
    }
} 

echo $respuesta;

			


//------------------------------iconos de la valvula---------------------------------------	
			//rectValvulaAbierta
			//rectValvulaCerrada 
				    			

$conexion->close();

?>
