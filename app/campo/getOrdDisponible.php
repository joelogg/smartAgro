<?php
include ("../../partes/conexion.php");
$idNodRut = $_GET['idNodRut'];
$sql = "SELECT CanValNodRut FROM nodoruteador WHERE IdNodRut='".$idNodRut."'";
            
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{    
    while($row = $result->fetch_assoc())
    {
        $canValNodRut=$row["CanValNodRut"];
    }
}
$sql = "SELECT OrdVal FROM valvula, nodoruteador WHERE IdNodRutVal=IdNodRut AND IdNodRutVal='".$idNodRut."'";
            
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{  
    while($row = $result->fetch_assoc())
    {  
        $ordVal=$row["OrdVal"];
        $ordenesVal[$ordVal] = $ordVal;       
    }
}
for ($i=1; $i <= $canValNodRut; $i++) 
{ 
    if(array_key_exists($i,$ordenesVal))
    {
        //echo '<option value="'.$i.'">'.$i.'j</option>';
    }
    else
    {
        echo '<option value="'.$i.'">'.$i.'</option>';
    }
}
     

$conexion->close();
?>