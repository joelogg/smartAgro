<?php
include ("../../partes/conexion.php");

echo '<p class="franja" style="text-align: center;">Otros Dispositivos</p>';
echo '<div id="botonesPropiedades">';
echo    '<button onclick="getCoordinadores()" style="width: 180px;"><span class="icoCoordinadores"></span><span class="letraBotonesP">Nodos Coordinadores</span></button>';
echo    '<button onclick="getRuteadores()" style="width: 170px;"><span class="icoRuteadores"></span><span class="letraBotonesP">Nodos Ruteadores</span></button>';
echo '</div>';


echo '<p class="franja">Propiedades</p>';
echo '<div id="infoDispositivo">';
echo '<form action="#"><table id="tablaFormulario">';

$sql = "SELECT COUNT(*) AS TotalNC FROM nodocoordinador";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $totalNC=$row["TotalNC"]; 
        echo '<tr>';
        echo '<td>Total Nodos Coordinadores</td><td><input type="number" value="'.$totalNC.'" disabled></td>';
        echo '</tr>';               
    }
}        

$sql = "SELECT COUNT(*) AS TotalNR FROM nodoruteador";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $totalNR=$row["TotalNR"];   
        echo '<tr>';
        echo '<td>Total Nodos Ruteadores</td><td><input type="number" value="'.$totalNR.'" disabled></td>';
        echo '</tr>';             
    }
}

$sql = "SELECT COUNT(*) AS TotalNT FROM nodoterminal";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $totalNT=$row["TotalNT"];   
        echo '<tr>';
        echo '<td>Total Nodos Terminales</td><td><input type="number" value="'.$totalNT.'" disabled></td>';
        echo '</tr>';             
    }
}

echo '</table>';

echo '<br>';
echo '</form>';

echo '<p class="franja"></p>';
echo '<br>';

echo '<table class="tablaNormal">';
echo    '<tr>';
        echo '<th>Dirección. Física</th>';
        echo '<th>Dirección. Corta</th>';
        echo '<th>Tipo</th>';
echo    '</tr>';
$sql = "SELECT IdDis, HEX(DirFisDis) AS DirFisDis, HEX(DirFisCorDis) AS DirFisCorDis, TipDis FROM dispositivos";
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
        }
        elseif($tipDis==20)
        {
            echo '<td>Ruteador</td>';
        }
        elseif($tipDis==10)
        {
            echo '<td>Terminal</td>';
        }
        echo '</tr>';
    }
} 
echo '</table>';
echo '<br>';

echo '<p class="franja"></p>';
echo "</div>";
$conexion->close();
?>