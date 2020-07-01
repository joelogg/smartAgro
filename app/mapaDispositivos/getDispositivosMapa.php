<?php 

	include ("../../partes/conexion.php");
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
				<td><input id="editarDispositivosCheck" onclick="editarCamposDispositivos()" type="checkbox"></td>
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
				<td><span class="spanNRLeyenda"></span></td>
				<td>Coordinadores</td>
			</tr>
			<tr>
				<td><span class="spanNCLeyenda"></span></td>
				<td>Ruteador</td>
			</tr>			
			<tr>
				<td><span class="spanNTLeyenda"></span></td>
				<td>Terminales</td>
			</tr>
			<tr>
				<td><span class="spanTextoLeyenda"></span></td>
				<td>Texto </td>
<!--				<td><input onclick="" type="checkbox" checked></td>-->
			</tr>
		</table>
	</div>

	<div id="infoDispositivosCampo">		
	</div>

</div>