<?php
include ("../../partes/conexion.php");
?>
<!DOCTYPE html>
<html style="background-color: #EEE;">
<head>
    <meta charset="UTF-8">
    <title>PDF</title>
    <link rel="stylesheet" type="text/css" href="estiloPDFSimple.css">  
</head>
<body style="width: 700px; margin-top:30px;">
    <p style="position: absolute; top:0px; left: 20px; color: blue">Vista Previa:</p>
    <p onclick="window.close()" style="position: absolute; top:0px; left: 700px; 
        cursor: pointer; color: blue">Cerrar</p>

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
$idNodTer = $idComponente;

$sql = "SELECT IdNodRutNodTer, IdCamNodTer, NomCam, DirLogNodTer, BatNodTer, 
    TxPowNodTer, EstNodTer, CanSenNodTer, HumNodTer1, HumNodTer2, HumNodTer3, HumNodTer4
    FROM nodoterminal, campo  WHERE IdCam=IdCamNodTer AND IdNodTer='".$idNodTer."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $idNodRutNodTer=$row["IdNodRutNodTer"];
        $idCamNodTer=$row["IdCamNodTer"];
        $nomCam=$row["NomCam"];
        $dirFisNodTer=$row["DirLogNodTer"];

        $batNodTer=$row["BatNodTer"];
        $potNodTer=$row["TxPowNodTer"];
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
    <tr>
        <td class="espaciado" colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2" class="alinearCentro">
             <img id="grafica" src="imgSensorPDF.jpg">
        </td>
    </tr>
    <tr>
        <td class="espaciado" colspan="2"></td>
    </tr>
    <tr>
        <td class="alinearDerecha sobreRayado" colspan="2">
            <img class="logo" src="../../img/logo.jpg">
        </td>
    </tr>
    </table>    
    <?php
    echo '<p><a href="PDFgetUnNodoTerminalGrafica.php?idNodTer='.$idNodTer.'">Descargar PDF</a></p>';
    ?>
</body>
</html>
