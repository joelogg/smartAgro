<br>
<nav id="menuSecundario">
<!--------------Primer desplegable------------>
	<p class="parrafoC" style="margin-top:16px;">
		<span onclick="clicFlechaC()" id="icoEstadoC"></span>
		<span onclick="getCampos()" class="icoCampos"></span>
		<span onclick="getCampos()" class="textoSM">Campos</span>
	</p>
	<div id="divCs">
<?php
		$sql = "SELECT IdCam, campo.IdCul, NomCam, NomCul FROM campo, cultivo WHERE 
			campo.IdCul = cultivo.IdCul ORDER BY NomCul ASC";
		$result = $conexion->query($sql);
		if ($result->num_rows > 0) 
		{
		    while($row = $result->fetch_assoc()) 
		    {
		    	$idCam = $row["IdCam"];
		    	$IdCul = $row["IdCul"];
		        $nomCam = $row["NomCam"];
		        $nomCul = $row["NomCul"];
		        echo '<p class="parrafoCs">
		        	<span onclick="clicFlechaCs('.$idCam.')" 
		        		id="icoEstadoCs'.$idCam.'" class="icoEstadoCs"></span>
		        	<span  onclick="mostrarUnCampo('.$idCam.')" class="icoCampo"></span>
		        	<span onclick="mostrarUnCampo('.$idCam.')" class="textoSM">'.$nomCul.' - '.$nomCam.'</span>
		        </p>';
				echo '<div id="divV'.$idCam.'">';

					$sql2 = "SELECT valvula.IdVal, NomVal FROM valvula, campovalvula WHERE valvula.IdVal=campovalvula.IdVal AND IdCam= '".$idCam."' ";
					$result2 = $conexion->query($sql2);
					if ($result2->num_rows > 0) 
					{
					    while($row2 = $result2->fetch_assoc()) 
					    {
					    	$idVal = $row2["IdVal"];
					    	$NomVal = $row2["NomVal"];
					    	echo '<p class="parrafoV">
					    		<span class="icoEstadoV"></span>
					    		<span onclick="mostrarUnaValvula('.$idVal.')" class="icoValvula"></span>
					    		<span onclick="mostrarUnaValvula('.$idVal.')" class="textoSM">'.$NomVal.'</span>
					    	</p>';
					    }
					}

					$sql3 = "SELECT dispositivos.IdDis, NomDis FROM camponodoterminal, nodoterminal, dispositivos WHERE camponodoterminal.IdNodTer=nodoterminal.IdNodTer AND nodoterminal.IdDis=dispositivos.IdDis AND IdCam='".$idCam."'";
					$result3 = $conexion->query($sql3);
					if ($result3->num_rows > 0) 
					{
					    while($row3 = $result3->fetch_assoc()) 
					    {
					    	$idDis = $row3["IdDis"];
					    	$nomDis = $row3["NomDis"];

					    	echo '<p class="parrafoS">
					    		<span class="icoEstadoS"></span>
					    		<span onclick="mostrarUnNodoTerminal('.$idDis.')" class="icoSensor"></span>
					    		<span onclick="mostrarUnNodoTerminal('.$idDis.')" class="textoSM">'.$nomDis.'</span>
					    	</p>';
					    	
					    }
					}					
				echo '</div>';
		    }
		} 				
?>
	</div>	


<!--------------Segundo desplegable------------>


	<p class="parrafoOD" style="margin-top:16px;">
		<span onclick="clicFlechaOD()" id="icoEstadoOD"></span>
		<span onclick="getODispositivos()" class="icoODispositivos"></span>
		<span onclick="getODispositivos()" class="textoSM">Dispositivos</span>
	</p>
	<div id="divOD">

		<!--Agregacion-->
		<p class="parrafoAg" style="margin-top:16px;">
		<span id="icoEstadoAg"></span>
		<span onclick="getAgregaciones()" class="icoAgregaciones"></span>
		<span onclick="getAgregaciones()" class="textoSM">Agregaciones</span>
		</p>

		<p class="parrafoNCs" style="margin-top:16px;">
		<span onclick="clicFlechaNCs()" id="icoEstadoNCs"></span>
		<span onclick="getCoordinadores()" class="icoCoordinadores"></span>
		<span onclick="getCoordinadores()" class="textoSM">Coordinador</span>
		</p>

		<div id="divNC">
<?php
		
					$sql2 = "SELECT IdDis, NomDis FROM dispositivos WHERE TipDis=1 
						ORDER BY NomDis ASC";
					$result2 = $conexion->query($sql2);
					if ($result2->num_rows > 0) 
					{
					    while($row2 = $result2->fetch_assoc()) 
					    {
					    	$idDis = $row2["IdDis"];
					    	$nomDis = $row2["NomDis"];
					    	echo '<p class="parrafoNC">
					    		<span class="icoEstadoNC"></span>
					    		<span onclick="mostrarUnNodoCoordinador('.$idDis.')" class="icoNCoordinador"></span>
					    		<span onclick="mostrarUnNodoCoordinador('.$idDis.')" class="textoSM">'.$nomDis.'</span>
					    	</p>';
					    }
					}

