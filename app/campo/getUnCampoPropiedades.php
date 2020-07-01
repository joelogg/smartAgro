<?php
include ("../../partes/conexion.php");
$idCam = $_GET['idCam'];
$sql = "SELECT  NomCul, NomCam FROM campo, cultivo WHERE campo.IdCul= cultivo.IdCul 
    AND IdCam='".$idCam."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $nomCul=$row["NomCul"];
        $nomCam=$row["NomCam"];
    }
}

echo '<p class="franja" style="text-align: center;">Campo: '.$nomCul.' - '.$nomCam.'</p>';
echo '<div id="botonesPropiedades">';
echo    '<button id="botonEditar" onclick="editarCambioCampo()"><span id="icoEditar"></span><span class="letraBotonesP">Editar</span></button>';
echo    '<button id="botonGuardar" onclick="guardarCambioCampo('.$idCam.')"><span id="icoGuardar"></span><span class="letraBotonesP">Guardar</span></button>';
echo    '<button id="botonCancelar" onclick="getCampos()"><span id="icoCancelar"></span><span class="letraBotonesP">Cancelar</span></button>';
/*
echo    '<button id="botonAgregar" onclick="agregarSensor('.$idCam.')" style="float: right; margin-right:20px;"><span id="icoAgregar"></span><span class="letraBotonesP">Sensor</span></button>';
echo    '<button id="botonAgregar" onclick="agregarValvula('.$idCam.')" style="float: right; right:0;"><span id="icoAgregar"></span><span class="letraBotonesP">Valvula</span></button>';
*/

echo '</div>';

echo '<p class="franja">Propiedades</p>';
echo '<div id="infoDispositivo">';  
echo '<form action="#"><table id="tablaFormulario">';

$sql = "SELECT cultivo.IdCul, NomCam, NomCul, HumMinCul, HumMaxCul, HumCam, ActCam FROM campo, cultivo WHERE campo.IdCul=cultivo.IdCul AND idCam='".$idCam."'";
    
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $idCul=$row["IdCul"];
        $nomCam=$row["NomCam"];
        $nomCul=$row["NomCul"];
        $humMinCul=$row["HumMinCul"];
        $humMaxCul=$row["HumMaxCul"];
        $humCam=$row["HumCam"];
        $actCam=$row["ActCam"];
        
            
         
        echo '<tr>';
        echo '<td>Cultivo</td>';
        echo '<td><select id="idCul" disabled>';

             echo '<option value="'.$idCul.'">'.$nomCul.'</option>';

            $sql2 = "SELECT IdCul, NomCul FROM cultivo WHERE NomCul!='Sin Cultivo' AND
                NomCul!='".$nomCul."'";
            $result2 = $conexion->query($sql2);

            if ($result2->num_rows > 0) 
            {
                while($row2 = $result2->fetch_assoc()) 
                {
                    $idCul=$row2["IdCul"];
                    $nomCul=$row2["NomCul"];
                        
                    echo '<option value="'.$idCul.'">'.$nomCul.'</option>';
                }
            } 



        echo '</select></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Ubicado en el campo</td><td><input type="text" id="nomCam" value="'.$nomCam.'" disabled></td>';
        echo '</tr>';

        // si es 1 campo con cultivo 
        if($actCam==1)
        {
            echo '<tr>';
            echo '<td>Humedad Mínima</td><td><input type="text" value="'.$humMinCul.'" disabled></td>';
            echo '</tr>';

            if($humMinCul>$humCam || $humMaxCul<$humCam)
            {
                echo '<tr>';
                echo '<td>Humedad actual:</td><td><input type="text" value="'.$humCam.'" style="background: #F22; color: #BFF" disabled></td>';
                echo '</tr>';
            }
            else
            {
                echo '<tr>';
                echo '<td>Humedad actual:</td><td><input type="text" value="'.$humCam.'" disabled></td>';
                echo '</tr>';
            }
            

            echo '<tr>';
            echo '<td>Humedad Máxima</td><td><input type="text" value="'.$humMaxCul.'" disabled></td>';
            echo '</tr>';            
        }
        

        

        $sql2 = "SELECT DesNut FROM cultivonutrientes, nutrientes WHERE cultivonutrientes.IdNut=nutrientes.IdNut AND cultivonutrientes.IdCul='".$idCul."'";
		$result2 = $conexion->query($sql2);

		$nutrientes="";
		if ($result2->num_rows > 0) 
		{
			while($row2 = $result2->fetch_assoc()) 
			{
				$nutrientes = $nutrientes.$row2["DesNut"]."\n";
			}
		}
        
        if($actCam==1)
        {
            echo '<tr>';
            echo '<td>Nutrientes</td><td><textarea rows="4" disabled>'.$nutrientes.'</textarea></td>';
            echo '</tr>';
        }        
        

        if($actCam==1)
        {
            echo '<tr>';
            echo '<td>Estado:</td><td><input type="text" value="Campo en Uso" disabled></td>';
            echo '</tr>';
        }
        else
        {
            echo '<tr>';
            echo '<td>Estado:</td><td><input type="text" value="Campo Vacio"  style="background: #F22; color: #BFF" disabled></td>';
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