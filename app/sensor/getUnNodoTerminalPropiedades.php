<?php
include ("../../partes/conexion.php");
$idNodTer = $_GET['idNodTer'];
$sql2 = "SELECT HEX(DirFisNodTer) AS DirFisNodTer2 FROM nodoterminal  WHERE IdNodTer='".$idNodTer."'";
$result2 = $conexion->query($sql2);

if ($result2->num_rows > 0) 
{
    while($row2 = $result2->fetch_assoc()) 
    {
        $dirFisNodTer=$row2["DirFisNodTer2"];
    }
}

echo '<p class="franja" style="text-align: center;">Sensor: '.$dirFisNodTer.'</p>';
echo '<div id="botonesPropiedades">';
echo    '<button id="botonEditar" onclick="editarNodTer()"><span id="icoEditar"></span><span class="letraBotonesP">Editar</span></button>';
echo    '<button id="botonGuardar" onclick="guardarCambioNodTer('.$idNodTer.')"><span id="icoGuardar"></span><span class="letraBotonesP">Guardar</span></button>';
echo    '<button id="botonEliminar" onclick="eliminarNodTer('.$idNodTer.')"><span id="icoEliminar"></span><span class="letraBotonesP">Eliminar</span></button>';
echo '</div>';

echo '<p class="franja">Propiedades</p>';
echo '<div id="infoDispositivo">';
echo '<form action="#"><table id="tablaFormulario">';

$sql = "SELECT IdNodRutNodTer, IdCamNodTer, NomNodTer, NomCam, HEX(DirFisNodTer) AS DirFisNodTer2, RssiNodTer, BatNodTer, CeNodTer, TemExtNodTer, TemNodTer, RssiInNodTer, TxPowNodTer, EstNodTer, CanSenNodTer, HumNodTer1, HumNodTer2, HumNodTer3, HumNodTer4
    FROM nodoterminal, campo  WHERE IdCam=IdCamNodTer AND IdNodTer='".$idNodTer."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{



        $idNodRutNodTer=$row["IdNodRutNodTer"];
        $idCamNodTer=$row["IdCamNodTer"];
        $nomCam=$row["NomCam"];
        $nomNodTer=$row["NomNodTer"];
        $dirFisNodTer=$row["DirFisNodTer2"];

        $rssiNodTer=$row["RssiNodTer"];
        $batNodTer=$row["BatNodTer"];
        $ceNodTer=$row["CeNodTer"];
        $temExtNodTer=$row["TemExtNodTer"];
        $temNodTer=$row["TemNodTer"];
        $rssiInNodTer=$row["RssiInNodTer"];
        $potNodTer=$row["TxPowNodTer"];

        $estNodTer=$row["EstNodTer"];
        $canSenNodTer=$row["CanSenNodTer"];        
        

        echo '<tr>';
        echo '<td>Sensor:</td><td><input type="text"  id="nomNodTer" value="'.$nomNodTer.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Dirección Física:</td><td><input type="text"  id="dirFisNodTer" value="'.$dirFisNodTer.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Rssi:</td><td><input type="text" value="'.$rssiNodTer.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Batería:</td><td><input type="text" value="'.$batNodTer.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Ce:</td><td><input type="text" value="'.$ceNodTer.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Temperatura Externa:</td><td><input type="text" value="'.$temExtNodTer.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Temperatura:</td><td><input type="text" value="'.$temNodTer.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Rssi Interno:</td><td><input type="text" value="'.$rssiInNodTer.'" disabled></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Potencia:</td><td><input type="text" value="'.$potNodTer.'" disabled></td>';
        echo '</tr>';


?>
 <tr>
            <td>Campo: </td>
            <td><select id="idCam" disabled>
<?php
            echo '<option value="'.$idCamNodTer.'">'.$nomCam.'</option>';

            $sql2 = "SELECT IdCam, NomCam FROM campo";
            $result2 = $conexion->query($sql2);

            if ($result2->num_rows > 0) 
            {
                while($row2 = $result2->fetch_assoc()) 
                {                    
                    $idCam=$row2["IdCam"];
                    $nomCam=$row2["NomCam"];

                    if($idCamNodTer!=$idCam)
                    {
                        echo '<option value="'.$idCam.'">'.$nomCam.'</option>';
                    }                    
                }
            }
?>
            </select>
            </td>
        </tr>

        <tr>
            <td>Ruteador: </td>
            <td><select id="idNodRut" disabled>
<?php
            echo '<option value="'.$idNodRutNodTer.'">'.$idNodRutNodTer.'</option>';

            $sql2 = "SELECT IdNodRut FROM nodoruteador";
            $result2 = $conexion->query($sql2);

            if ($result2->num_rows > 0) 
            {
                while($row2 = $result2->fetch_assoc()) 
                {                    
                    $idNodRut=$row2["IdNodRut"];

                    if($idNodRutNodTer!=$idNodRut)
                    {
                        echo '<option value="'.$idNodRut.'">'.$idNodRut.'</option>';
                    }                    
                }
            }
?>
            </select>
            </td>
        </tr>
<?php


        echo '<tr>';
        echo '<td>Cantidad de puntos:</td><td><input type="number" id="canSen" value="'.$canSenNodTer.'" min="1" max="4" disabled></td>';
        echo '</tr>';



        for ($i=0; $i < $canSenNodTer; $i++) 
        { 
            $humNodTer=$row["HumNodTer".($i+1)];

            echo '<tr>';
            echo '<td>Humedad punto '.($i+1).':</td><td><input type="text" value="'.$humNodTer.'" disabled></td>';
            echo '</tr>';
        }
    }
} 
echo '</table>';

echo '</form>';
echo '<p class="franja"></p>';
echo "</div>";
$conexion->close();
?>
