<?php
include ("../../partes/conexion.php");
$idDis = $_GET['idNC'];


$sql2 = "SELECT NomDis, HEX(DirFisDis) AS DirFisDis FROM dispositivos WHERE IdDis='".$idDis."'";
$result2 = $conexion->query($sql2);

if ($result2->num_rows > 0) 
{
    while($row2 = $result2->fetch_assoc()) 
    {
        $nomNodCor=$row2["NomDis"];
        $dirFisNodCoor=$row2["DirFisDis"];
    }
}

echo '<p class="franja" style="text-align: center;">NODO COORDINADOR: '.$nomNodCor.'</p>';
echo '<div id="botonesPropiedades">';
echo    '<button id="botonEditar" onclick="editarCambioNC()" ><span id="icoEditar"></span><span class="letraBotonesP">Editar</span></button>';
echo    '<button id="botonGuardar" onclick="guardarCambioNC('.$idDis.')"><span id="icoGuardar"></span><span class="letraBotonesP">Guardar</span></button>';
echo    '<button id="botonCancelar" onclick="getCoordinadores()"><span id="icoCancelar"></span><span class="letraBotonesP">Cancelar</span></button>';
echo '</div>';

echo '<p class="franja">Propiedades</p>';
echo '<div id="infoDispositivo">';
?>
<form>
    <table id="tablaFormulario">
        <tr>
            <td>Nombre: </td>
            <td><input type="text" id="nomNodCor" value=<?php echo "'".$nomNodCor."'";?> disabled></td>
        </tr>
        <tr>
            <td>Dirección Física: </td>
            <td><input type="text" id="dirFisNodCoor" value=<?php echo "'".$dirFisNodCoor."'";?> disabled></input></td>
        </tr>
    </table>

</form>
<?php
echo '<p class="franja"></p>';
echo "</div>";
$conexion->close();
?>