?>
		</div>			

		<p class="parrafoNRs" style="margin-top:16px;">
		<span onclick="clicFlechaNRs()" id="icoEstadoNRs"></span>
		<span onclick="getRuteadores()" class="icoRuteadores"></span>
		<span onclick="getRuteadores()" class="textoSM">Ruteadores</span>
		</p>

		<div id="divNR">
<?php

					$sql3 = "SELECT IdDis, NomDis FROM dispositivos WHERE TipDis=20 
						ORDER BY NomDis ASC";
					$result3 = $conexion->query($sql3);
					if ($result3->num_rows > 0) 
					{
					    while($row3 = $result3->fetch_assoc()) 
					    {
					    	$idDis = $row3["IdDis"];
					    	$nomDis = $row3["NomDis"];

					    	echo '<p class="parrafoNR">
					    		<span class="icoEstadoNR"></span>
					    		<span onclick="mostrarUnNodoRuteador('.$idDis.')" class="icoNRuteador"></span>
					    		<span onclick="mostrarUnNodoRuteador('.$idDis.')" class="textoSM">'.$idDis.'-'.$nomDis.'</span>
					    	</p>';
					    	
					    }
					}					
		echo '</div>';				
?>

		<p class="parrafoNTs" style="margin-top:16px;">
		<span onclick="clicFlechaNTs()" id="icoEstadoNTs"></span>
		<span onclick="getTerminales()" class="icoTerminales"></span>
		<span onclick="getTerminales()" class="textoSM">Terminales</span>
		</p>

		<div id="divNT">
<?php

					$sql3 = "SELECT IdDis, NomDis FROM dispositivos WHERE TipDis=10 
						ORDER BY NomDis ASC";
					$result3 = $conexion->query($sql3);
					if ($result3->num_rows > 0) 
					{
					    while($row3 = $result3->fetch_assoc()) 
					    {
					    	$idDis = $row3["IdDis"];
					    	$nomDis = $row3["NomDis"];

					    	echo '<p class="parrafoNT">
					    		<span class="icoEstadoNT"></span>
					    		<span onclick="mostrarUnNodoTerminal('.$idDis.')" class="icoNTerminal"></span>
					    		<span onclick="mostrarUnNodoTerminal('.$idDis.')" class="textoSM">'.$idDis.'-'.$nomDis.'</span>
					    	</p>';
					    	
					    }
					}					
		echo '</div>';				
?>

	</div>	
	

<!--------------Tercer desplegable------------>

	<p class="parrafoCultivos" style="margin-top:16px;">
		<span onclick="clicFlechaCultivos()" id="icoEstadoCultivos"></span>
		<span onclick="getCultivos()" class="icoCultivos"></span>
		<span onclick="getCultivos()" class="textoSM">Productos Cultivables</span>
	</p>

	<div id="divCultivos">
<?php
		$sql2 = "SELECT IdCul, NomCul FROM cultivo WHERE NomCul!='Sin Cultivo' ORDER BY NomCul ASC";
		$result2 = $conexion->query($sql2);
		if ($result2->num_rows > 0) 
		{
		    while($row2 = $result2->fetch_assoc()) 
		    {
		    	$idCul = $row2["IdCul"];
		    	$nomCul = $row2["NomCul"];
		    	echo '<p class="parrafoCultivo">
			    		<span class="icoEstadoCultivo"></span>
			    		<span onclick="mostrarUnCultivo('.$idCul.')" class="icoCultivo"></span>
			    		<span onclick="mostrarUnCultivo('.$idCul.')" class="textoSM">'.$nomCul.'</span>
			    	</p>';
			}
		}

?>	
	</div>	

	<!--------------Cuarto desplegable------------>

	<p class="parrafoNutrientes" style="margin-top:16px;">
		<span onclick="clicFlechaNutrientes()" id="icoEstadoNutrientes"></span>
		<span onclick="getNutrientes()" class="icoNutrientes"></span>
		<span onclick="getNutrientes()" class="textoSM">Nutrientes</span>
	</p>

	<div id="divNutrientes">
<?php
		$sql2 = "SELECT IdNut, DesNut FROM nutrientes ORDER BY DesNut ASC";
		$result2 = $conexion->query($sql2);
		if ($result2->num_rows > 0) 
		{
		    while($row2 = $result2->fetch_assoc()) 
		    {
		    	$idNut = $row2["IdNut"];
		    	$desNut = $row2["DesNut"];
		    	echo '<p class="parrafoNutriente">
			    		<span class="icoEstadoNutriente"></span>
			    		<span onclick="mostrarUnNutriente('.$idNut.')" class="icoNutriente"></span>
			    		<span onclick="mostrarUnNutriente('.$idNut.')" class="textoSM">'.$desNut.'</span>
			    	</p>';
			}
		}

?>	
	</div>	

</nav>