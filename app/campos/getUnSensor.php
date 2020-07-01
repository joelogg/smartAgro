<?php
$idNodTer = $_GET['idNodTer'];


include ("../../partes/conexion.php");
			
echo '<table class="tablaInformativa">';

$sql3 = "SELECT HEX(DirFisDis) AS DirFisDis, BatHisNodTer, 
	    TemHisNodTer, CanSenNodTer, IroHisNodTer1, IroHisNodTer2, IroHisNodTer3, IroHisNodTer4
	    FROM nodoterminal, dispositivos, historialnodoterminal WHERE  dispositivos.IdDis=nodoterminal.IdDis AND dispositivos.IdDis='".$idNodTer."' ORDER BY FecHisNodTer DESC, TieHisNodTer DESC  LIMIT 1";
$result3 = $conexion->query($sql3);

if ($result3->num_rows > 0) 
{
	while($row3 = $result3->fetch_assoc()) 
	{
        $nomCam="";//
        $dirFisNodTer=$row3["DirFisDis"];

        $batNodTer=$row3["BatHisNodTer"];
        $temNodTer=$row3["TemHisNodTer"];

        $canSenNodTer=$row3["CanSenNodTer"]; 								        

        echo '<tr>';
        echo '<th colspan="2" ondblclick="mostrarUnNodoTerminal('.$idNodTer.'), cerrarPopUp()" >Sensor</th>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Campo:</td><td>'.$nomCam.'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Dirección Física:</td><td>'.$dirFisNodTer.'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Batería:</td><td>'.$batNodTer.'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Temperatura:</td><td>'.$temNodTer.'</td>';
        echo '</tr>';

        for ($i=0; $i < $canSenNodTer; $i++) 
        { 
        	$humNodTer=$row3["IroHisNodTer".($i+1)];

        	echo '<tr>';
        	echo '<td>Humedad punto '.($i+1).':</td><td>'.$humNodTer.'</td>';
        	echo '</tr>';
        }								        
    }
    echo '<tr style="background:#f2f2f2;">';
    echo '<td colspan="2" style=""padding:0;>';
?>

	<span id="unidadMedida">(Sequedad)</span>
	<div id="tituloGrafica" ></div>
	<div id="contenedorGrafico" style="width:680px; height: 300px; border:1px solid #F0F0F0; ">

        <canvas id="miCanvasGrafico" width="200" height="300" style="border-left:1px solid red; border-bottom: 1px solid red; margin-left: 50px; position: absolute; z-index: 1;">
        </canvas>
        <canvas id="miCanvasTexto" width="200" height="300" style="background: #F0F0F0; position: absolute; z-index: 0;">
        </canvas>
	</div>
	<span id="unidadMedidaAbajo">(Horas)</span>   




<?php
    echo '</td>';
    echo '</tr>';
} 
echo '</table>'; 		
?>