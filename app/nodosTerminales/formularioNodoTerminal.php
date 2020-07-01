<?php
include ("../../partes/conexion.php");
?>

<p class="franja" style="text-align: center;">AGREGANDO NODO TERMINAL</p>
<div id="botonesPropiedades">
	<button id="botonGuardar" onclick="agregarNodoTerminalBD()"><span id="icoGuardar"></span><span class="letraBotonesP">Guardar</span></button>
	<button id="botonCancelar" onclick="getTerminales()"><span id="icoCancelar"></span><span class="letraBotonesP">Cancelar</span></button>
</div>

<p class="franja">Nodo Terminal</p>
<form>
	<table id="tablaFormularioGuardar">
		<tr>
			<td>Nombre: </td>
			<td><input type="text" id="nomNT"></td>
		</tr>
		<tr>
			<td>Dirección Física: </td>
			<td><input type="text" id="dirFisNT"></input></td>
		</tr>
		
		<tr>
            <td>Cantidad de máxima de sensores: </td>
            <td><input type="text" id="canSenNodTer" ></input></td>
        </tr>
	</table>
</form>

<p class="franja"></p>

<?php
$conexion->close();
?>