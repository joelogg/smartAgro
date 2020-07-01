<?php ob_start(); ?>
<?php
$idNodTer = $_GET['idNodTer'];
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
            <h1>Sensor</h1>
        </td>
    </tr>
    <tr>
        <td class="espaciado" colspan="2"></td>
    </tr>
    <tr>
<?php

$sql = "SELECT IdNodRutNodTer, IdCamNodTer, NomCam, DirFisNodTer, BatNodTer, 
    PotNodTer, EstNodTer, CanSenNodTer, HumNodTer1, HumNodTer2, HumNodTer3, HumNodTer4
    FROM nodoterminal, campo  WHERE IdCam=IdCamNodTer AND IdNodTer='".$idNodTer."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $idNodRutNodTer=$row["IdNodRutNodTer"];
        $idCamNodTer=$row["IdCamNodTer"];
        $nomCam=$row["NomCam"];
        $dirFisNodTer=$row["DirFisNodTer"];

        $batNodTer=$row["BatNodTer"];
        $potNodTer=$row["PotNodTer"];
        $estNodTer=$row["EstNodTer"];
        $canSenNodTer=$row["CanSenNodTer"];        
?>         
        <td>
            <table class="tablaInformacion">
<?php
                echo '<tr>';
                echo '<th>Dirección Física:</th><td>'.$dirFisNodTer.'</td>';
                echo '</tr>';

                echo '<tr>';
                echo '<th>Batería:</th><td>'.$batNodTer.'</td>';
                echo '</tr>';

                echo '<tr>';
                echo '<th>Potencia:</th><td>'.$potNodTer.'</td>';
                echo '</tr>';  

                echo '<tr>';
                echo '<th>Campo:</th><td>'.$nomCam.'</td>';
                echo '</tr>'; 

                echo '<tr>';
                echo '<th>Ruteador:</th><td>'.$idNodRutNodTer.'</td>';
                echo '</tr>';   

?>
            </table>
        </td>
        <td>
            <table class="tablaInformacion">
<?php
                echo '<tr>';
                echo '<th>Cantidad de puntos:</th><td>'.$canSenNodTer.'</td>';
                echo '</tr>';

        for ($i=0; $i < $canSenNodTer; $i++) 
        { 
            $humNodTer=$row["HumNodTer".($i+1)];

                echo '<tr>';
                echo '<th>Humedad punto '.($i+1).':</th><td>'.$humNodTer.'</td>';
                echo '</tr>';
        }
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
$canvas->image('imgSensorPDF.jpg','jpg',60, 280, 495, 300);
$canvas->line(50,715,560,715,array(0.5,0.5,0.5),1);//linea inferior
$canvas->image('../../img/logo.jpg','jpg',440, 720, 120, 40);




$canvas->close_object();
$canvas->add_object($footer, "all");


$pdf = $dompdf->output();
$filename = "Sensor".time().'.pdf';
//file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>