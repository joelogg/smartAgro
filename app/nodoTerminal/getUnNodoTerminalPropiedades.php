<?php
include ("../../partes/conexion.php");
$idDis = $_GET['idNT'];

$sql2 = "SELECT IdNodTer, NomDis, HEX(DirFisDis) AS DirFisDis, CanSenNodTer FROM dispositivos, nodoterminal WHERE dispositivos.IdDis=nodoterminal.IdDis AND dispositivos.IdDis='".$idDis."'";
$result2 = $conexion->query($sql2);

if ($result2->num_rows > 0) 
{
    while($row2 = $result2->fetch_assoc()) 
    {
        $idNodTer=$row2["IdNodTer"];
        $nomNodTer=$row2["NomDis"];
        $dirFisNodTer=$row2["DirFisDis"];
        $canSenNodTer=$row2["CanSenNodTer"];
    }
}

echo '<p class="franja" style="text-align: center;">NODO TERMINAL: '.$nomNodTer.'</p>';
echo '<div id="botonesPropiedades">';
echo    '<button id="botonEditar" onclick="editarCambioNT()" ><span id="icoEditar"></span><span class="letraBotonesP">Editar</span></button>';
echo    '<button id="botonGuardar" onclick="guardarCambioNT('.$idNodTer.', '.$idDis.')"><span id="icoGuardar"></span><span class="letraBotonesP">Guardar</span></button>';
echo    '<button id="botonCancelar" onclick="mostrarUnNodoTerminal('.$idDis.')"><span id="icoCancelar"></span><span class="letraBotonesP">Cancelar</span></button>';
echo '</div>';

echo '<p class="franja">Propiedades</p>';
echo '<div id="infoDispositivo">';
?>
<form>
    <table id="tablaFormulario">
        <tr>
            <td>Nombre: </td>
            <td><input type="text" id="nomNodTer" value=<?php echo "'".$nomNodTer."'";?> disabled></td>
        </tr>
        <tr>
            <td>Dirección Física: </td>
            <td><input type="text" id="dirFisNodTer" value=<?php echo "'".$dirFisNodTer."'";?> disabled></input></td>
        </tr>
        <tr>
            <td>Cantidad de máxima de sensores: </td>
            <td><input type="text" id="canSenNodTer" value=<?php echo "'".$canSenNodTer."'";?> disabled></input></td>
        </tr>
    </table>

</form>
<?php
echo '<p class="franja"></p>';
echo "</div>";
$conexion->close();
?>