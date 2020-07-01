<?php
include ("../../partes/conexion.php");
$idCul = $_GET['idCul'];
$nomCul = $_GET['nomCul'];
$humMinCul = $_GET['humMinCul'];
$humMaxCul = $_GET['humMaxCul'];
$idNutEliminados = $_GET['idNutEliminados'];

$nutCul = $_GET['nutCul'];
$nutCulNue = $_GET['nutCulNue'];


$sql = "UPDATE cultivo SET NomCul='".$nomCul."', HumMinCul='".$humMinCul."', HumMaxCul='".$humMaxCul."' WHERE IdCul='".$idCul."'";

if ($conexion->query($sql) === TRUE) 
{
    echo "-Record updated successfully";
} 
else 
{
    echo "Error updating record: " . $conexion->error;
}

$idNut = "";
for ($i=0; $i < strlen($idNutEliminados); $i++) 
{ 
	$caracter = substr($idNutEliminados, $i, 1);
	if($caracter==",")
	{
		$sql = "DELETE FROM cultivonutrientes WHERE IdCul='".$idCul."' AND IdNut='".$idNut."'";

		if ($conexion->query($sql) === TRUE) 
		{
		    echo "Record deleted successfully";
		} 
		else 
		{
		    echo "Error deleting record: " . $conexion->error;
		}
		$idNut = "";
	}
	else
	{
		$idNut = $idNut.$caracter;
	}
}


$idNutExtraido = "";
$j = 0;
for ($i = 0; $i < strlen($nutCul); $i++) 
{
	$caracter = substr($nutCul, $i, 1);
	if($caracter==",")
	{
		//Extraer nombre nutriente nuevo
		$nomNutNue = "";
		for (; $j < strlen($nutCulNue); $j++) 
		{
			$caracter2 = substr($nutCulNue, $j, 1);
			if($caracter2==",")
			{
				$j++;
				break;
			}
			else
			{
				$nomNutNue = $nomNutNue.$caracter2;
			}
		}

		//
		if($idNutExtraido==-1)
		{
			//No hacer nada
		}
		elseif($idNutExtraido==-2)
		{			
			//Crear Nutriente y extraer id Creado
			$sql = "INSERT INTO nutrientes(DesNut) VALUES ('".$nomNutNue."')";

			if ($conexion->query($sql) === TRUE) 
			{
			    echo "New record created successfully";
			} 
			else 
			{
			    echo "Error: " . $sql . "<br>" . $conexion->error;
			}

			$idNutNuevo=1;

			$sql = "SELECT IdNut FROM nutrientes ORDER BY IdNut DESC LIMIT 1";
			$result = $conexion->query($sql);

			if ($result->num_rows > 0) 
			{
				while($row = $result->fetch_assoc()) 
				{
			        $idNutNuevo=$row["IdNut"];
			    }
			}

			$sql = "INSERT INTO cultivonutrientes(IdCul, IdNut) VALUES ('".$idCul."','".$idNutNuevo."')";

			if ($conexion->query($sql) === TRUE) 
			{
			    echo "New record created successfully";
			} 
			else 
			{
			    echo "Error: " . $sql . "<br>" . $conexion->error;
			}
		}

		else
		{
			$sql = "INSERT INTO cultivonutrientes(IdCul, IdNut) VALUES ('".$idCul."','".$idNutExtraido."')";

			if ($conexion->query($sql) === TRUE) 
			{
			    echo "New record created successfully";
			} 
			else 
			{
			    echo "Error: " . $sql . "<br>" . $conexion->error;
			}
		}


		$idNutExtraido = "";
	}
	else
	{
		$idNutExtraido = $idNutExtraido.$caracter;
	}
} 

$conexion->close();
?>