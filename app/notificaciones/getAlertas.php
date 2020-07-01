<?php
include ("../../partes/conexion.php");
$numeroAlertas = 0;

$sql = "SELECT COUNT(*) AS NumAler FROM campo, cultivo WHERE campo.IdCul = cultivo.IdCul AND ActCam =1 AND (HumMinCul>HumCam OR HumCam>HumMaxCul)";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $numeroAlertas=$row["NumAler"];
    }
}

echo '<p class="franja" style="text-align: center;">Alertas</p>';
echo '<div id="botonesPropiedades">';
echo    '<p style="color: #D00;">Resolver estas "'.$numeroAlertas.'" alertas en su brevedad. <br>';
echo    'Cuidemos nuestros cultivos!!!</p>';
echo '</div>';


echo '<div style="width: 100%; float: left;">';    

$sql = "SELECT IdCam, NomCam, NomCul, HumCam, HumMaxCul FROM campo, cultivo WHERE campo.IdCul = cultivo.IdCul AND ActCam =1 AND HumCam>HumMaxCul";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    echo '<p class="franja">Campos con exceso de agua</p>';
    echo '<img src="img/cultivoInundado.jpg" class="imgAlertas">';
	while($row = $result->fetch_assoc()) 
	{
        $idCam=$row["IdCam"];
        $nomCam=$row["NomCam"];
        $nomCul=$row["NomCul"];
        $humCam=$row["HumCam"];
        $humMaxCul=$row["HumMaxCul"];
           
        echo '<table class="tablaAlerta">';        

        echo '<tr>';
        echo '<td>Campo</td><td><input type="text" value="'.$nomCam.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Cultivo</td><td><input type="text" value="'.$nomCul.'" disabled></td>';
        echo '</tr>';         

        echo '<tr>';
        echo '<td>Humedad del Campo</td><td><input type="number" value="'.$humCam.'" disabled></td>';
        echo '</tr>'; 

        echo '<tr>';
        echo '<td>Humedad Máxima</td><td><input type="number" value="'.$humMaxCul.'" disabled></td>';
        echo '</tr>'; 

        echo '</table>';        
    }
} 
    echo '<br>';
echo "</div>";
echo '<div style="width: 100%; float: left;">';    

$sql = "SELECT IdCam, NomCam, NomCul, HumMinCul, HumCam FROM campo, cultivo WHERE campo.IdCul = cultivo.IdCul AND ActCam =1 AND HumMinCul>HumCam";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    echo '<p class="franja">Campos con escases de agua</p>';
    echo '<img src="img/cultivoSeco.jpg" class="imgAlertas">';
    while($row = $result->fetch_assoc()) 
    {
        $idCam=$row["IdCam"];
        $nomCam=$row["NomCam"];
        $nomCul=$row["NomCul"];
        $humMinCul=$row["HumMinCul"];
        $humCam=$row["HumCam"];
                   
        echo '<table class="tablaAlerta">';        

        echo '<tr>';
        echo '<td>Campo</td><td><input type="text" value="'.$nomCam.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Cultivo</td><td><input type="text" value="'.$nomCul.'" disabled></td>';
        echo '</tr>';         

        echo '<tr>';
        echo '<td>Humedad del Campo</td><td><input type="number" value="'.$humCam.'" disabled></td>';
        echo '</tr>'; 

        echo '<tr>';
        echo '<td>Humedad Mínima</td><td><input type="number" value="'.$humMinCul.'" disabled></td>';
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