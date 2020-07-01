<?php
if(empty($_SESSION["activo"]))
{
	header('Location:'.$dirServidor);
}
else
{
	if($_SESSION["activo"] == "true")
	{

	}
	else
	{
		header('Location:'.$dirServidor);
	}
}

?>