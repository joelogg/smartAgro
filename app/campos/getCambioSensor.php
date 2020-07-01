<?php
$idNodTer = $_GET['idNodTer'];

include ("../../partes/conexion.php");
$sql = "SELECT dispositivos.IdDis, EstConec FROM nodoterminal, dispositivos WHERE nodoterminal.IdDis=dispositivos.IdDis AND IdNodTer='".$idNodTer."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {   
        $idDis=$row["IdDis"];
        $estConec=$row["EstConec"];
        echo $estConec.$idDis;
    }
} 		
$conexion->close();
?>