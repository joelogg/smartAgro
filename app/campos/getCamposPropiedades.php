<?php
include ("../../partes/conexion.php");

echo '<p class="franja" style="text-align: center;">CAMPOS</p>';
echo '<div id="botonesPropiedades">';
echo    '<button id="botonAgregar" onclick="agregarCampo()"><span id="icoAgregar"></span><span class="letraBotonesP">Agregar</span></button>';
echo    '<button id="botonRestaurar" onclick="restaurarCampo()"><span id="icoRestaurar"></span><span class="letraBotonesP">Restaurar</span></button>';
echo    '<button id="botonEliminar" onclick="eliminarCampo()"><span id="icoEliminar"></span><span class="letraBotonesP">Eliminar</span></button>';
echo '</div>';


echo '<p class="franja">Propiedades</p>';
echo '<div id="infoDispositivo">';
echo '<form action="#"><table id="tablaFormulario">';

$sql = "SELECT COUNT(*) AS TotalCampos FROM campo";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $totalCampos=$row["TotalCampos"];
                
        echo '<tr>';
        echo '<td>Nro. de Campos</td><td><input type="number" value="'.$totalCampos.'" disabled></td>';
        echo '</tr>';

        $sql2 = "SELECT COUNT(*) AS CanCamVac FROM campo WHERE ActCam=0";
		$result2 = $conexion->query($sql2);

		if ($result2->num_rows > 0) 
		{
			while($row2 = $result2->fetch_assoc()) 
			{
				$cantidadCamposVacios=$row2["CanCamVac"];
                echo '<tr>';
                echo '<td>Campos Vacios</td><td><input type="number" value="'.$cantidadCamposVacios.'" disabled></td>';
                echo '</tr>';
			}
		}

        
    }
} 
echo '</table>';
echo '<p class="franja">Campos Activos</p>';

echo '<br>';

echo '<table class="tablaNormal" disabled>';
echo 	'<tr>';
        echo '<th>Cultivo</th>';
        echo '<th>Campo</th>';
        echo '<th>Ir</th>';
        echo '<th></th>';
echo 	'</tr>';
$sql = "SELECT  NomCul, NomCam, IdCam FROM campo, cultivo WHERE campo.IdCul= cultivo.IdCul 
	AND ActCam=1";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $nomCul=$row["NomCul"];
        $nomCam=$row["NomCam"];
        $idCam=$row["IdCam"];
                
        echo '<tr>';
        echo '<td>'.$nomCul.'</td>';
        echo '<td>'.$nomCam.'</td>';
        echo '<td><a href="#" onclick="mostrarUnCampo('.$idCam.')" style="color:#00A;"">Ir...</a></td>';
        echo '<td><input type="checkbox" onclick="clicCheckActivo('.$idCam.')" name="idCamSelecionado" </td>';
        echo '</tr>';
    }
} 
echo '</table>';

echo '<br>';
echo '<p class="franja">Campos Vacios</p>';

echo '<br>';

echo '<table class="tablaNormal">';
echo 	'<tr>';
        echo '<th>Cultivo</th>';
        echo '<th>Campo</th>';
        echo '<th>Ir</th>';
        echo '<th></th>';
echo 	'</tr>';
$sql = "SELECT  NomCul, NomCam, IdCam FROM campo, cultivo WHERE campo.IdCul= cultivo.IdCul 
	AND ActCam=0";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $nomCul=$row["NomCul"];
        $nomCam=$row["NomCam"];
        $idCam=$row["IdCam"];
                
        echo '<tr>';
        echo '<td>Antiguamente: '.$nomCul.'</td>';
        echo '<td>'.$nomCam.'</td>';
        echo '<td><a href="#" onclick="mostrarUnCampo('.$idCam.')" style="color:#00A;">Ir...</a></td>';
        echo '<td><input type="checkbox" onclick="clicCheckVacio('.$idCam.')" name="idCamSelecionado" value="'.$idCam.'"</td>';
        echo '</tr>';
    }
} 
echo '</table>';

echo '<br>';
echo '</form>';

echo '<p class="franja"></p>';
echo "</div>";
$conexion->close();
?>