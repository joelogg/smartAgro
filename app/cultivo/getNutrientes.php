<?php
include ("../../partes/conexion.php");
echo '<option value="-1">-</option>';

$sql = "SELECT IdNut, DesNut FROM nutrientes";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $idNut=$row["IdNut"];
        $desNut=$row["DesNut"];        
        echo '<option value="'.$idNut.'">'.$desNut.'</option>';
    }
}
echo '<option value="-2">Nuevo</option>'; 

echo '</select>';
$conexion->close();
?>