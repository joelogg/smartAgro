<?php
include ("../../partes/conexion.php");
$idVal = $_GET['idVal'];
$accVal = $_GET['accVal'];


$sql = "UPDATE valvula SET CambEmiVal=1, AccVal='".$accVal."' WHERE IdVal='".$idVal."'";

if ($conexion->query($sql) === TRUE) 
{
    echo "Record updated successfully";
} 
else 
{
    echo "Error updating record: " . $conexion->error;
}


$sql = "SELECT HEX(DirFisCorDis) AS DirFisCorDis, OrdVal FROM dispositivos, nodoruteador, valvula WHERE valvula.IdNodRut=nodoruteador.IdNodRut AND nodoruteador.IdDis=dispositivos.IdDis AND valvula.IdVal='".$idVal."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $dirFisCorDis = '0x'.$row["DirFisCorDis"];       
        $ordVal = $row["OrdVal"];
    }
}

$mascara = pow(2, $ordVal);
if($accVal==0)//cerrado
{
	$accion = 0;
}
else//abierto
{
	$accion = $mascara;
}
$data = $dirFisCorDis.'$'.$mascara.'$'.$accion;

$sql = "INSERT INTO actividades( CodAct, ArgAct ) 
VALUES ( 0xEC,  '".$data."' )";

if ($conexion->query($sql) === TRUE) 
{
    echo "Correcto";
} 
else 
{
    echo "Error";
}



$conexion->close();
?>