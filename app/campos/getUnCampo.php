<?php

include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];
$sql = "SELECT cultivo.IdCul, NomCam, NomCul, HumMinCul, HumMaxCul, HumCam, ActCam FROM campo, cultivo WHERE campo.IdCul=cultivo.IdCul AND idCam='".$idCam."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $idCul=$row["IdCul"];
        $nomCam=$row["NomCam"];
        $nomCul=$row["NomCul"];
        $humMinCul=$row["HumMinCul"];
        $humMaxCul=$row["HumMaxCul"];
        $humCam=$row["HumCam"];
        $actCam=$row["ActCam"];
    }
}

	echo '<table class="tablaInformativa">';

    echo '<tr>';
	echo '<th ondblclick="mostrarUnCampo('.$idCam.'), cerrarPopUp()">Campo</th>';

    echo    '<th><button id="botonAgregar" onclick="agregarSensorMapa('.$idCam.')" style="float: right; margin-right:20px;"><span id="icoAgregar"></span><span class="letraBotonesP">Sensor</span></button>';
    echo    '<button id="botonAgregar" onclick="agregarValvulaMapa('.$idCam.')" style="float: right; right:0;"><span id="icoAgregar"></span><span class="letraBotonesP">Valvula</span></button></th>';
    echo '</tr>';

	echo '<tr>';
	echo '<td>Campo:</td><td>'.$nomCam.'</td>';
	echo '</tr>';

    echo '<tr>';
    echo '<td>Cultivo</td>';
    echo '<td>'.$nomCul.'</td>';
    echo '</tr>';



    // si es 1 campo con cultivo 
    if($actCam==1)
    {
        echo '<tr>';
        echo '<td>Humedad Mínima</td><td>'.$humMinCul.'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Humedad actual:</td><td>'.$humCam.'</td>';
        echo '</tr>';          

        echo '<tr>';
        echo '<td>Humedad Máxima</td><td>'.$humMaxCul.'</td>';
        echo '</tr>';            
    }
        

        

    $sql2 = "SELECT DesNut FROM cultivonutrientes, nutrientes WHERE cultivonutrientes.IdNut=nutrientes.IdNut AND cultivonutrientes.IdCul='".$idCul."'";
    $result2 = $conexion->query($sql2);

    $nutrientes="";
    if ($result2->num_rows > 0) 
    {
        while($row2 = $result2->fetch_assoc()) 
        {
            $nutrientes = $nutrientes.$row2["DesNut"]."\n";
        }
    }
    
    if($actCam==1)
    {
        echo '<tr>';
        echo '<td>Nutrientes</td><td>'.$nutrientes.'</td>';
        echo '</tr>';
    }   


    echo '<tr>';
    echo '<td style="font-weight:bold; text-decoration:underline">Valvulas</td><td></td>';
    echo '</tr>';
    $sql2 = "SELECT valvula.IdVal, NomVal FROM valvula, campovalvula WHERE valvula.IdVal=campovalvula.IdVal AND IdCam='".$idCam."'";
    $result2 = $conexion->query($sql2);

    if ($result2->num_rows > 0) 
    {
        while($row2 = $result2->fetch_assoc()) 
        {
            $idVal = $row2["IdVal"];
            $nomVal = $row2["NomVal"];
            echo '<tr>';
            echo '<td>'.$nomVal.'</td><td><button type="button" onclick=" quitarValvula('.$idCam.', '.$idVal.')">Eliminar Valvula</button></td>';
            echo '</tr>';
        }
    }  


    echo '<tr>';
    echo '<td style="font-weight:bold; text-decoration:underline">Sensores</td><td></td>';
    echo '</tr>';
    $sql2 = "SELECT nodoterminal.IdNodTer, NomDis FROM dispositivos, nodoterminal, camponodoterminal WHERE dispositivos.IdDis=nodoterminal.IdDis AND nodoterminal.IdNodTer=camponodoterminal.IdNodTer AND IdCam='".$idCam."'";
    $result2 = $conexion->query($sql2);

    if ($result2->num_rows > 0) 
    {
        while($row2 = $result2->fetch_assoc()) 
        {
            $idNodTer = $row2["IdNodTer"];
            $nomDis = $row2["NomDis"];
            echo '<tr>';
            echo '<td>'.$nomDis.'</td><td><button type="button" onclick=" quitarNodoTerrminal('.$idCam.', '.$idNodTer.')">Eliminar Sensor</button></td>';
            echo '</tr>';
        }
    }   
        
	echo '</table>';
    
$conexion->close();			    			        		
?>