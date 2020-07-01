<?php
include ("../../partes/conexion.php");

echo '<p class="franja" style="text-align: center;">PRODUCTOS CULTIVABLES</p>';
echo '<div id="botonesPropiedades">';
echo    '<button id="botonAgregar" onclick="agregarCultivo()"><span id="icoAgregar"></span><span class="letraBotonesP">Agregar</span></button>';
echo    '<button id="botonEliminar" onclick="eliminarCultivo()"><span id="icoEliminar"></span><span class="letraBotonesP">Eliminar</span></button>';
echo '</div>';


echo '<p class="franja">Productos Actualmente Cultivados</p>';

echo '<br>';

echo '<table class="tablaNormal" disabled>';
echo 	'<tr>';
        echo '<th>Producto</th>';
        echo '<th>Campo</th>';
        echo '<th>Ir</th>';
echo 	'</tr>';
$sql = "SELECT DISTINCT cultivo.IdCul, NomCul FROM cultivo, campo 
	WHERE cultivo.IdCul=campo.IdCul AND NomCul!='Sin Cultivo'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $nomCul=$row["NomCul"];
        $idCul=$row["IdCul"];
                
        echo '<tr>';
        echo '<td>'.$nomCul.'</td>';

        $respuestaCampos = "";
        $sql2 = "SELECT NomCam FROM campo WHERE IdCul='".$idCul."'";
		$result2 = $conexion->query($sql2);

		if ($result2->num_rows > 0) 
		{
			while($row2 = $result2->fetch_assoc()) 
			{
				$nomCam=$row2["NomCam"];
				$respuestaCampos = $respuestaCampos.$nomCam.",";
			}
		}
		$respuestaCampos = substr($respuestaCampos, 0, -1);





        echo '<td>'.$respuestaCampos.'</td>';
        echo '<td><a href="#" onclick="mostrarUnCultivo('.$idCul.')" style="color:#00A;"">Ir...</a></td>';
        echo '</tr>';
    }
} 
echo '</table>';

echo '<br>';
echo '<p class="franja">Productos No Cultivados </p>';

echo '<br>';

echo '<table class="tablaNormal">';
echo 	'<tr>';
        echo '<th>Cultivo</th>';
        echo '<th>Ir</th>';
        echo '<th>Eliminar</th>';
echo 	'</tr>';
$sql = "SELECT DISTINCT IdCul, NomCul FROM cultivo WHERE EstCul=0 AND NomCul!='Sin Cultivo'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $nomCul=$row["NomCul"];
        $idCul=$row["IdCul"];
                
        echo '<tr>';
        echo '<td>'.$nomCul.'</td>';
        echo '<td><a href="#" onclick="mostrarUnCultivo('.$idCul.')" style="color:#00A;">Ir...</a></td>';
        echo '<td><input type="checkbox" onclick="clicCheck('.$idCul.')" name="idCulSelecionado" value="'.$idCul.'"</td>';
        echo '</tr>';
    }
} 
echo '</table>';

echo '<br>';
echo '</form>';

echo '<p class="franja"></p>';
echo "</div>";
$conexion->close();
?>