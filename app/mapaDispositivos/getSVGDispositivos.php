<?php
$anchoSVG = $_GET['anchoV'];
$altoSVG = $_GET['altoV'];
$editableGD = $_GET['editableGD'];

include ("../../partes/conexion.php");

//----solo lineas y LQIs
$sql = "SELECT IdDis, IdSupDis, PosXDis, PosYDis, LQIDirDis, LQIInvDis FROM dispositivos";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
		$idDis = $row["IdDis"];
		$idSupDis = $row["IdSupDis"];
		$posXDis = $row["PosXDis"];
		$posYDis = $row["PosYDis"];
		$lQIDirDis = $row["LQIDirDis"];
		$lQIInvDis = $row["LQIInvDis"];

		if($posXDis==0 || $posYDis==0) //si estan sin ubicacion
		{			
		}
		else //cuando estan en ubicacion
		{
			$posXNodTerAux = $posXDis*$anchoSVG/100;
			$posYNodTerAux = $posYDis*$altoSVG/100;

			//----Dibujando las lineas(conexion)----
			if($idSupDis != $idDis && $editableGD=="false")
			{
				$sql2 = "SELECT PosXDis, PosYDis FROM dispositivos WHERE IdDis='".$idSupDis."'";
				$result2 = $conexion->query($sql2);

				if ($result2->num_rows > 0) 
				{
					while($row2 = $result2->fetch_assoc()) 
					{
						$posXDisSup = $row2["PosXDis"];//
						$posYDisSup = $row2["PosYDis"];//
						$posXNodTerAuxSup = $posXDisSup*$anchoSVG/100;
						$posYNodTerAuxSup = $posYDisSup*$altoSVG/100;

						$difX = $posXNodTerAuxSup - $posXNodTerAux;	
						$difY = $posYNodTerAuxSup - $posYNodTerAux;

						echo '<line x1="'.($posXNodTerAux).'" y1="'.($posYNodTerAux).'" 
									x2="'.($posXNodTerAuxSup).'" y2="'.($posYNodTerAuxSup).'" 
						style="stroke:rgb(0,20,255);stroke-width:2" />';
					}
				}				
			}

			//-----dibujando lqi-----
			if($idSupDis != $idDis && $editableGD=="false")
			{	
				$radio = 12;

				$h2 = sqrt( pow($difX, 2) + pow($difY, 2) );

				$a1 = abs($difY) * $radio / $h2;
				$b1 = sqrt( pow($radio, 2) - pow($a1, 2) );



				//dibujando pesos del LQI (Texto)
				if($difY>0 && $difX>0) //linea parte izquierda superior
				{
					echo '<text x="'.($posXNodTerAux+$a1+6).'" y="'.($posYNodTerAux+$b1+6).'" fill="red">'.$lQIDirDis.'</text>';
					echo '<text x="'.($posXNodTerAuxSup-$a1-6).'" y="'.($posYNodTerAuxSup-$b1-6).'" fill="red">'.$lQIInvDis.'</text>';
				}
				elseif($difY>0 && $difX<0) //linea parte derecha superior
				{
					echo '<text x="'.($posXNodTerAux-$a1-9).'" y="'.($posYNodTerAux+$b1+9).'" fill="red">'.$lQIDirDis.'</text>';
					echo '<text x="'.($posXNodTerAuxSup+$a1+6).'" y="'.($posYNodTerAuxSup-$b1-6).'" fill="red">'.$lQIInvDis.'</text>';
				}
				elseif($difY<0 && $difX<0) //linea parte derecha inferior
				{
					echo '<text x="'.($posXNodTerAux-$a1-9).'" y="'.($posYNodTerAux-$b1).'" fill="red">'.$lQIDirDis.'</text>';
					echo '<text x="'.($posXNodTerAuxSup+$a1+6).'" y="'.($posYNodTerAuxSup+$b1+6).'" fill="red">'.$lQIInvDis.'</text>';
				}
				elseif($difY<0 && $difX>0) //linea parte izquierda inferior
				{
					echo '<text x="'.($posXNodTerAux+$a1+6).'" y="'.($posYNodTerAux-$b1-6).'" fill="red">'.$lQIDirDis.'</text>';
					echo '<text x="'.($posXNodTerAuxSup-$a1-12).'" y="'.($posYNodTerAuxSup+$b1+12).'" fill="red">'.$lQIInvDis.'</text>';
				}	
			}		
		}							
		
    }
} 

