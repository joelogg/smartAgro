<?php
include ("../../partes/conexion.php");
$idVal = $_GET['idVal'];

$sql3 = "UPDATE valvula SET CambVal=0 WHERE IdVal='".$idVal."'";

if ($conexion->query($sql3) === TRUE) 
{
    $sql = "SELECT IdVal, dispositivos.IdDis, nodoruteador.IdNodRut, NomVal, EstVal, AccVal FROM valvula, nodoruteador, dispositivos WHERE valvula.IdNodRut=nodoruteador.IdNodRut AND nodoruteador.IdDis=dispositivos.IdDis AND valvula.IdVal='".$idVal."'";
	$result = $conexion->query($sql);

	if ($result->num_rows > 0) 
	{
	    while($row = $result->fetch_assoc()) 
	    {
	        $idVal=$row["IdVal"];
	        $idDis=$row["IdDis"];
	        $idNodRut=$row["IdNodRut"];
	        $nomVal=$row["NomVal"];
	        $estVal=$row["EstVal"];
	        $accVal=$row["AccVal"];

	        $sql2 = "SELECT BatHisNodRut, RssiHisNodRut FROM historialnodoruteador WHERE IdNodRut='".$idNodRut."' ORDER BY FecHisNodRut DESC, TieHisNodRut DESC LIMIT 1";
			$result2 = $conexion->query($sql2);

			if ($result2->num_rows > 0) 
			{
			    while($row2 = $result2->fetch_assoc()) 
			    {
			        $batHisNodRut=$row2["BatHisNodRut"];
			        $rssiHisNodRut=$row2["RssiHisNodRut"];
			        $batHisNodRut = $batHisNodRut/1000;
			        $batHisNodRut = round($batHisNodRut, 1);
			    }
			}

			

			if($estVal==1)//valvula abierta
			{
				echo '<div id=rectanguloValvula'.$idVal.' class="valvulaRectAbierto">';	
			}
			else//valvula cerrada
			{
				echo '<div id=rectanguloValvula'.$idVal.' class="valvulaRectCerrada">';	
			}	

				if($estVal==1) //On activo
				{
					echo '<button class="rectOn" onclick="abrirValvula('.$idVal.')">ON<span id="on'.$idVal.'" class="botonAccionado" style="background-color: #0F0;"></span></button>' ;
				}
				else //On no activo
				{
					echo '<button class="rectOn" onclick="abrirValvula('.$idVal.')"">ON<span id="on'.$idVal.'" class="botonAccionado"></span></button>' ;
				}
					echo '<div class="rectMedio"><span>'.$nomVal .'</span></div>' ;
				if($estVal==1) //OFF no activo
				{
					echo '<button class="rectOff" onclick="cerrarValvula('.$idVal.')">OFF<span id="off'.$idVal.'" class="botonAccionado"></button>' ;
				}
				else //OFF activo
				{
					echo '<button class="rectOff" onclick="cerrarValvula('.$idVal.')">OFF<span id="off'.$idVal.'" class="botonAccionado" style="background-color: #F00;"></button>' ;
				}
					echo '<div class="textoInferior"><span>'.$batHisNodRut.'V / '.$rssiHisNodRut.'dbm</span></div>';

				echo '</div>';

	    }
	}
} 

$conexion->close();
?>