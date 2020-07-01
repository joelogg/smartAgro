<?php
include ("../../partes/conexion.php");
$cantidadTareas = 0;

$sql = "SELECT COUNT(*) AS CanTar FROM tareavalvula, valvula WHERE tareavalvula.IdVal=valvula.IdVal AND TipTarVal=3 AND CURDATE()<=FecFinTarVal";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $cantidadTareas=$row["CanTar"];
    }
}

echo '<p class="franja" style="text-align: center;">Tareas programadas</p>';
echo '<div id="botonesPropiedades">';
echo    '<p>Hay '.$cantidadTareas.' tareas. <br>';
echo    'Son todas las tareas programdas activas.</p>';
echo '</div>';



echo '<div style="width: 100%; float: left;">';    

$sql = "SELECT IdTarVal, tareavalvula.IdVal, NomVal, FecIniTarVal, FecFinTarVal, HorIniTarVal, HorFinTarVal, NomCam FROM tareavalvula, valvula, campo WHERE tareavalvula.IdVal=valvula.IdVal AND campo.IdCam=valvula.IdCamVal AND TipTarVal=3 AND CURDATE()<=FecFinTarVal ORDER BY FecFinTarVal";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    echo '<p class="franja"></p>';
    echo '<img src="img/tareasProgramadas.png" class="imgTareas">';

    while($row = $result->fetch_assoc()) 
    {
        $idTarVal=$row["IdTarVal"];
        $idVal=$row["IdVal"];
        $nomVal=$row["NomVal"];
        $fecIniTarVal=$row["FecIniTarVal"];
        $fecFinTarVal=$row["FecFinTarVal"];
        $horIniTarVal=$row["HorIniTarVal"];
        $horFinTarVal=$row["HorFinTarVal"];
        $nomCam=$row["NomCam"];
        
                   
        echo '<table class="tablaAlerta">';        
        
        echo '<tr>';
        echo '<td>Nombre Valvula</td><td><input type="text" value="'.$nomVal.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Ubicado en el campo</td><td><input type="text" value="'.$nomCam.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Fecha Inicio</td><td><input type="text" value="'.$fecIniTarVal.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Hora Inicio</td><td><input type="text" value="'.$horIniTarVal.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Fecha Fin</td><td><input type="text" value="'.$fecFinTarVal.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Hora Fin</td><td><input type="text" value="'.$horFinTarVal.'" disabled></td>';
        echo '</tr>';
 

        echo '</table>';      
    }
} 


    echo '<br>';
echo "</div>";
echo '<p class="franja" style="float: left;"></p>';
echo "</div>";
$conexion->close();
?>