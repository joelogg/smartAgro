<?php
include ("../../partes/conexion.php");
$idNodTer = $_GET['idNodTer'];


$sql = "SELECT HEX(DirFisDis) AS DirFisDis, HEX(DirFisCorDis) AS DirFisCorDis, TipDis FROM dispositivos WHERE IdDis='".$idNodTer."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $dirFisDis=$row["DirFisDis"];
        $dirFisCorDis=$row["DirFisCorDis"];
    }
} 


$sql = "INSERT INTO actividades(CodAct, ArgAct) VALUES (0x34, '".$dirFisCorDis."$".$dirFisDis."')";

if ($conexion->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

//borramos los historiales, el router y el dispositivo
$sql = "DELETE FROM historialnodoterminal WHERE IdNodTer=(SELECT IdNodTer FROM nodoterminal WHERE IdDis='".$idNodTer."')";
if ($conexion->query($sql) === TRUE) 
{
    echo "Record deleted successfully";
} 
else 
{
    echo "Error deleting record: " . $conexion->error;
}

$sql = "DELETE FROM nodoterminal WHERE IdDis='".$idNodTer."'";
if ($conexion->query($sql) === TRUE) 
{
    echo "Record deleted successfully";
} 
else 
{
    echo "Error deleting record: " . $conexion->error;
}

$sql = "DELETE FROM dispositivos WHERE IdDis='".$idNodTer."'";
if ($conexion->query($sql) === TRUE) 
{
    echo "Record deleted successfully";
} 
else 
{
    echo "Error deleting record: " . $conexion->error;
}



$conexion->close();
?>