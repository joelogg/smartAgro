<?php
include ("../../partes/conexion.php");

echo '<p class="franja" style="text-align: center;">DISPOSITIVOS</p>';
echo '<div id="botonesPropiedades">';
echo    '<button onclick="activarPermitJoim()" style="width: 250px;"><span id="icoActivarPermitJoim"></span><span class="letraBotonesP">Activar Busqueda Dispositivos</span></button>';
echo    '<button id="botonTrasparente"><span id="reloj" class="letraBotonesP">00:00</span></button>';
echo    '<button onclick="permitirConexionDis()" style="width: 150px; float: right; margin-right:20px;"><span id="icoAgregar"></span><span class="letraBotonesP">Cargar archivo</span></button>';
echo '</div>';


echo '<p class="franja">Lista por agregar </p>';

echo '<br>';

echo '<table class="tablaNormal">';
echo    '<tr>';
        echo '<th>Dirección. Física</th>';
        echo '<th>Dirección. Corta</th>';
        echo '<th>Tipo</th>';
        echo '<th>Eliminar</th>';
echo    '</tr>';
$sql = "SELECT IdDis, HEX(DirFisDis) AS DirFisDis, HEX(DirFisCorDis) AS DirFisCorDis, TipDis FROM dispositivospermitjoin WHERE EstDis=1";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $idDis=$row["IdDis"];
        $dirFisDis=$row["DirFisDis"];
        $dirFisCorDis=$row["DirFisCorDis"];
        $tipDis=$row["TipDis"];
                
        echo '<tr>';
        echo '<td>'.$dirFisDis.'</td>';
        echo '<td>'.$dirFisCorDis.'</td>';
        if ($tipDis==1)
        {
            echo '<td>Coordinador</td>';
            echo '<td>No Posible</td>';
        }
        elseif($tipDis==20)
        {
            echo '<td>Ruteador</td>';
            echo '<td><button onclick="eliminarDispositivo('.$idDis.')">Eliminar</button></td>';
        }
        elseif($tipDis==10)
        {
            echo '<td>Sensor</td>';
            echo '<td><button onclick="eliminarDispositivo('.$idDis.')">Eliminar</button></td>';
        }
        echo '</tr>';
    }
} 
echo '</table>';

echo '<br>';
echo '</form>';

echo '<p class="franja">Nuevos Dispositivos Encontrados </p>';

echo '<br>';

echo '<table class="tablaNormal">';
echo    '<tr>';
        echo '<th>Dirección. Física</th>';
        echo '<th>Dirección. Corta</th>';
        echo '<th>Tipo</th>';
        echo '<th>Agregar</th>';
echo    '</tr>';
$sql = "SELECT IdDis, HEX(DirFisDis) AS DirFisDis, HEX(DirFisCorDis) AS DirFisCorDis, TipDis FROM dispositivospermitjoin WHERE EstDis=0";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $idDis=$row["IdDis"];
        $dirFisDis=$row["DirFisDis"];
        $dirFisCorDis=$row["DirFisCorDis"];
        $tipDis=$row["TipDis"];
                
        echo '<tr>';
        echo '<td>'.$dirFisDis.'</td>';
        echo '<td>'.$dirFisCorDis.'</td>';

        if ($tipDis==1)
        {
            echo '<td>Coordinador</td>';
            echo '<td><button onclick="aceptarDispositivo('.$idDis.')">Agregar</button></td>';
        }
        elseif($tipDis==20)
        {
            echo '<td>Ruteador</td>';
            echo '<td><button onclick="aceptarDispositivo('.$idDis.')">Agregar</button></td>';
        }
        elseif($tipDis==10)
        {
            echo '<td>Sensor</td>';
            echo '<td><button onclick="aceptarDispositivo('.$idDis.')">Agregar</button></td>';
        }
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