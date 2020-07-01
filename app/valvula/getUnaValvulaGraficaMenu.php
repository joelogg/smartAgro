<?php
include ("../../partes/conexion.php");
	$idVal = $_GET['idVal'];

    $sql2 = "SELECT NomVal FROM valvula WHERE IdVal='".$idVal."'";
	$result2 = $conexion->query($sql2);

	if ($result2->num_rows > 0) 
	{
	    while($row2 = $result2->fetch_assoc()) 
	    {
	        $nomVal=$row2["NomVal"];
	    }
	}

$conexion->close();

echo '<p class="franja" style="text-align: center;">Sensor: '.$nomVal.'</p>';

include ("../partes/botonesGraficaValvula.php");
?>


<p class="franja" style="text-align: center;"></p>

<div id="capturaPantalla" style="width:80%;  background-color: #DDD; margin: 0 auto;">
    <div>
        <canvas id="canvas" style="width:100%; height:20%; "></canvas>
    </div>
</div>