<?php
include ("../../partes/conexion.php");


//Este archivo nos da la grafica del dia actual
    $idNodTer = $_GET['idNodTer'];

    $datosHoras = "";
    
    $fechaActual = date("Y")."-".date("m")."-".date("d");//aaaa-mm-dd
    $horaActual = (date("H")).":".date("i").":".date("s");//hh-mm-ss

    $nuevafecha = strtotime ( '-1 month' , strtotime ( $fechaActual ) ) ;
    $nuevafecha = date ( 'Y-m-d' , $nuevafecha );


    $canSenNodTer="";
    $sql = "SELECT CanSenNodTer FROM nodoterminal WHERE 
        IdNodTer='".$idNodTer."'";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {   
            $canSenNodTer = $row['CanSenNodTer'];
        }
    }


    $sql = "SELECT COUNT(*) AS cantDatos FROM historialnodoterminal, nodoterminal 
        WHERE IdNodTerHistNodTer=IdNodTer AND IdNodTerHistNodTer='".$idNodTer."'
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

    $sql = "SELECT FecHisNodTer, TieHisNodTer, HumHisNodTer1, HumHisNodTer2, 
        HumHisNodTer3, HumHisNodTer4 FROM historialnodoterminal, nodoterminal 
        WHERE IdNodTerHistNodTer=IdNodTer AND IdNodTerHistNodTer='".$idNodTer."'
        AND '".$fechaActual."'>=FecHisNodTer AND FecHisNodTer>='".$nuevafecha."' 
        ORDER BY FecHisNodTer DESC, TieHisNodTer DESC";

    $datoshumedad1="";
    $datoshumedad2="";
    $datoshumedad3="";
    $datoshumedad4="";

    $humedad1Aux = 0;
    $humedad2Aux = 0;
    $humedad3Aux = 0;
    $humedad4Aux = 0;

    $result = $conexion->query($sql);

    $i=1;
    $j=1;
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {   
            $tieHisNodTer = $row['TieHisNodTer'];
            $fecHisNodTer = $row['FecHisNodTer'];
            $tieHisNodTer = substr($tieHisNodTer, 0, 5);                

            $humedad1 = $row['HumHisNodTer1'];
            $humedad2 = $row['HumHisNodTer2'];
            $humedad3 = $row['HumHisNodTer3'];
            $humedad4 = $row['HumHisNodTer4'];
        
            if($cantDatos<=70)
            {        

                $datosHoras = $fecHisNodTer. " " .$tieHisNodTer. ",". $datosHoras;
                $datoshumedad1 = $humedad1. ",". $datoshumedad1 ;
                $datoshumedad2 = $humedad2. "," . $datoshumedad2;
                $datoshumedad3 = $humedad3. ",". $datoshumedad3 ;
                $datoshumedad4 = $humedad4. "," . $datoshumedad4;
                $j++;                
            }
            else
            {
                $cociente = floor($cantDatos/70);

                if(($i%$cociente)==0)
                {
                    $datosHoras = $fecHisNodTer. " " .$tieHisNodTer. ",". $datosHoras;

                    $humedad1Aux += $humedad1 ;
                    $humedad2Aux += $humedad2 ;
                    $humedad3Aux += $humedad3 ;
                    $humedad4Aux += $humedad4 ;

                    $humedad1Aux /= $cociente ;
                    $humedad2Aux /= $cociente ;
                    $humedad3Aux /= $cociente ;
                    $humedad4Aux /= $cociente ;

                    $datoshumedad1 = $humedad1Aux. ",". $datoshumedad1 ;
                    $datoshumedad2 = $humedad2Aux. "," . $datoshumedad2;
                    $datoshumedad3 = $humedad3Aux. ",". $datoshumedad3 ;
                    $datoshumedad4 = $humedad4Aux. "," . $datoshumedad4;

                    $humedad1Aux = 0;
                    $humedad2Aux = 0;
                    $humedad3Aux = 0;
                    $humedad4Aux = 0;
                    $j++;
                }
                else
                {
                    $humedad1Aux += $humedad1 ;
                    $humedad2Aux += $humedad2 ;
                    $humedad3Aux += $humedad3 ;
                    $humedad4Aux += $humedad4 ;
                }

                

            }
            $i++;
        }
         
    }
   
    

    $datosHoras = substr($datosHoras, 0, -1);
    $datoshumedad1 = substr($datoshumedad1, 0, -1);
    $datoshumedad2 = substr($datoshumedad2, 0, -1);
    $datoshumedad3 = substr($datoshumedad3, 0, -1);
    $datoshumedad4 = substr($datoshumedad4, 0, -1);


    $respuestaGrafica =  $canSenNodTer."%".$datosHoras."%".$datoshumedad1."%".
            $datoshumedad2."%".$datoshumedad3."%".$datoshumedad4."%fin".$cantDatos."-".$j;

    echo $respuestaGrafica;

$conexion->close();
?>