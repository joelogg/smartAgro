<p class="franja" style="text-align: center;">AGREGANDO CULTIVO</p>
<div id="botonesPropiedades">
	<button id="botonGuardar" onclick="agregarCultivoBD()"><span id="icoGuardar"></span><span class="letraBotonesP">Guardar</span></button>
	<button id="botonCancelar" onclick="getCultivos()"><span id="icoCancelar"></span><span class="letraBotonesP">Cancelar</span></button>
</div>

<p class="franja">Cultivo</p>
<form>
	<table id="tablaFormularioGuardar">
		<tr>
			<td>Nombre: </td>
			<td><input type="text" id="nomCul"></td>
		</tr>
		<tr>
			<td>Humedad Mínima: </td>
			<td><input type="number" id="humMinCul"></input></td>
		</tr>
		<tr>
			<td>Humedad Máxima: </td>
			<td><input type="number" id="humMaxCul"></input></td>
		</tr>
	</table>

	<p class="franja" onclick="agregarCelda()" style="cursor: pointer;"><span id="icoAgregar"></span> Agregar Nutrientes</p>

	<table id="tablaFormularioAumentar">
	</table>
</form>

<p class="franja"></p>