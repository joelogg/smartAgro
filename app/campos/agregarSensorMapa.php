<?php

include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];


	echo '<table class="tablaInformativa">';

    echo '<tr>';
	echo '<th ondblclick="mostrarUnCampo('.$idCam.'), cerrarPopUp()">Campo</th>';

    echo    '<th></th>';
    echo '</tr>';

	echo '<tr>';
	echo '<td>Elija un Sensor:</td><td><select id="sensoresDisponibles">';

        echo '<option value="-1"><span>Elija un Sensor</span></option>';

$sql = "SELECT IdNodTer, NomDis FROM dispositivos, nodoterminal WHERE dispositivos.IdDis=nodoterminal.IdDis AND TipDis=10 AND UsaNodTer=0";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $idNodTer=$row["IdNodTer"];
        $nomDis=$row["NomDis"];
        echo '<option value="'.$idNodTer.'">'.$nomDis.'</option>';
    }
}
    echo '</select></td>';
	echo '</tr>';

    echo '<tr>';
    echo '<td></td>';
    echo '<td><button onclick="relacionarSensorCampo('.$idCam.')" style="margin-right:50px;">Aceptar</button>
    <button onclick="clickCampoMapa('.$idCam.')" >Cancelar</button></td>';    
    echo '</tr>';

    echo '<tr>';
    echo '<td></td>';
    echo '<td><span id="sinSeleccionSensor" style="color: red;"></span><br><br><br><br><br><br><br><br></td>';
    echo '</tr>';            
        
	echo '</table>';
	
$conexion->close();		    			        		
?>