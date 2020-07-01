<?php
include ("../../partes/conexion.php");

echo '<p class="franja" style="text-align: center;">NODOS TERMINALES</p>';
echo '<div id="botonesPropiedades">';
echo    '<button id="botonAgregar" onclick="agregarNodoTerminal()"><span id="icoAgregar"></span><span class="letraBotonesP">Agregar</span></button>';
echo    '<button id="botonEliminar" onclick="eliminarNodoTerminal()"><span id="icoEliminar"></span><span class="letraBotonesP">Eliminar</span></button>';
echo '</div>';


echo '<p class="franja">Listado de Nodos Terminales </p>';

echo '<br>';

echo '<table class="tablaNormal">';
echo 	'<tr>';
        echo '<th>N. Terminal</th>';
        echo '<th>Dirección. Física</th>';
        echo '<th>Ir</th>';
        echo '<th>Eliminar</th>';
echo 	'</tr>';
$sql = "SELECT IdDis, NomDis, HEX(DirFisDis) AS DirFisDis FROM dispositivos WHERE TipDis=10";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $idNodTer=$row["IdDis"];
        $nomNodRut=$row["NomDis"];
        $dirFisNodRut=$row["DirFisDis"];
                
        echo '<tr>';
        echo '<td>'.$nomNodRut.'</td>';
        echo '<td>'.$dirFisNodRut.'</td>';
        echo '<td><a href="#" onclick="mostrarUnNodoTerminal('.$idNodTer.')" style="color:#00A;">Ir...</a></td>';
        echo '<td><input type="checkbox" onclick="clicCheckNT('.$idNodTer.')" name="idCulSelecionado" value="'.$idNodTer.'"</td>';
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