<?php
include ("../../partes/conexion.php");
$idNodTer = $_GET['idNodTer'];

$sql3 = "UPDATE nodoterminal SET CambNodTer=0 WHERE IdNodTer='".$idNodTer."'";

if ($conexion->query($sql3) === TRUE) 
{
    $sql = "SELECT dispositivos.IdDis, nodoterminal.IdNodTer FROM nodoterminal, dispositivos WHERE nodoterminal.IdDis=dispositivos.IdDis AND nodoterminal.IdNodTer='".$idNodTer."'";
	$result = $conexion->query($sql);

	if ($result->num_rows > 0) 
	{
	    while($row = $result->fetch_assoc()) 
	    {
	        $idDis=$row["IdDis"];
	        $idNodTer=$row["IdNodTer"];

	        $sql2 = "SELECT BatHisNodTer, RssiHisNodTer FROM historialnodoterminal WHERE IdNodTer='".$idNodTer."' ORDER BY FecHisNodTer DESC, TieHisNodTer DESC LIMIT 1";
			$result2 = $conexion->query($sql2);

			if ($result2->num_rows > 0) 
			{
			    while($row2 = $result2->fetch_assoc()) 
			    {
			        $batHisNodTer=$row2["BatHisNodTer"];
			        $rssiHisNodTer=$row2["RssiHisNodTer"];
			        $batHisNodTer = $batHisNodTer/1000;
			        $batHisNodTer = round($batHisNodTer, 1);
			    }
			}

			echo '<div id=rectanguloValvula'.$idNodTer.' class="sensorRect">';	
						
				echo '<div class=textoSuperior><span>S'.$idNodTer .'</span></div>' ;

				echo '<div class=rectMedio><span>1A</span><p></p></div>' ;
				echo '<div class=texto3er><span>30.2ºC</span></div>' ;
				echo '<div class=texto4to><span>200.0CB</span></div>' ;
				echo '<div class=textoInferior><span>'.$batHisNodTer.'V / '.$rssiHisNodTer.'dbm</span></div>';

			echo '</div>';

	    }
	}
} 

$conexion->close();
?>