<?php
include ("../../partes/conexion.php");
$nomNT = $_GET['nomNT'];
$dirFisNT = $_GET['dirFisNT'];
$canSenNodTer = $_GET['canSenNodTer'];


$sql = "INSERT INTO dispositivos(NomDis, DirFisDis, TipDis) VALUES 
	('".$nomNT."',CONV('".$dirFisNT."', 16, 10), 10)";

if ($conexion->query($sql) === TRUE) 
{
   $sql2 = "SELECT IdDis FROM dispositivos WHERE DirFisDis=CONV('".$dirFisNT."', 16, 10)";
	$result2 = $conexion->query($sql2);

	if ($result2->num_rows > 0) 
	{
	    while($row2 = $result2->fetch_assoc()) 
	    {
	    	$idDis=$row2["IdDis"];
	    }
	}

	$sql2 = "INSERT INTO nodoterminal(IdDis, CanSenNodTer) VALUES ('".$idDis."', '".$canSenNodTer."')";

	if ($conexion->query($sql2) === TRUE) 
	{
	    echo "Correcto";
	} 
	else 
	{
	    echo "Error: " . $sql2 . "<br>" . $conexion->error;
	}
} 
else 
{
    echo "Error";
}

$conexion->close();
?>