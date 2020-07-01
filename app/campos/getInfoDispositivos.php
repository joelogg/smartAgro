<?php
$anchoSVG = $_GET['anchoV'];
$altoSVG = $_GET['altoV'];

	include ("../../partes/conexion.php");
			$sql = "SELECT * FROM campo";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) 
			{
			    while($row = $result->fetch_assoc()) 
			    {			    	
			        $idCam = $row["IdCam"];
			        $nomCam = $row["NomCam"];
			        $posGraCam = $row["PosGraCam"];
			        $posXTexCam = $row["PosXTexCam"];
			        $posYTexCam = $row["PosYTexCam"];
			        $posYTexCam = $posYTexCam + 1;

			        if($posGraCam=="")
			        {
			        }
			        else
			        {
				        $posGraCam2 = "";

				     				        				        
				        $posXTexCam = $posXTexCam*$anchoSVG/100;
				        $posYTexCam = $posYTexCam*$altoSVG/100;
			

				        $sql2 = "SELECT IdNodTer, PosXNodTer, PosYNodTer FROM nodoterminal WHERE IdCamNodTer='".$idCam."'";
						$result2 = $conexion->query($sql2);
						if ($result2->num_rows > 0) 
						{
							while($row2 = $result2->fetch_assoc()) 
			    			{
			    				$idNodTer = $row2["IdNodTer"];
			    				$posXNodTer = $row2["PosXNodTer"];
			    				$posYNodTer = $row2["PosYNodTer"];

			    				if($posXNodTer==0 || $posYNodTer==0)
			    				{
			    					echo '<div class="rectSensor rectSensorInf sensoresCampo'.$idCam.'" 
			    					id="sensorCam'.$idNodTer.'" 
			    					onmouseout="outSensor('.$idCam.')" 
			    					onmouseover="overSensor('.$idCam.')" 	    				 
				    				style="left: '.($posXTexCam+16).'px; top:'.($posYTexCam-25).'px;">';
			    				}
			    				else
			    				{
			    					$posXNodTerAux = $posXNodTer*$anchoSVG/100;
				       				$posYNodTerAux = $posYNodTer*$altoSVG/100;
				    				echo '<div class="rectSensor rectSensorInf sensoresCampo'.$idCam.'" 
			    					id="sensorCam'.$idNodTer.'"
				    				onmouseover="overSensor('.$idCam.')" 
				    				onmouseout="outSensor('.$idCam.')"  
				    				style="left: '.($posXNodTerAux).'px; top:'.($posYNodTerAux).'px;">';
				    			}
				    			
								echo '<table class="tablaInformativa">';
								

								$sql3 = "SELECT IdNodRutNodTer, IdCamNodTer, NomCam, DirLogNodTer, BatNodTer, 
								    TemNodTer, EstNodTer, CanSenNodTer, HumNodTer1, HumNodTer2, HumNodTer3, HumNodTer4
								    FROM nodoterminal, campo  WHERE IdCam=IdCamNodTer AND IdNodTer='".$idNodTer."'";
								$result3 = $conexion->query($sql3);

								if ($result3->num_rows > 0) 
								{
									while($row3 = $result3->fetch_assoc()) 
									{
								        $idNodRutNodTer=$row3["IdNodRutNodTer"];
								        $idCamNodTer=$row3["IdCamNodTer"];
								        $nomCam=$row3["NomCam"];
								        $dirFisNodTer=$row3["DirLogNodTer"];

								        $batNodTer=$row3["BatNodTer"];
								        $temNodTer=$row3["TemNodTer"];


								        $estNodTer=$row3["EstNodTer"];
								        $canSenNodTer=$row3["CanSenNodTer"]; 								        

								        echo '<tr>';
								        echo '<th colspan="2">Sensor</th>';
								        echo '</tr>';

								        echo '<tr>';
								        echo '<td>Campo:</td><td>'.$nomCam.'</td>';
								        echo '</tr>';

								        echo '<tr>';
								        echo '<td>Dirección Física:</td><td>'.$dirFisNodTer.'</td>';
								        echo '</tr>';

								        echo '<tr>';
								        echo '<td>Batería:</td><td>'.$batNodTer.'</td>';
								        echo '</tr>';

								        echo '<tr>';
								        echo '<td>Temperatura:</td><td>'.$temNodTer.'</td>';
								        echo '</tr>';

								        echo '<tr>';
								        echo '<td>Ruteador:</td><td>'.$idNodRutNodTer.'</td>';
								        echo '</tr>';

								        for ($i=0; $i < $canSenNodTer; $i++) 
								        { 
								            $humNodTer=$row3["HumNodTer".($i+1)];

								            echo '<tr>';
								            echo '<td>Humedad punto '.($i+1).':</td><td>'.$humNodTer.'</td>';
								            echo '</tr>';
								        }								        
								    }
								} 
								echo '</table>';

			    				echo '</div>';
						    }
						} 

						
						$sql3 = "SELECT IdVal, PosXVal, PosYVal FROM valvula WHERE IdCamVal='".$idCam."' ";
						$result3 = $conexion->query($sql3);
						if ($result3->num_rows > 0) 
						{
							while($row3 = $result3->fetch_assoc()) 
			    			{
			    				$idVal = $row3["IdVal"];
			    				$posXVal = $row3["PosXVal"];
			    				$posYVal = $row3["PosYVal"];
			    				
			    				if($posXVal==0 || $posYVal==0)
			    				{
							    	echo '<div class="rectValvula rectValvulaInf valvulasCampo'.$idCam.'" 
							    	id="valvulaCam'.$idVal.'"
				    				onmouseover="overValvula('.$idCam.')" 
				    				onmouseout="outValvula('.$idCam.')" 		    				  
				    				style="left: '.($posXTexCam+15).'px; top:'.($posYTexCam-5).'px;">';
				    			}
				    			else
				    			{
				    				$posXValAux = $posXVal*$anchoSVG/100;
				       				$posYValAux = $posYVal*$altoSVG/100;
							    	echo '<div class="rectValvula rectValvulaInf valvulasCampo'.$idCam.'" 
							    	id="valvulaCam'.$idVal.'"
				    				onmouseover="overValvula('.$idCam.')" 
				    				onmouseout="outValvula('.$idCam.')" 
				    				style="left: '.($posXValAux+10).'px; top:'.($posYValAux+10).'px;">';

				    			}

			    				$sql2 = "SELECT IdNodRutVal, IdCamVal, NomCam, NomVal, EstVal, AccVal FROM valvula, campo 
								WHERE IdCam=IdCamVal AND IdVal='".$idVal."'";
								$result2 = $conexion->query($sql2);

								if ($result2->num_rows > 0) 
								{
								    while($row2 = $result2->fetch_assoc()) 
								    {
								        $idNodRutVal=$row2["IdNodRutVal"];
								        $idCamVal=$row2["IdCamVal"];
								        $nomCam=$row2["NomCam"];
								        $nomVal=$row2["NomVal"];						        
								        $estVal=$row2["EstVal"];
								        $accVal=$row2["AccVal"];
								    }
								}

								echo '<table class="tablaInformativa">';
								        
								        if($estVal==1)
								        { 
								            $estadoLetras="Abierta";
								        }
								        else
								        {   
								            $estadoLetras="Cerrada";
								        }

								        if($accVal==1)
								        { 
								            $accLetras="Abrir";
								        }
								        else
								        {   
								            $accLetras="Cerrar";
								        }

								        echo '<tr>';
								        echo '<th colspan="2" style="background: yellow;">Valvula</th>';
								        echo '</tr>';

								        echo '<tr>';
								        echo '<td>Campo:</td><td>'.$nomCam.'</td>';
								        echo '</tr>';

								        echo '<tr>';
								        echo '<td>Valvula:</td><td>'.$nomVal.'</td>';
								        echo '</tr>';

								        echo '<tr>';
								        echo '<td>Ruteador:</td><td>'.$idNodRutVal.'</td>';
								        echo '</tr>';	

								        echo '<tr>';
								        echo '<td>Estado Actual:</td><td id=estActu'.$idVal.'>'.$estadoLetras.'</td>';
								        echo '</tr>';								        

								        echo '<tr>';
								        echo '<td>Acción</td>';
								        echo '<td>';
								            echo '<label class="switch switch-green" >';
								                if($accVal==1)
								                { 
								                    echo '<input type="checkbox" onclick="accionarSwitchValvulaMapa('.$idVal.')" id="switchValvula'.$idVal.'" class="switch-input" checked>';
								                }
								                else
								                {   
								                    echo '<input type="checkbox" onclick="accionarSwitchValvulaMapa('.$idVal.')" id="switchValvula'.$idVal.'" class="switch-input">';
								                }
								                echo '<span class="switch-label" data-on="Cerrar" data-off="Abrir"></span>';
								                echo '<span class="switch-handle"></span>';
								            echo '</label>';
								        echo '</td>';        
								        echo '</tr>';
								echo '</table>';

			    				echo '</div>';
			    			}
						}			        
			    	}
			    }
			};	


?>