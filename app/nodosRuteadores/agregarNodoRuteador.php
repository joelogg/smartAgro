<?php
include ("../../partes/conexion.php");
$nomNR = $_GET['nomNR'];
$dirFisNR = $_GET['dirFisNR'];
$canValNodRut = $_GET['canValNodRut'];


$sql = "INSERT INTO dispositivos(NomDis, DirFisDis, TipDis) VALUES 
	('".$nomNR."',CONV('".$dirFisNR."', 16, 10), 20)";

if ($conexion->query($sql) === TRUE) 
{
   $sql2 = "SELECT IdDis FROM dispositivos WHERE DirFisDis=CONV('".$dirFisNR."', 16, 10)";
	$result2 = $conexion->query($sql2);

	if ($result2->num_rows > 0) 
	{
	    while($row2 = $result2->fetch_assoc()) 
	    {
	    	$idDis=$row2["IdDis"];
	    }
	}

	$sql2 = "INSERT INTO nodoruteador(IdDis, CanValNodRut) VALUES ('".$idDis."', '".$canValNodRut."')";

	if ($conexion->query($sql2) === TRUE) 
	{
	    echo "Correcto";
	} 
	else 
	{
	    echo "Error: " . $sql2 . "<br>" . $conexion->error;
	}

	$sql2 = "SELECT IdNodRut FROM nodoruteador WHERE IdDis='".$idDis."'";
	$result2 = $conexion->query($sql2);

	if ($result2->num_rows > 0) 
	{
	    while($row2 = $result2->fetch_assoc()) 
	    {
	    	$idNodRut=$row2["IdNodRut"];
	    }
	}

	for ($i=1; $i <= $canValNodRut ; $i++) 
	{ 
		$sql2 = "INSERT INTO valvula(IdNodRut, NomVal, OrdVal) VALUES ('".$idNodRut."', 'Valvula-".$dirFisNR.'-'.$i."', '".$i."')";

		if ($conexion->query($sql2) === TRUE) 
		{
		    //echo "Correcto";
		} 
	}
} 
else 
{
    echo "Error";
}



$conexion->close();
?>