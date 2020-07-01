<?php ob_start(); ?>
<?php
$idVal = $_GET['idVal'];
include ("../../partes/conexion.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDF</title>
    <link rel="stylesheet" type="text/css" href="estiloPDFSimple.css">  
</head>
<body>
    <table class="tablaPDF">
    <tr>
        <td class="subRayado" colspan="2">
            <h1>Válvula</h1>
        </td>
    </tr>
    <tr>
        <td class="espaciado" colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2">
            <table class="tablaInformacionV">
<?php

$sql = "SELECT IdNodRutVal, IdCamVal, NomCam, NomVal, DirFisVal, EstVal, AccVal FROM valvula, campo 
WHERE IdCam=IdCamVal AND IdVal='".$idVal."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $idNodRutVal=$row["IdNodRutVal"];
        $idCamVal=$row["IdCamVal"];
        $nomCam=$row["NomCam"];
        $nomVal=$row["NomVal"];
        $dirFisVal=$row["DirFisVal"];
        $estVal=$row["EstVal"];
        $accVal=$row["AccVal"];  

        if($estVal==1)
        { 
            $estadoLetras="Abierta";
        }
        else
        {   
            $estadoLetras="Cerrada";
        }

        if($accVal==1)
        { 
            $accLetras="Abrir";
        }
        else
        {   
            $accLetras="Cerrar";
        }

                echo '<tr>';
                echo '<th>Valvula:</th><td>'.$nomVal.'</td>';
                echo '</tr>';

                echo '<tr>';
                echo '<th>Dirección Física:</th><td>'.$dirFisVal.'</td>';
                echo '</tr>'; 

                echo '<tr>';
                echo '<th>Campo:</th><td>'.$nomCam.'</td>';
                echo '</tr>';

                echo '<tr>';
                echo '<th>Ruteador:</th><td>'.$idNodRutVal.'</td>';
                echo '</tr>';

                echo '<tr>';
                echo '<th>Estado:</th><td>'.$estadoLetras.'</td>';
                echo '</tr>';

                echo '<tr>';
                echo '<th>Ultima acción emitida fue:</th><td>'.$accLetras.'</td>';
                echo '</tr>';       

        
    }
} 
$conexion->close();
?>
            </table>
        </td>
    </tr>


    </table>    
</body>
</html>
<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();

$canvas = $dompdf->get_canvas();
//For Footer
$footer = $canvas->open_object();
$canvas->image('imgValvulaPDF.jpg','jpg',60, 280, 495, 300);
$canvas->line(50,715,560,715,array(0.5,0.5,0.5),1);//linea inferior
$canvas->image('../../img/logo.jpg','jpg',440, 720, 120, 40);




$canvas->close_object();
$canvas->add_object($footer, "all");


$pdf = $dompdf->output();
$filename = "Valvula".time().'.pdf';
//file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>