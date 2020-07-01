<?php
include ("../../partes/conexion.php");
$idCul = $_GET['idCul'];

$sql2 = "SELECT NomCul, HumMaxCul, HumMinCul FROM cultivo WHERE IdCul='".$idCul."'";
$result2 = $conexion->query($sql2);

if ($result2->num_rows > 0) 
{
    while($row2 = $result2->fetch_assoc()) 
    {
        $nomCul=$row2["NomCul"];
        $humMinCul=$row2["HumMinCul"];
        $humMaxCul=$row2["HumMaxCul"];        
    }
}

echo '<p class="franja" style="text-align: center;">Cultivo: '.$nomCul.'</p>';
echo '<div id="botonesPropiedades">';
echo    '<button id="botonEditar" onclick="editarCambioCul()" ><span id="icoEditar"></span><span class="letraBotonesP">Editar</span></button>';
echo    '<button id="botonGuardar" onclick="guardarCambioCul('.$idCul.')"><span id="icoGuardar"></span><span class="letraBotonesP">Guardar</span></button>';
echo    '<button id="botonCancelar" onclick="getCultivos()"><span id="icoCancelar"></span><span class="letraBotonesP">Cancelar</span></button>';
echo '</div>';

echo '<p class="franja">Propiedades</p>';
echo '<div id="infoDispositivo">';
?>
<form>
    <table id="tablaFormulario">
        <tr>
            <td>Nombre: </td>
            <td><input type="text" id="nomCul" value=<?php echo "'".$nomCul."'";?> disabled></td>
        </tr>
        <tr>
            <td>Humedad Mínima: </td>
            <td><input type="number" id="humMinCul" value=<?php echo "'".$humMinCul."'";?> disabled></input></td>
        </tr>
        <tr>
            <td>Humedad Máxima: </td>
            <td><input type="number" id="humMaxCul" value=<?php echo "'".$humMaxCul."'";?> disabled></input></td>
        </tr>
<?php
    $sql2 = "SELECT COUNT(*) AS cantidad FROM cultivonutrientes, nutrientes WHERE cultivonutrientes.IdNut=nutrientes.IdNut AND cultivonutrientes.IdCul='".$idCul."'";
    $result2 = $conexion->query($sql2);

    if ($result2->num_rows > 0) 
    {
        while($row2 = $result2->fetch_assoc()) 
        {
            $cantidad = $row2["cantidad"];
        }
    }
?>
        <tr>
            <td>Nutrientes: </td>

<?php
    $sql2 = "SELECT nutrientes.IdNut, DesNut FROM cultivonutrientes, nutrientes WHERE cultivonutrientes.IdNut=nutrientes.IdNut AND cultivonutrientes.IdCul='".$idCul."'";
    $result2 = $conexion->query($sql2);

    if ($result2->num_rows > 0) 
    {
        $entroPrimeraVez = false;
        while($row2 = $result2->fetch_assoc()) 
        {
            $nutriente = $row2["DesNut"];
            $idNut = $row2["IdNut"];
            if($entroPrimeraVez)
            {
                echo '<tr>';
                echo '<td></td>';
                echo '<td><input type="text" id="idNut'.$idNut.'" value="'.$nutriente.'" disabled></input>
                    <button type="button" class="botonEliNut" onclick="eliminarN('.$idNut.')" disabled>Eliminar</button></td>';
                echo '</tr>';
            }

            else
            {
                echo '<td><input type="text" id="idNut'.$idNut.'" value="'.$nutriente.'" disabled></input>
                    <button type="button" class="botonEliNut" onclick="eliminarN('.$idNut.')" disabled>Eliminar</button></td>';
                echo '</tr>';
                $entroPrimeraVez = true;
            }
        }
    }
    else
    {
        echo '<td><input type="text" value=" -" disabled></input></td>';
        echo '</tr>';
    }
?>

    </table>

    <p class="franja" id="franjaAux"></p>
    <p class="franja" id="franjaReal" onclick="agregarCeldaUnNutriente()" style="visibility: hidden;">tareas</p>

    <table id="tablaFormularioAumentar">
    </table>
</form>

<?php



echo "</div>";
$conexion->close();
?>
