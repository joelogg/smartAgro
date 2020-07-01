<?php
include ("../../partes/conexion.php");

echo '<p class="franja" style="text-align: center;">NODOS COORDINADORES</p>';
/*echo '<div id="botonesPropiedades">';
echo    '<button id="botonAgregar" onclick="agregarNodoCoordinador()"><span id="icoAgregar"></span><span class="letraBotonesP">Agregar</span></button>';
echo    '<button id="botonEliminar" onclick="eliminarNodoCoordinador()"><span id="icoEliminar"></span><span class="letraBotonesP">Eliminar</span></button>';
echo '</div>';*/


echo '<p class="franja">Listado de Nodos Coordinadores </p>';

echo '<br>';

echo '<table class="tablaNormal">';
echo 	'<tr>';
        echo '<th>Nombre N. Coordinador</th>';
        echo '<th>Dirección. Física</th>';
        echo '<th>Ir</th>';
        //echo '<th>Eliminar</th>';
echo 	'</tr>';
$sql = "SELECT IdDis, NomDis, HEX(DirFisDis) AS DirFisDis FROM dispositivos WHERE TipDis=1";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $idDis=$row["IdDis"];
        $nomDis=$row["NomDis"];
        $dirFisDis=$row["DirFisDis"];
                
        echo '<tr>';
        echo '<td>'.$nomDis.'</td>';
        echo '<td>'.$dirFisDis.'</td>';
        echo '<td><a href="#" onclick="mostrarUnNodoCoordinador('.$idDis.')" style="color:#00A;">Ir...</a></td>';
        //echo '<td><input type="checkbox" onclick="clicCheckNC('.$idDis.')" name="idCulSelecionado" value="'.$idDis.'"</td>';
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