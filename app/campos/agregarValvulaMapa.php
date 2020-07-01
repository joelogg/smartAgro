<?php

include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];


    echo '<table class="tablaInformativa">';

    echo '<tr>';
    echo '<th ondblclick="mostrarUnCampo('.$idCam.'), cerrarPopUp()">Campo</th>';

    echo    '<th></th>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>Elija una Valvula:</td><td><select id="valvulasDisponibles">';

        echo '<option value="-1"><span>Elija una Valvula</span></option>';

$sql = "SELECT Idval, NomVal FROM valvula WHERE UsaVal=0";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $idval=$row["Idval"];
        $nomVal=$row["NomVal"];
        echo '<option value="'.$idval.'">'.$nomVal.'</option>';
    }
}
    echo '</select></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td></td>';
    echo '<td><button onclick="relacionarValvulaCampo('.$idCam.')" style="margin-right:50px;">Aceptar</button>
    <button onclick="clickCampoMapa('.$idCam.')" >Cancelar</button></td>';    
    echo '</tr>';

    echo '<tr>';
    echo '<td></td>';
    echo '<td><span id="sinSeleccionValvula" style="color: red;"></span><br><br><br><br><br><br><br><br></td>';
    echo '</tr>';            
        
    echo '</table>';
    
$conexion->close();                                     
?>