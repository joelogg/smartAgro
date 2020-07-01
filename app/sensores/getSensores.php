<?php
include ("../../partes/conexion.php");

echo '<p class="franja" style="text-align: center;">Sensores</p>';

$sql = "SELECT dispositivos.IdDis, nodoterminal.IdNodTer, NomDis, CanSenNodTer FROM nodoterminal, dispositivos WHERE nodoterminal.IdDis=dispositivos.IdDis";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	$i=1;
    while($row = $result->fetch_assoc()) 
    {
        $idDis=$row["IdDis"];
        $idNodTer=$row["IdNodTer"];
        $nomDis=$row["NomDis"];
        $canSenNodTer=$row["CanSenNodTer"];

        $sql2 = "SELECT BatHisNodTer, RssiHisNodTer, TemHisNodTer, IroHisNodTer1, IroHisNodTer2, IroHisNodTer3, IroHisNodTer4 FROM historialnodoterminal WHERE IdNodTer='".$idNodTer."' ORDER BY FecHisNodTer DESC, TieHisNodTer DESC LIMIT 1";
		$result2 = $conexion->query($sql2);

		if ($result2->num_rows > 0) 
		{
		    while($row2 = $result2->fetch_assoc()) 
		    {
		        $batHisNodTer=$row2["BatHisNodTer"];
		        $rssiHisNodTer=$row2["RssiHisNodTer"];
		        $temHisNodTer=$row2["TemHisNodTer"];
		        $batHisNodTer = $batHisNodTer/1000;
		        $batHisNodTer = round($batHisNodTer, 1);

		        $iroHisNodTer = 0;
$canSenNodTer=3;
		        for($j=1; $j<=$canSenNodTer; $j++)
		        {
		        	$iroHisNodTer = $iroHisNodTer + $row2["IroHisNodTer".$j];
		        }
		        $iroHisNodTer = round($iroHisNodTer/$canSenNodTer);
		    }
		}

		echo '<div class=rectanguloValvulas>';
			echo '<div id=rectanguloSensor'.$idNodTer.' class="sensorRect"
				onclick="clickSensorMapa('.$idDis.')">';	
					
				echo '<div class=textoSuperior><span>S'.$i.'</span></div>' ;

				echo '<div class=rectMedio><span>'.$nomDis.'</span><p></p></div>' ;
				echo '<div class=texto3er><span>'.$temHisNodTer.'ºC</span></div>' ;
				echo '<div class=texto4to><span>'.$iroHisNodTer.'CB</span></div>' ;
				echo '<div class=textoInferior><span>'.$batHisNodTer.'V / '.$rssiHisNodTer.'dbm</span></div>';

			echo '</div>';
		echo '</div>';
		$i++;
    }
}
$conexion->close();
?>