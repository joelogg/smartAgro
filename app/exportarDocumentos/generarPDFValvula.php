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
$idVal = $idComponente;

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
    <tr>
        <td class="espaciado" colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2" class="alinearCentro">
             <img id="grafica" src="imgValvulaPDF.jpg">
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
    echo '<p><a href="PDFgetUnaValvulaGrafica.php?idVal='.$idVal.'">Descargar PDF</a></p>';
    ?>
</body>
</html>
