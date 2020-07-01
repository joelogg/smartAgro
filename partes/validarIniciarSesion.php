<?php 
include ("sesionStart.php");
include ("conexion.php");

$usuario = $_GET["usuario"];



$clave = $_GET["clave"];

	$sql = "SELECT * FROM usuario WHERE UsuUsu='".$usuario."' AND ConUsu='".$clave."'";
	$result = $conexion->query($sql);

	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc()) 
		{
        	$_SESSION["activo"]="true";
			$_SESSION["privilegio"]	= $row["IdTip"];

			include ("detectarDispositivo.php");
			$tipoDispositivo = 0;
			if ($tablet_browser > 0) 
			{				
			   	echo "tablet";
			}
			else if ($mobile_browser > 0) 
			{
				echo "movil";
			}
			else 
			{
				echo "app";
			} 
    	}
		
	}
	else
	{
		if($usuario =="")
		{
			echo "Ingrese usuario";
		}
		else if($clave=="")
		{
			echo "Ingrese contraseña";
		}
		else
		{
			echo "Usuario o contraseña incorrecta";
		}
		
	}
	$conexion->close();
?>
