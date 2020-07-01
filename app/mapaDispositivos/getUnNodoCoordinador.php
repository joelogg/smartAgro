<?php
$idDis = $_GET['idDis'];


include ("../../partes/conexion.php");
            
echo '<table class="tablaInformativa">';

$sql = "SELECT NomDis, IdSupDis, Hex(DirFisDis) AS DirFisDis, Hex(DirFisCorDis) AS DirFisCorDis, ProDis, LQIDirDis, LQIInvDis, PeriodoDis, EstConec, TxDis FROM dispositivos WHERE IdDis='".$idDis."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $nomDis=$row["NomDis"];
        //$idSupDis=$row["IdSupDis"];
        $dirFisDis=$row["DirFisDis"];
        $dirFisCorDis=$row["DirFisCorDis"];
        $proDis=$row["ProDis"];
        $lQIDirDis=$row["LQIDirDis"];
        $lQIInvDis=$row["LQIInvDis"];
        $periodoDis=$row["PeriodoDis"];
        $estConec=$row["EstConec"];
        $txDis=$row["TxDis"];

        echo '<tr>';
        echo '<th colspan="2">Coordinador</th>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Nombre:</td><td>'.$nomDis.'</td>';
        echo '</tr>';

        /*echo '<tr>';
        echo '<td>Id Dispositivo Padre:</td><td>'.$idSupDis.'</td>';
        echo '</tr>';*/
        
        echo '<tr>';
        echo '<td>Dirección Física:</td><td>'.$dirFisDis.'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Dirección Corta:</td><td>'.$dirFisCorDis.'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Profundidad:</td><td>'.$proDis.'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>LQI Directo:</td><td>'.$lQIDirDis.'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>LQI Inverso:</td><td>'.$lQIInvDis.'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Peridoo:</td><td>'.$periodoDis.'</td>';
        echo '</tr>';

        echo '<tr>';
        if($estConec==1)//conectado
        {
            echo '<td>Conexión</td><td>Conectado</td>';
        }
        else
        {
            echo '<td>Conexión:</td><td>Desconectado</td>';
        }
        echo '</tr>';

        echo '<tr>';
        echo '<td>tx:</td><td>'.$txDis.'</td>';
        echo '</tr>';
    }
} 
echo '</table>';    

$conexion->close(); 
?>