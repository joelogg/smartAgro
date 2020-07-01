<?php
include ("../../partes/conexion.php");
$idNodRut = $_GET['idNR'];

$sql2 = "SELECT dispositivos.IdDis, NomDis, HEX(DirFisDis) AS DirFisDis, CanValNodRut FROM dispositivos, nodoruteador WHERE dispositivos.IdDis=nodoruteador.IdDis AND dispositivos.IdDis='".$idNodRut."'";
$result2 = $conexion->query($sql2);

if ($result2->num_rows > 0) 
{
    while($row2 = $result2->fetch_assoc()) 
    {
        $nomNodRut=$row2["NomDis"];
        $dirFisNodRut=$row2["DirFisDis"];
        $canValNodRut=$row2["CanValNodRut"];
    }
}

echo '<p class="franja" style="text-align: center;">NODO RUTEADOR: '.$nomNodRut.'</p>';
echo '<div id="botonesPropiedades">';
echo    '<button id="botonEditar" onclick="editarCambioNR()" ><span id="icoEditar"></span><span class="letraBotonesP">Editar</span></button>';
echo    '<button id="botonGuardar" onclick="guardarCambioNR('.$idNodRut.')"><span id="icoGuardar"></span><span class="letraBotonesP">Guardar</span></button>';
echo    '<button id="botonCancelar" onclick="getRuteadores()"><span id="icoCancelar"></span><span class="letraBotonesP">Cancelar</span></button>';
echo '</div>';

echo '<p class="franja">Propiedades</p>';
echo '<div id="infoDispositivo">';
?>
<form>
    <table id="tablaFormulario">
        <tr>
            <td>Nombre: </td>
            <td><input type="text" id="nomNodRut" value=<?php echo "'".$nomNodRut."'";?> disabled></td>
        </tr>
        <tr>
            <td>Dirección Física: </td>
            <td><input type="text" id="dirFisNodRut" value=<?php echo "'".$dirFisNodRut."'";?> disabled></input></td>
        </tr>
        <tr>
            <td>Cantidad de máxima de valvulas: </td>
            <td><input type="text" id="canValNodRut" value=<?php echo "'".$canValNodRut."'";?> disabled></input></td>
        </tr>
    </table>

</form>
<?php
echo '<p class="franja"></p>';
echo "</div>";
$conexion->close();
?>