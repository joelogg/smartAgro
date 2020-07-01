<?php
include ("../../partes/conexion.php");

    $idVal = $_GET['idVal'];

    $respuestaGrafica = "";
    //$datosHoras = "0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23%";
    $datosHoras = "";
    $datosEstadoValvula = "";
    
    $sql = "SELECT TieIniHisVal, FecIniHisVal, TieFinHisVal, FecFinHisVal 
        FROM historialvalvula WHERE EstHisVal=0 AND IdValHisVal='".$idVal."' 
        ORDER BY FecIniHisVal ASC, TieIniHisVal ASC";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {        
           $tiempoInicio = $row['TieIniHisVal'];
           $tiempoFin = $row['TieFinHisVal'];
           $fechaInicio = $row['FecIniHisVal'];
           $fechaFin = $row['FecFinHisVal'];

           /*$datosHoras = $datosHoras.$fechaInicio.$tiempoInicio.",";
           $datosHoras = $datosHoras.$fechaFin.$tiempoFin.",";*/

            $ini = substr($tiempoInicio, 0, 5);
            $fin = substr($tiempoFin, 0, 5);

            $ini2 = substr($tiempoInicio, 0, 2);
            $fin2 = substr($tiempoFin, 0, 2);

            $res = $fin2-$ini2;


           $datosHoras = $datosHoras.$ini."-".$fin."(".$fechaFin."),";
           

           $datosEstadoValvula = $datosEstadoValvula.$res.",";
        }
    }
    $datosHoras = substr($datosHoras, 0, -1);
    $datosEstadoValvula = substr($datosEstadoValvula, 0, -1);

    $respuestaGrafica = $respuestaGrafica.$datosHoras;
    $respuestaGrafica = $respuestaGrafica."%".$datosEstadoValvula."%fin";

    echo $respuestaGrafica;

$conexion->close();
?>