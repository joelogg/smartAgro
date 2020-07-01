<?php
include ("../../partes/conexion.php");

$sql = "SELECT IdVal, EstVal FROM valvula WHERE CambVal=2";

$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{ 
	while($row = $result->fetch_assoc()) 
	{
		$idVal=$row["IdVal"];
		$estVal=$row["EstVal"];
        
        $sql2 = "SELECT IdHisVal, TieFinHisVal, FecFinHisVal FROM historialvalvula WHERE IdVal='".$idVal."' ORDER BY IdHisVal DESC LIMIT 1";
		$result2 = $conexion->query($sql2);
		if ($result2->num_rows > 0) 
		{
			while($row2= $result2->fetch_assoc()) 
			{
				$idHisVal=$row2["IdHisVal"];
				$fecFinHisVal=$row2["FecFinHisVal"];
				$tieFinHisVal=$row2["TieFinHisVal"];

				$fechaActual = date("Y")."-".date("m")."-".date("d");//aaaa-mm-dd
    			$horaActual = (date("H")).":".date("i").":".date("s");//hh-mm-ss

    			$sql3 = "UPDATE valvula SET CambVal=1 WHERE IdVal='".$idVal."'";
				if ($conexion->query($sql3) === TRUE) 
				{					    
				}

				if($estVal==0 && ($fecFinHisVal==NULL || $tieFinHisVal==NULL))//ya exsite, agregar finales
				{					 
					echo "Actualizando";
					$sql3 = "UPDATE historialvalvula SET TieFinHisVal='".$horaActual."', FecFinHisVal='".$fechaActual."' WHERE IdHisVal='".$idHisVal."'";
					if ($conexion->query($sql3) === TRUE) 
					{					    
					}
				}
				elseif($estVal==1)//no exite, crear nuevo
				{
					echo "Nuevo";

					$sql3 = "INSERT INTO historialvalvula(IdVal, FecIniHisVal, TieIniHisVal) VALUES ('".$idVal."', '".$fechaActual."', '".$horaActual."')";
					if ($conexion->query($sql3) === TRUE) 
					{					
					}
				}
		        
		    }
		}
    }
} 
			    			

$conexion->close();

?>
