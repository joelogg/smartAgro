<?php
include ("../../partes/conexion.php");

$sql = "SELECT DirFisDis, DirFisCorDis, TipDis FROM dispositivospermitjoin WHERE EstDis=1";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
    	$dirFisDis=$row["DirFisDis"];
    	$dirFisCorDis=$row["DirFisCorDis"];
    	$tipDis=$row["TipDis"];

    	if($tipDis==20)//Ruteador
    	{
	    	$sql2 = "INSERT INTO dispositivos(NomDis, DirFisDis, DirFisCorDis, TipDis, EstAgr) VALUES ('Ruteador', '".$dirFisDis."', '".$dirFisCorDis."', '".$tipDis."', 1)";

			if ($conexion->query($sql2) === TRUE) 
			{
			    echo "New record created successfully";
			} 
			else 
			{
			    echo "Error: " . $sql2 . "<br>" . $conexion->error;
			}

			$sql2 = "SELECT IdDis FROM dispositivos WHERE DirFisDis='".$dirFisDis."'";
			$result2 = $conexion->query($sql2);

			if ($result2->num_rows > 0) 
			{
			    while($row2 = $result2->fetch_assoc()) 
			    {
			    	$idDis=$row2["IdDis"];
			    }
			}

			$sql2 = "INSERT INTO nodoruteador(IdDis) VALUES ('".$idDis."')";

			if ($conexion->query($sql2) === TRUE) 
			{
			    echo "New record created successfully";
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

			for ($i=1; $i <= 2 ; $i++) 
			{ 
				$sql2 = "INSERT INTO valvula(IdNodRut, NomVal, OrdVal) VALUES ('".$idNodRut."', 'Valvula-".$dirFisCorDis.'-'.$i."', '".$i."')";

				if ($conexion->query($sql2) === TRUE) 
				{
				    //echo "Correcto";
				} 
			}
    	} 
    	elseif($tipDis==10)//Terminal
    	{
    		$sql2 = "INSERT INTO dispositivos(NomDis, DirFisDis, DirFisCorDis, TipDis, EstAgr) VALUES ('Terminal', '".$dirFisDis."', '".$dirFisCorDis."', '".$tipDis."', 1)";

			if ($conexion->query($sql2) === TRUE) 
			{
			    echo "New record created successfully";
			} 
			else 
			{
			    echo "Error: " . $sql2 . "<br>" . $conexion->error;
			}

			$sql2 = "SELECT IdDis FROM dispositivos WHERE DirFisDis='".$dirFisDis."'";
			$result2 = $conexion->query($sql2);

			if ($result2->num_rows > 0) 
			{
			    while($row2 = $result2->fetch_assoc()) 
			    {
			    	$idDis=$row2["IdDis"];
			    }
			}

			$sql2 = "INSERT INTO nodoterminal(IdDis) VALUES ('".$idDis."')";

			if ($conexion->query($sql2) === TRUE) 
			{
			    echo "New record created successfully";
			} 
			else 
			{
			    echo "Error: " . $sql2 . "<br>" . $conexion->error;
			}
    	}   	

        


    }
} 

$sql2 = "DELETE FROM dispositivospermitjoin WHERE EstDis=1";

if ($conexion->query($sql2) === TRUE) 
{
    echo "New record created successfully";
} 
else 
{
    echo "Error: " . $sql2 . "<br>" . $conexion->error;
}

$conexion->close();
?>