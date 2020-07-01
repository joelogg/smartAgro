<?php
include ("../../partes/conexion.php");

	$anchoV = $_GET['anchoV'];
	$altoV = $_GET['altoV'];

	$nuevoAlto = $altoV - ($altoV*0.09) - 260;

    $idNodTer = $_GET['idNodTer'];

    $sql2 = "SELECT HEX(DirFisNodTer) AS DirFisNodTer2 FROM nodoterminal  WHERE IdNodTer='".$idNodTer."'";
	$result2 = $conexion->query($sql2);

	if ($result2->num_rows > 0) 
	{
	    while($row2 = $result2->fetch_assoc()) 
	    {
	        $dirFisNodTer=$row2["DirFisNodTer2"];
	    }
	}

$conexion->close();

echo '<p class="franja" style="text-align: center;">Sensor: '.$dirFisNodTer.'</p>';

include ("../partes/botonesGraficaNodoTerminal.php");
?>

<p class="franja" style="text-align: center;"></p>
	<table>
		<tr>
			<td><input type="date" id="fechaSeleccionadaIni"></td>
			<td><input type="date" id="fechaSeleccionadaFin"></td>				
			<td rowspan="2"><button onclick="verG()">Ver</button></td>
			<td rowspan="2"><button onclick="hoyG()">Hoy</button></td>
			<td rowspan="2"><button onclick="ultimaSemanaG()">Última Semana</button></td>
			<td rowspan="2"><button onclick="ultimoMes()">Último Mes</button></td>
			<td rowspan="2"><button onclick="todosMesesG()">Todos los Meses</button></td>
		</tr>
	</table>

<div id="capturaPantalla" <?php echo 'style="max-width:90%; max-height:'.$nuevoAlto.'px; background-color: #DDD; 
	 margin: 0 auto;"';?>  >
	<span id="unidadMedida">(Sequedad)</span>
	<div id="tituloGrafica" ></div>
	<div>
	    <canvas id="canvas" <?php echo ' style="width:99%; 
	    	max-height:'.($nuevoAlto-60).'px;"';?> ></canvas>
	</div>
	<span id="unidadMedidaAbajo">(Horas)</span>   
</div>