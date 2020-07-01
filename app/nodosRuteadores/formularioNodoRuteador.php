<?php
include ("../../partes/conexion.php");
?>

<p class="franja" style="text-align: center;">AGREGANDO NODO RUTEADOR</p>
<div id="botonesPropiedades">
	<button id="botonGuardar" onclick="agregarNodoRuteadorBD()"><span id="icoGuardar"></span><span class="letraBotonesP">Guardar</span></button>
	<button id="botonCancelar" onclick="getRuteadores()"><span id="icoCancelar"></span><span class="letraBotonesP">Cancelar</span></button>
</div>

<p class="franja">Nodo Ruteador</p>
<form>
	<table id="tablaFormularioGuardar">
		<tr>
			<td>Nombre: </td>
			<td><input type="text" id="nomNR"></td>
		</tr>
		<tr>
			<td>Dirección Física: </td>
			<td><input type="text" id="dirFisNR"></input></td>
		</tr>
		
		<tr>
            <td>Cantidad de máxima de valvulas: </td>
            <td><input type="text" id="canValNodRut" ></input></td>
        </tr>
	</table>
</form>

<p class="franja"></p>

<?php
$conexion->close();
?>