<?php
include ("../../partes/conexion.php");

echo '<p class="franja" style="text-align: center;">NUTRIENTES</p>';
echo '<div id="botonesPropiedades">';
echo    '<button id="botonAgregar" onclick="agregarNutriente()"><span id="icoAgregar"></span><span class="letraBotonesP">Agregar</span></button>';
echo    '<button id="botonEliminar" onclick="eliminarNutriente()"><span id="icoEliminar"></span><span class="letraBotonesP">Eliminar</span></button>';
echo '</div>';


echo '<p class="franja">Nutrientes </p>';

echo '<br>';

echo '<table class="tablaNormal">';
echo 	'<tr>';
        echo '<th>Nutriente</th>';
        echo '<th>Ir</th>';
        echo '<th>Eliminar</th>';
echo 	'</tr>';
$sql = "SELECT IdNut, DesNut FROM nutrientes ORDER BY DesNut ASC";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $desNut=$row["DesNut"];
        $idNut=$row["IdNut"];
                
        echo '<tr>';
        echo '<td>'.$desNut.'</td>';
        echo '<td><a href="#" onclick="mostrarUnNutriente('.$idNut.')" style="color:#00A;">Ir...</a></td>';
        echo '<td><input type="checkbox" onclick="clicCheck('.$idNut.')" name="idNutSelecionado" value="'.$idNut.'"</td>';
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