// ---------------Iconos del nodo terminal------------------			
$sql = "SELECT IdDis, NomDis, IdSupDis, DirFisDis, DirFisCorDis, PosXDis, PosYDis, CambDis, TipDis, ProDis, LQIDirDis, LQIInvDis, PeriodoDis, EstAgr, EstChec, EstConec, TxDis FROM dispositivos ORDER BY TipDis DESC";
$result = $conexion->query($sql);

$altoSeparacion=80;
$iNR=$altoSeparacion;
$iNT=$altoSeparacion;
if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
		$idDis = $row["IdDis"];//
		//$nomDis = $row["NomDis"];
		//$idSupDis = $row["IdSupDis"];
		//$dirFisDis = $row["DirFisDis"];
		//$dirFisCorDis = $row["DirFisCorDis"];
		$posXDis = $row["PosXDis"];//
		$posYDis = $row["PosYDis"];//
		//$cambDis = $row["CambDis"];
		$tipDis = $row["TipDis"];//
		//$proDis = $row["ProDis"];
		//$lQIDirDis = $row["LQIDirDis"];
		//$lQIInvDis = $row["LQIInvDis"];
		//$periodoDis = $row["PeriodoDis"];
		//$estAgr = $row["EstAgr"];
		//$estChec = $row["EstChec"];
		//$estConec = $row["EstConec"];
		//$txDis = $row["TxDis"];

		if($posXDis==0 || $posYDis==0) //si estan sin ubicacion
		{

			if($tipDis==1)//coordinador
			{
				echo '<circle id="dispositivo'.$idDis.'" class="dispositivoNC" 
				onmousedown="mouseDownDispositivo('.$idDis.')" 
				onmouseup="mouseUpDis()" 
				onclick="clickNCMapa('.$idDis.')" 
				cx="'.($posXDis+20).'" cy="'.($posYDis+$altoSeparacion).'" r="12" />';
			}
			elseif($tipDis==20)//ruteador
			{
				echo '<circle id="dispositivo'.$idDis.'" class="dispositivoNR" 
				onmousedown="mouseDownDispositivo('.$idDis.')" 
				onmouseup="mouseUpDis()"
				onclick="clickNRMapa('.$idDis.')" 
				cx="'.($posXDis+50).'" cy="'.($posYDis+$iNR).'" r="12" />';

				$iNR=$iNR+10;
			}
			elseif($tipDis==10)//terminal
			{
				echo '<circle id="dispositivo'.$idDis.'" class="dispositivoNT" 
				onmousedown="mouseDownDispositivo('.$idDis.')" 
				onmouseup="mouseUpDis()"
				onclick="clickNTMapa('.$idDis.')" 
				cx="'.($posXDis+80).'" cy="'.($posYDis+$iNT).'" r="12" />';
				$iNT=$iNT+10;
			}

			
		}
		else //cuando estan en ubicacion
		{
			$posXNodTerAux = $posXDis*$anchoSVG/100;
			$posYNodTerAux = $posYDis*$altoSVG/100;			

			if($tipDis==1)//coordinador
			{
				echo '<circle id="dispositivo'.$idDis.'" class="dispositivoNC" 
				onmousedown="mouseDownDispositivo('.$idDis.', '.$tipDis.')"  
				onmouseup="mouseUpDis()"
				onclick="clickNCMapa('.$idDis.')" 
				cx="'.($posXNodTerAux).'" cy="'.($posYNodTerAux).'" r="12" />';

				//if($editableGD=="false")
				{
					$radio = 8;
					
					echo '<line class="lineasN'.$idDis.'" 
						onmousedown="mouseDownDispositivo('.$idDis.', '.$tipDis.')"  
						onmouseup="mouseUpDis()"
						onclick="clickNCMapa('.$idDis.')" 
						x1="'.($posXNodTerAux-$radio).'" y1="'.($posYNodTerAux-$radio).'" x2="'.($posXNodTerAux+$radio).'" y2="'.($posYNodTerAux+$radio).'" style="stroke:rgb(0,0,0);stroke-width:1" />';

					echo '<line class="lineasN'.$idDis.'" 
						onmousedown="mouseDownDispositivo('.$idDis.', '.$tipDis.')"  
						onmouseup="mouseUpDis()"
						onclick="clickNCMapa('.$idDis.')" 
						x1="'.($posXNodTerAux+$radio).'" y1="'.($posYNodTerAux-$radio).'" x2="'.($posXNodTerAux-$radio).'" y2="'.($posYNodTerAux+$radio).'" style="stroke:rgb(0,0,0);stroke-width:1" />';

					echo '<line class="lineasN'.$idDis.'" 
						onmousedown="mouseDownDispositivo('.$idDis.', '.$tipDis.')"  
						onmouseup="mouseUpDis()"
						onclick="clickNCMapa('.$idDis.')" 
						x1="'.($posXNodTerAux).'" y1="'.($posYNodTerAux-$radio-3).'" x2="'.($posXNodTerAux).'" y2="'.($posYNodTerAux+$radio+3).'" style="stroke:rgb(0,0,0);stroke-width:1" />';

					echo '<line class="lineasN'.$idDis.'" 
						onmousedown="mouseDownDispositivo('.$idDis.', '.$tipDis.')"  
						onmouseup="mouseUpDis()"
						onclick="clickNCMapa('.$idDis.')" 
						x1="'.($posXNodTerAux-$radio-3).'" y1="'.($posYNodTerAux).'" x2="'.($posXNodTerAux+$radio+3).'" y2="'.($posYNodTerAux).'" style="stroke:rgb(0,0,0);stroke-width:1" />';
  				}
			}
			elseif($tipDis==20)//ruteador
			{
				echo '<circle id="dispositivo'.$idDis.'" class="dispositivoNR" 
				onmousedown="mouseDownDispositivo('.$idDis.', '.$tipDis.')"  
				onmouseup="mouseUpDis()"
				onclick="clickNRMapa('.$idDis.')" 
				cx="'.($posXNodTerAux).'" cy="'.($posYNodTerAux).'" r="12" />';

				//if($editableGD=="false")
				{
					$radio = 8;
					echo '<line class="lineasN'.$idDis.'" 
						onmousedown="mouseDownDispositivo('.$idDis.', '.$tipDis.')"  
						onmouseup="mouseUpDis()"
						onclick="clickNRMapa('.$idDis.')" 
						x1="'.($posXNodTerAux-$radio).'" y1="'.($posYNodTerAux-$radio).'" x2="'.($posXNodTerAux+$radio).'" y2="'.($posYNodTerAux+$radio).'" style="stroke:rgb(0,0,0);stroke-width:1" />';

					echo '<line class="lineasN'.$idDis.'" 
						onmousedown="mouseDownDispositivo('.$idDis.', '.$tipDis.')"  
						onmouseup="mouseUpDis()"
						onclick="clickNRMapa('.$idDis.')" 
						x1="'.($posXNodTerAux+$radio).'" y1="'.($posYNodTerAux-$radio).'" x2="'.($posXNodTerAux-$radio).'" y2="'.($posYNodTerAux+$radio).'" style="stroke:rgb(0,0,0);stroke-width:1" />';
  				}
			}
			elseif($tipDis==10)//terminal
			{
				echo '<circle id="dispositivo'.$idDis.'" class="dispositivoNT" 
				onmousedown="mouseDownDispositivo('.$idDis.', '.$tipDis.')"  
				onmouseup="mouseUpDis()"
				onclick="clickNTMapa('.$idDis.')" 
				cx="'.($posXNodTerAux).'" cy="'.($posYNodTerAux).'" r="12" />';

				//if($editableGD=="false")
				{	//Punto del medio				
	  				echo '<circle class="lineasN'.$idDis.'" 
	  					onmousedown="mouseDownDispositivo('.$idDis.', '.$tipDis.')" onmouseup="mouseUpDis()" 
	  					onclick="clickNTMapa('.$idDis.')" 
	  					cx="'.($posXNodTerAux).'" cy="'.($posYNodTerAux).'" r="1" stroke="black" stroke-width="1" fill="black" />';
  				}
			}					
		}							
		
    }
} 



$conexion->close();

?>
