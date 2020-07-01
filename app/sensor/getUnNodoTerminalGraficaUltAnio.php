<?php
include ("../../partes/conexion.php");


//Este archivo nos da la grafica del dia actual
    $idDis = $_GET['idDis'];

    $datosHoras = "";
    
    $fechaActual = date("Y")."-".date("m")."-".date("d");//aaaa-mm-dd
    $horaActual = (date("H")).":".date("i").":".date("s");//hh-mm-ss

    $nuevafecha = strtotime ( '-1 year' , strtotime ( $fechaActual ) ) ;
    $nuevafecha = date ( 'Y-m-d' , $nuevafecha );


    $canSenNodTer="";
    $sql = "SELECT IdNodTer, CanSenNodTer FROM nodoterminal, dispositivos WHERE nodoterminal.IdDis=dispositivos.IdDis AND dispositivos.IdDis='".$idDis."'";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {   
            $canSenNodTer = $row['CanSenNodTer'];
            $idNodTer = $row['IdNodTer'];
        }
    }


    $sql = "SELECT COUNT(*) AS cantDatos FROM historialnodoterminal WHERE IdNodTer='".$idNodTer."' 
        AND '".$fechaActual."'>=FecHisNodTer AND FecHisNodTer>='".$nuevafecha."' 
        ORDER BY FecHisNodTer DESC, TieHisNodTer DESC";

    
    $cantDatos="";
    $cociente = "";

    $result = $conexion->query($sql);

    $i=0;
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {  
            $cantDatos = $row['cantDatos'];
        }
    }

    $sql = "SELECT FecHisNodTer, TieHisNodTer, IroHisNodTer1, IroHisNodTer2, 
        IroHisNodTer3, IroHisNodTer4 FROM historialnodoterminal WHERE  IdNodTer='".$idNodTer."'
        AND '".$fechaActual."'>=FecHisNodTer AND FecHisNodTer>='".$nuevafecha."' 
        ORDER BY FecHisNodTer DESC, TieHisNodTer DESC";

    $datosIrometro1="";
    $datosIrometro2="";
    $datosIrometro3="";
    $datosIrometro4="";

    $irometro1Aux = 0;
    $irometro2Aux = 0;
    $irometro3Aux = 0;
    $irometro4Aux = 0;

    $result = $conexion->query($sql);

    $j=1;
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {   
            $tieHisNodTer = $row['TieHisNodTer'];
            $fecHisNodTer = $row['FecHisNodTer'];
            //$tieHisNodTer = substr($tieHisNodTer, 0, 5);                

            $irometro1 = $row['IroHisNodTer1'];
            $irometro2 = $row['IroHisNodTer2'];
            $irometro3 = $row['IroHisNodTer3'];
            $irometro4 = $row['IroHisNodTer4'];
        
            $datosHoras = $fecHisNodTer. ",". $tieHisNodTer. "&" . $datosHoras;
            $datosIrometro1 = $irometro1. ",". $datosIrometro1 ;
            $datosIrometro2 = $irometro2. "," . $datosIrometro2;
            $datosIrometro3 = $irometro3. ",". $datosIrometro3 ;
            $datosIrometro4 = $irometro4. "," . $datosIrometro4;
            $j++;                
        }
         
    }
   
    

    $datosHoras = substr($datosHoras, 0, -1);
    $datosIrometro1 = substr($datosIrometro1, 0, -1);
    $datosIrometro2 = substr($datosIrometro2, 0, -1);
    $datosIrometro3 = substr($datosIrometro3, 0, -1);
    $datosIrometro4 = substr($datosIrometro4, 0, -1);


    $sql = "SELECT IdCam FROM camponodoterminal WHERE IdNodTer='".$idNodTer."'";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {   
            $idCam = $row['IdCam'];
        }
    }

    $datosValvula = "";
    $sql = "SELECT IdVal FROM campovalvula WHERE IdCam='".$idCam."'";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {   
            $idVal = $row['IdVal'];
            $sql2 = "SELECT TieIniHisVal, FecIniHisVal, TieFinHisVal, FecFinHisVal FROM historialvalvula WHERE IdVal='".$idVal."' AND '".$fechaActual."'>=FecIniHisVal AND FecIniHisVal>='".$nuevafecha."'";

            $result2 = $conexion->query($sql2);

            if ($result2->num_rows > 0) 
            {
                while($row2 = $result2->fetch_assoc()) 
                { 
                    $fecIniHisVal = $row2['FecIniHisVal'];
                    $tieIniHisVal = $row2['TieIniHisVal'];
                    $fecFinHisVal = $row2['FecFinHisVal'];
                    $tieFinHisVal = $row2['TieFinHisVal'];
                    
                    $datosValvula = $fecIniHisVal.",".$tieIniHisVal. "&" .$fecFinHisVal. ",".$tieFinHisVal. "&" .$datosValvula;
                }
            }
        }
    }


    //$datosValvula = "2016-10-21,09:25:00&2016-10-21,09:29:00&2016-10-21,10:43:00&2016-10-21,10:53:00";

    $respuestaGrafica =  $canSenNodTer."%".$datosHoras."%".$datosIrometro1."%".
            $datosIrometro2."%".$datosIrometro3."%".$datosIrometro4."%".$datosValvula."%";

    echo $respuestaGrafica;

$conexion->close();
?>