<div id="areaSistemaMensajes"><p id="mensajeSistemaMotrar">Conectado</p></div>
<div onclick="location.reload();" id="imgLogo" style="cursor: pointer;">
</div>

<div id="imgAlertasContenedor" onclick="clickAlertas()" style="cursor: pointer;">
<?php
$numeroAlertas = 0;

$sql = "SELECT COUNT(*) AS NumAler FROM campo, cultivo WHERE campo.IdCul = cultivo.IdCul AND ActCam =1 AND (HumMinCul>HumCam OR HumCam>HumMaxCul)";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $numeroAlertas=$row["NumAler"];        
    }    
}
if($numeroAlertas!=0)
{
	echo '<div id="imgAlertas"></div>';
	//numero de alertas menor a 100
	echo '<span id="numAlertas">'.$numeroAlertas.'</span>';
}
else
{
	echo '<div id="imgSinAlerta"></div>';
	//numero de alertas menor a 100
	echo '<span id="numConfProgramadas">'.$numeroAlertas.'</span>';
}
	


?>	
</div>

<div id="imgConfProgramadasContenedor" onclick="clickTareas()" style="cursor: pointer;"">
<?php
$cantidadTareas = 0;

$sql = "SELECT COUNT(*) AS CanTar FROM tareavalvula, valvula WHERE tareavalvula.IdVal=valvula.IdVal AND TipTarVal=3 AND CURDATE()<=FecFinTarVal";
$result = $conexion->query($sql);

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
        $cantidadTareas=$row["CanTar"];
    }
}
	echo '<div id="imgConfProgramadas"></div>';
	//numero de alertas menor a 100
	echo '<span id="numConfProgramadas">'.$cantidadTareas.'</span>';

?>	
	
</div>


<nav id="menuPrincipal">
	<ul>
		<li>
			<a href="#">
				<button id="m1" onclick="getMapa(), seleccionarMenu(1)">
					<span id="icoMapa"></span><span class="textoMP">Mapa</span>
				</button>
			</a>
		</li>
		<!--<li>
			<a href="#">
				<button id="m2" onclick="getGraficas(), seleccionarMenu(2)" style="cursor: not-allowed;" disabled="">
					<span id="icoGraficos"></span><span class="textoMP">Gráficos</span>
				</button>
			</a>
		</li>-->
		<li>
			<a href="#">
				<button id="m3" onclick="getPropiedades(), seleccionarMenu(3)">
					<span id="icoPropiedades"></span><span class="textoMP">Propiedades</span>
				</button>
			</a>
		</li>
		<li>
			<a href="#">
				<button id="m4" onclick="getMapaDispositivos(), seleccionarMenu(4)">
					<span id="icoDispositivos"></span><span class="textoMP">Dispositivos</span>
				</button>
			</a>
		</li>
		<li>
			<a href="#">
				<button id="m5" onclick="getValvulas(), seleccionarMenu(5)">
					<span id="icoValvulas"></span><span class="textoMP">Valvulas</span>
				</button>
			</a>
		</li>
		<li>
			<a href="#">
				<button id="m6" onclick="getSensores(), seleccionarMenu(6)">
					<span id="icoSensores"></span><span class="textoMP">Sensores</span>
				</button>
			</a>
		</li>
	</ul>
</nav>



