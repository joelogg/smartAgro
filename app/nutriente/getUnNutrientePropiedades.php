<?php
include ("../../partes/conexion.php");
$idNut = $_GET['idNut'];

$sql2 = "SELECT DesNut FROM nutrientes WHERE IdNut='".$idNut."'";
$result2 = $conexion->query($sql2);

if ($result2->num_rows > 0) 
{
    while($row2 = $result2->fetch_assoc()) 
    {
        $desNut=$row2["DesNut"];        
    }
}

echo '<p class="franja" style="text-align: center;">'.$desNut.'</p>';
echo '<div id="botonesPropiedades">';
echo    '<button id="botonEditar" onclick="editarCambioNut()" ><span id="icoEditar"></span><span class="letraBotonesP">Editar</span></button>';
echo    '<button id="botonGuardar" onclick="guardarCambioNut('.$idNut.')"><span id="icoGuardar"></span><span class="letraBotonesP">Guardar</span></button>';
echo    '<button id="botonCancelar" onclick="getNutrientes()"><span id="icoCancelar"></span><span class="letraBotonesP">Cancelar</span></button>';
echo '</div>';

echo '<p class="franja">Propiedades</p>';
echo '<div id="infoDispositivo">';
?>
<form>
    <table id="tablaFormulario">
        <tr>
            <td>Nombre: </td>
            <td><input type="text" id="desNut" value=<?php echo "'".$desNut."'";?> disabled></td>
        </tr>
    </table>

    
    <table id="tablaFormularioAumentar">
    </table>
</form>

<?php

echo '<p class="franja"></p>';

echo "</div>";
$conexion->close();
?>
