<?php
include ("../../partes/conexion.php");
$idDis = $_GET['idDis'];


$sql = "DELETE FROM dispositivospermitjoin WHERE IdDis='".$idDis."'";

if ($conexion->query($sql) === TRUE) 
{
    echo "-Record updated successfully";
} 
else 
{
    echo "Error updating record: " . $conexion->error;
}

/*
$sql = "SELECT HEX(DirFisDis) AS DirFisDis, HEX(DirFisCorDis) AS DirFisCorDis, TipDis FROM dispositivosPermitJoin WHERE IdDis='".$idDis."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $dirFisDis=$row["DirFisDis"];
        $dirFisCorDis=$row["DirFisCorDis"];
    }
} 
$sql = "INSERT INTO actividades(CodAct, ArgAct) VALUES (0x34, '0xFFFF$0x".$dirFisDis."')";

if ($conexion->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}
*/
$conexion->close();
?>