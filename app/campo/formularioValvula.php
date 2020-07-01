<?php
include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];
?>

<p class="franja" style="text-align: center;">AGREGANDO VALVULA</p>
<div id="botonesPropiedades">
	<button id="botonGuardar" onclick="agregarValvulaBD()"><span id="icoGuardar"></span><span class="letraBotonesP">Guardar</span></button>
	<button id="botonCancelar" onclick="getCampos()"><span id="icoCancelar"></span><span class="letraBotonesP">Cancelar</span></button>
</div>

<p class="franja">Valvula</p>
<form>
	<input type="text" id="idCam" value=<?php echo "'".$idCam."'"; ?> hidden>

	<table id="tablaFormularioGuardar">		
		<tr>
			<td>Nombre: </td>
			<td><input type="text" id="nomVal"></td>
		</tr>
		<tr>
			<td>Nodo Ruteador:</td>
			<td><select id="idNodRut" onchange="mostrarOrdenDisponibleNR()">

<?php
			$sql2 = "SELECT IdNodRut, NomNodRut, DirFisNodRut, CanValNodRut, COUNT( * ) AS Contador FROM nodoruteador INNER JOIN valvula ON IdNodRut=IdNodRutVal GROUP BY IdNodRutVal";
			$result2 = $conexion->query($sql2);

			if ($result2->num_rows > 0) 
			{
				$primeraVez = true;;
			    while($row2 = $result2->fetch_assoc()) 
			    {
			    	$idNodRut=$row2["IdNodRut"];
			        $nomNodRut=$row2["NomNodRut"];
			        $dirFisNodRut=$row2["DirFisNodRut"];
			        $canValNodRut=$row2["CanValNodRut"];
			        $contador=$row2["Contador"];
			        if($canValNodRut > $contador)
			        {
			        	echo '<option value="'.$idNodRut.'">'.$nomNodRut.'</option>';
				        if($primeraVez)
				        {
				        	$idNodRutAux = $idNodRut;
				        	$canValNodRutAux = $canValNodRut;
				        	$primeraVez = false;
				        }
				    }
			    }
			}
?>
			</select>
			</td>
		<tr>
			<td>Orden Disponible:</td>
			<td><select id="ordVal"">
<?php 
			$sql = "SELECT OrdVal FROM valvula, nodoruteador WHERE IdNodRutVal=IdNodRut AND IdNodRutVal='".$idNodRutAux."'";
            
			$result = $conexion->query($sql);

			if ($result->num_rows > 0) 
			{  
			    while($row = $result->fetch_assoc())
			    {  
			        $ordVal=$row["OrdVal"];
			        $ordenesVal[$ordVal] = $ordVal;       
			    }
			}
			for ($i=1; $i <= $canValNodRutAux; $i++) 
			{ 
			    if(array_key_exists($i,$ordenesVal))
			    {
			        //echo '<option value="'.$i.'">'.$i.'j</option>';
			    }
			    else
			    {
			        echo '<option value="'.$i.'">'.$i.'</option>';
			    }
			}
?>
			</select></td>
		</tr>
	</table>
</form>

<p class="franja"></p>

<?php
$conexion->close();
?>