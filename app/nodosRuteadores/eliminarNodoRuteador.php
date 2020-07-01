<?php
include ("../../partes/conexion.php");
$idNodRut = $_GET['idNodRut'];


$sql = "SELECT HEX(DirFisDis) AS DirFisDis, HEX(DirFisCorDis) AS DirFisCorDis, TipDis FROM dispositivos WHERE IdDis='".$idNodRut."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $dirFisDis=$row["DirFisDis"];
        $dirFisCorDis=$row["DirFisCorDis"];
    }
} 


$sql = "INSERT INTO actividades(CodAct, ArgAct) VALUES (0x34,0xFFFF$0x".$dirFisDis."')";

if ($conexion->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

//borramos los historiales, el router y el dispositivo
$sql = "DELETE FROM historialnodoruteador WHERE IdNodRut=(SELECT IdNodRut FROM nodoruteador WHERE IdDis='".$idNodRut."')";
if ($conexion->query($sql) === TRUE) 
{
    echo "Record deleted successfully";
} 
else 
{
    echo "Error deleting record: " . $conexion->error;
}

$sql = "DELETE FROM nodoruteador WHERE IdDis='".$idNodRut."'";
if ($conexion->query($sql) === TRUE) 
{
    echo "Record deleted successfully";
} 
else 
{
    echo "Error deleting record: " . $conexion->error;
}

$sql = "DELETE FROM dispositivos WHERE IdDis='".$idNodRut."'";
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