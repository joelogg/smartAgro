<?php
include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];
?>

<p class="franja" style="text-align: center;">AGREGANDO SENSOR</p>
<div id="botonesPropiedades">
	<button id="botonGuardar" onclick="agregarSensorBD()"><span id="icoGuardar"></span><span class="letraBotonesP">Guardar</span></button>
	<button id="botonCancelar" onclick="getCampos()"><span id="icoCancelar"></span><span class="letraBotonesP">Cancelar</span></button>
</div>

<p class="franja">Sensor</p>
<form>
	<input type="text" id="idCam" value=<?php echo "'".$idCam."'"; ?> hidden>

	<table id="tablaFormularioGuardar">		
		<tr>
			<td>Nombre: </td>
			<td><input type="text" id="nomNodTer"></td>
		</tr>
		<tr>
			<td>Dirección Física: </td>
			<td><input type="text" id="dirFisNodTer"></td>
		</tr>		
		<tr>
			<td>Nro. de Terminales: </td>
			<td><input type="number" id="canSenNodTer" min="1" max="4"></td>
		</tr>
		<tr>
			<td>Nodo Ruteador:</td>
			<td><select id="idNodRut">

<?php
			$sql2 = "SELECT IdNodRut, NomNodRut, DirFisNodRut FROM nodoruteador";
			$result2 = $conexion->query($sql2);

			if ($result2->num_rows > 0) 
			{
			    while($row2 = $result2->fetch_assoc()) 
			    {
			    	$idNodRut=$row2["IdNodRut"];
			        $nomNodRut=$row2["NomNodRut"];
			        $dirFisNodRut=$row2["DirFisNodRut"];
			        echo '<option value="'.$idNodRut.'">'.$nomNodRut.'</option>';
			    }
			}
?>
			</select>
			</td>
		</tr>
	</table>
</form>

<p class="franja"></p>

<?php
$conexion->close();
?>