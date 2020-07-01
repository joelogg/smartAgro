<?php
	
	$idVal = $_GET['idVal'];
	include ("../../partes/conexion.php");					

	$sql2 = "SELECT nodoruteador.IdNodRut, NomVal, EstVal, AccVal FROM valvula, nodoruteador 
	WHERE nodoruteador.IdNodRut=valvula.IdNodRut AND IdVal='".$idVal."'";
	$result2 = $conexion->query($sql2);

	if ($result2->num_rows > 0) 
	{
		while($row2 = $result2->fetch_assoc()) 
		{
			$idNodRutVal=$row2["IdNodRut"];
			$idCamVal=1;
			$nomCam="campo";
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
	echo '<th colspan="2" ondblclick="mostrarUnaValvula('.$idVal.'), cerrarPopUp()">Valvula</th>';
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

	/*echo '<tr>';
	echo '<td>Acción</td>';
	echo '<td>';
	echo '<label class="switch switch-green" >';
	if($estVal==1)//jalamos lo q tiene el estado en vez de la accion
	{ 
		echo '<input type="checkbox" onclick="accionarSwitchValvulaMapaAntigua('.$idVal.')" id="switchValvula'.$idVal.'" class="switch-input" checked>';
	}
	else
	{   
		echo '<input type="checkbox" onclick="accionarSwitchValvulaMapaAntigua('.$idVal.')" id="switchValvula'.$idVal.'" class="switch-input">';
	}
	echo '<span class="switch-label" data-on="Cerrar" data-off="Abrir"></span>';
	echo '<span class="switch-handle"></span>';
	echo '</label>';
	echo '</td>';        
	echo '</tr>';	*/

	echo '<tr>';
	echo '<td>Estado Actual:</td>';
	echo '<td>';
		if($estVal==1)
		{ 
		    //echo '<img id="imagenValvula" src="img/valvulaAbierta.gif">';
		    echo 'Abierto';
		}
		else
		{   
		    //echo '<img id="imagenValvula" src="img/valvulaCerrada.gif">';
		    echo 'Cerrado';
		}
	echo '</td>';
	echo '</tr>';

	echo '<tr style="background:#f2f2f2;">';
    echo '<td colspan="2" style=""padding:0;>';
?>

	<span id="unidadMedida">(Sequedad)</span>
	<div id="tituloGrafica" ></div>
	<div id="contenedorGrafico" style="width:680px; height: 300px; border:1px solid #F0F0F0; ">

        <canvas id="miCanvasGrafico" width="200" height="300" style="border-left:1px solid red; border-bottom: 1px solid red; margin-left: 50px; position: absolute; z-index: 1;">
        </canvas>
        <canvas id="miCanvasTexto" width="200" height="300" style="background: #F0F0F0; position: absolute; z-index: 0;">
        </canvas>
	</div>
	<span id="unidadMedidaAbajo">(Horas)</span>   




<?php
    echo '</td>';
    echo '</tr>';


	echo '</table>';
			    			        		
?>