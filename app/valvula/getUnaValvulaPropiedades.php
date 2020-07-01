<?php
include ("../../partes/conexion.php");
$idVal = $_GET['idVal'];

$sql2 = "SELECT NomVal, OrdVal, EstVal, TipTarVal FROM valvula WHERE IdVal='".$idVal."'";
$result2 = $conexion->query($sql2);

if ($result2->num_rows > 0) 
{
    while($row2 = $result2->fetch_assoc()) 
    {
        $nomVal=$row2["NomVal"];
        $ordVal=$row2["OrdVal"];
        $estVal=$row2["EstVal"];
        $tipTarVal=$row2["TipTarVal"];
        $tipTarVal=1;
    }
}

echo '<p class="franja" style="text-align: center;">Valvula: '.$nomVal.'</p>';
echo '<div id="botonesPropiedades">';
echo    '<button id="botonEditar" onclick="editarValvula()"><span id="icoEditar"></span><span class="letraBotonesP">Editar</span></button>';
echo    '<button id="botonGuardar" onclick="guardarCambioValvula('.$idVal.')"><span id="icoGuardar"></span><span class="letraBotonesP">Guardar</span></button>';
echo    '<button id="botonCancelar" onclick="mostrarUnaValvula('.$idVal.');"><span id="icoCancelar"></span><span class="letraBotonesP">Cancelar</span></button>';
echo '</div>';

echo '<p class="franja">Propiedades</p>';
echo '<div id="infoDispositivo">';
echo '<table id="tablaFormularioGuardar">';
        
        if($estVal==1)
        { 
            $estadoLetras="Abierta";
        }
        else
        {   
            $estadoLetras="Cerrada";
        }

        echo '<tr>';
        echo '<td>Valvula:</td><td><input type="text" id="nomVal" value="'.$nomVal.'" disabled></td>';
        echo '</tr>';
        
        echo '<tr>';
        echo '<td>Orden Interno:</td><td><input type="text" value="'.$ordVal.'" disabled></td>';
        echo '</tr>';       

        echo '<tr>';
        echo '<td>Estado:</td><td><input type="text" id="estVal" value="'.$estadoLetras.'" disabled></td>';
        echo '</tr>';

        /*echo '<tr>';
        echo '<td>Tarea Asignada:</td>';
        echo '<td><select id="tipTarVal" disabled>';
        if($tipTarVal==1) //manual
        {
            echo '<option value="1">Manual</option>';
            echo '<option value="2">Automático</option>';
            echo '<option value="3">Tareas Programadas</option>';
        }
        elseif ($tipTarVal==2) //automatica
        {
            echo '<option value="2">Automático</option>';
            echo '<option value="1">Manual</option>';           
            echo '<option value="3">Tareas Programadas</option>';
        }
        elseif ($tipTarVal==3) //tareas programadas
        {
            echo '<option value="3">Tareas Programadas</option>';
            echo '<option value="1">Manual</option>';
            echo '<option value="2">Automático</option>';
        }
        echo '</select>';
        echo '</td>';
        echo '</tr>';*/


echo '</table>';
/*
//---------cambio de imagen en la valvula---------------------
echo '<p class="franja"></p>';

echo '<br>';
echo '<table id="tablaFormularioGuardar">';
    echo '<tr>';
        echo '<td>';
            echo '<label class="switch switch-green" onclick="accionarSwitchValvula('.$idVal.')">';
                if($accVal==1)
                { 
                    echo '<input type="checkbox" id="switchValvula" class="switch-input" checked>';
                }
                else
                {   
                    echo '<input type="checkbox" id="switchValvula" class="switch-input">';
                }
                echo '<span class="switch-label" data-on="Cerrar" data-off="Abrir"></span>';
                echo '<span class="switch-handle"></span>';
            echo '</label>';
        echo '</td>';

        echo '<td>';
            if($accVal==1)
            { 
                echo '<img id="imagenValvula" src="img/valvulaAbierta.gif">';
            }
            else
            {   
                echo '<img id="imagenValvula" src="img/valvulaCerrada.gif">';
            }
        echo '</td>';
    echo '</tr>';
echo '</table>';
*/

//---------tareas Programadas---------------------
if($tipTarVal==1) //manual
{
}
elseif ($tipTarVal==2) //automatica
{
}
elseif ($tipTarVal==3) //tareas programadas
{
    
    echo '<p class="franja" id="franajaAgregarTarea" onclick="agregarCeldaTarea()"></p>';
    echo '<br>';

    echo '<table id="tablaTareasP" class="tablaNormal">';
        
            
        $sql2 = "SELECT IdTarVal, FecIniTarVal, FecFinTarVal, HorIniTarVal, HorFinTarVal FROM tareavalvula WHERE IdVal='".$idVal."' ORDER BY FecIniTarVal ASC";
        $result2 = $conexion->query($sql2);

        if ($result2->num_rows > 0) 
        {   
            echo '<tr>';
            echo '<th>Tareas</th>';
            echo '<th>Fecha de Inicio</th>';
            echo '<th>Fecha de Finalización</th>';
            echo '<th>Hora de Inicio</th>';
            echo '<th>Hora de Finalización</th>';
            echo '<th>Eliminar</th>';
            echo '</tr>';
            $i = 1;
            while($row2 = $result2->fetch_assoc()) 
            {
                $idTarVal=$row2["IdTarVal"];
                $fecIniTarVal=$row2["FecIniTarVal"];
                $fecFinTarVal=$row2["FecFinTarVal"];
                $horIniTarVal=$row2["HorIniTarVal"];
                $horFinTarVal=$row2["HorFinTarVal"];

                echo '<tr>';
                echo '<td>Tarea '.$i.'</td>';
                echo '<td>'.$fecIniTarVal.'</td>';
                echo '<td>'.$fecFinTarVal.'</td>';
                echo '<td>'.$horIniTarVal.'</td>';
                echo '<td>'.$horFinTarVal.'</td>';
                echo '<td><button onclick="eliminarTareaP('.$idTarVal.', '.$idVal.')">Eliminar</button></td>';
                echo '</tr>';
                $i++;
            }
        }
        else
        {
            echo '<tr><th>Tareas</th></tr>';
            echo "<tr><td>No hay tareas programadas.</td></tr>";
        }
    echo '</table>';
    echo '<br>';
}
?>

    <table id="tablaFormularioAumentar">
    </table>
<p class="franja"></p>

<?php

echo "</div>";
$conexion->close();
?>