<div id="mapa">
	<svg id="svgMapa" onclick="position(event)">		
	</svg>

	<img id="imgMapa" src="img/campoProyecto.png">

	<div style=" padding:5px; background:white; position: absolute; 
	top:20px; left:4%;  opacity: 0.9; border: 1px solid #AAA; z-index:1;">
		<table>
			<tr>
				<td>Editar </td>
				<td><input id="editarMapaCheck" onclick="editarCampos()" type="checkbox"></td>
			</tr>
		</table>
	</div>

	<div style=" padding:5px; background:white; position: absolute; 
	top:20px; right:4%;  opacity: 0.9; border: 1px solid #AAA; z-index:1;">
		<table>
			<tr>				
				<td colspan="3" style="text-align: center; border-bottom: 1px dotted black;">Leyenda </td>
			</tr>
			<tr>
				<td><span class="spanCamposLeyenda"></span></td>
				<td>Campos </td>
			</tr>
			<tr>
				<td><span class="spanSensorLeyenda"></span></td>
				<td>Sensores </td>
			</tr>
			<tr>
				<td><span class="spanValvulaLeyenda"></span></td>
				<td>Valvulas </td>				
			</tr>
			<tr>
				<td><span class="spanTextoLeyenda"></span></td>
				<td>Texto </td>
				</td>
			</tr>
		</table>
	</div>

	<div id="infoDispositivosCampo">		
	</div>

</div>









<!--
<?php 
if(isset($_GET["desdeJava"]))
{
	include ("../../partes/conexion.php");
}
?>
<div id="mapa">
	<svg id="svgMapa" onclick="position(event)">		
	</svg>

	<img id="imgMapa" src="img/campoProyecto.png">

	<div style=" padding:5px; background:white; position: absolute; 
	top:20px; left:4%;  opacity: 0.9; border: 1px solid #AAA; z-index:1;">
		<table>
			<tr>
				<td>Editar </td>
				<td><input onclick="editarCampos()" type="checkbox"></td>
			</tr>
		</table>
	</div>

	<div style=" padding:5px; background:white; position: absolute; 
	top:20px; right:4%;  opacity: 0.9; border: 1px solid #AAA; z-index:1;">
		<table>
			<tr>				
				<td colspan="3" style="text-align: center; border-bottom: 1px dotted black;">Leyenda </td>
			</tr>
			<tr>
				<td><span class="spanCamposLeyenda"></span></td>
				<td>Campos </td>
				<td><input onclick="checkCamposClic()" type="checkbox" checked></td>
			</tr>
			<tr>
				<td><span class="spanSensorLeyenda"></span></td>
				<td>Sensores </td>
				<td><input onclick="checkSensoresClic()" type="checkbox" checked></td>
			</tr>
			<tr>
				<td><span class="spanValvulaLeyenda"></span></td>
				<td>Valvulas </td>
				<td><input onclick="checkValvulasClic()" type="checkbox" checked></td>
			</tr>
			<tr>
				<td><span class="spanTextoLeyenda"></span></td>
				<td>Texto </td>
				<td><input onclick="checkTextoClic()" type="checkbox" checked></td>
			</tr>
		</table>
	</div>

	<div id="infoDispositivosCampo">		
	</div>

</div>

-->
	<select id="campos" onchange="seleccionarCampo()">
		<option value="null"></option>	
<?php
		$sql = "SELECT * FROM campo";
		$result = $conexion->query($sql);
		if ($result->num_rows > 0) 
		{
		    while($row = $result->fetch_assoc()) 
		    {
		        $nomCam = $row["NomCam"];
		        $idGraCam = $row["IdCam"];
		        $posGraCam = $row["PosGraCam"];

		        if($posGraCam=="")
			    {
			    	echo '<option value="'.$idGraCam.'">'.$nomCam.' - Sin Ubicación</option>';
			    }
			    else
			    {
			    	echo '<option value="'.$idGraCam.'">'.$nomCam.'</option>';
			    }
		    }
		} 	$conexion->close();			
?>
	</select>
	<button id="boton" onclick="editar()" disabled>Editar</button>