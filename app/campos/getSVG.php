<?php
$anchoSVG = $_GET['anchoV'];
$altoSVG = $_GET['altoV'];

/*echo '<polygon class="polygonCampoAtras"
	onclick="funcionFueraDispositicos()" 
	points="0,0 0,'.$altoSVG.' '.$anchoSVG.','.$altoSVG.' '.$anchoSVG.',0"/>';*/


include ("../../partes/conexion.php");

//primer select para dibujar el campo
$sql = "SELECT IdCam, NomCam, PosGraCam, PosXTexCam, PosYTexCam, HumCam, HumMinCul, HumMaxCul, ActCam, NomCul FROM campo, cultivo WHERE campo.IdCul = cultivo.IdCul";
$result = $conexion->query($sql);
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
    	$idCam = $row["IdCam"];
        $nomCam = $row["NomCam"];
        $posGraCam = $row["PosGraCam"];
        $posXTexCam = $row["PosXTexCam"];
        $posYTexCam = $row["PosYTexCam"];
        $posYTexCam = $posYTexCam + 1;

        $humCam = $row["HumCam"];
        $humMinCul = $row["HumMinCul"];
        $humMaxCul = $row["HumMaxCul"];

        $actCam = $row["ActCam"];
        $nomCul = $row["NomCul"];

        if($posGraCam=="")
        {

        }
        else
        {
	        $posGraCam2 = "";

	     
	        $numAux="";
	        //extraigo los untos del campo
	        for($i=0;$i<strlen($posGraCam);$i++)
	        { 
			    $char = substr($posGraCam,$i,1); 
			    if($char==",")
			    {
			    	$numAux = $numAux*$anchoSVG/100;
			    	$posGraCam2 = $posGraCam2 . $numAux . ",";
			    	$numAux = "";
			    }
			    elseif($char==" ")
			    {
			    	$numAux = $numAux*$altoSVG/100;
			    	$posGraCam2 = $posGraCam2 . $numAux . " ";
			    	$numAux = "";
			    }
			    else
			    {
			    	$numAux = $numAux.$char;
			    }					    
			} 
			$numAux = $numAux*$altoSVG/100;
			$posGraCam2 = $posGraCam2 . $numAux;

			if($actCam==0)
			{
				echo '<polygon id="campo'.$idCam.'"
					class="polygonCampo polygonCampoVacio"
					onclick="clickCampoMapa('.$idCam.')" 
					ondblclick="mostrarUnCampo('.$idCam.')" 
					points="'.$posGraCam2.'"/>';
			}
			elseif($humCam<$humMinCul || $humCam>$humMaxCul)
			{
				echo '<polygon id="campo'.$idCam.'" 
					class="polygonCampo polygonCampoAlerta"
					onclick="clickCampoMapa('.$idCam.')"  
					ondblclick="mostrarUnCampo('.$idCam.')" 
					points="'.$posGraCam2.'"/>';
			}
			else
			{
				echo '<polygon id="campo'.$idCam.'" 
					class="polygonCampo polygonCampoNormal"
					onclick="clickCampoMapa('.$idCam.')"  
					ondblclick="mostrarUnCampo('.$idCam.')" 
					points="'.$posGraCam2.'"/>';
			}     		        
    	}
    }
}

//para obtener las letras
$sql = "SELECT NomCam, PosXTexCam, PosYTexCam, NomCul FROM campo, cultivo WHERE campo.IdCul = cultivo.IdCul";
$result = $conexion->query($sql);
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
    	
        $nomCam = $row["NomCam"];
       
        $posXTexCam = $row["PosXTexCam"];
        $posYTexCam = $row["PosYTexCam"];
        $posYTexCam = $posYTexCam + 1;

        
        $nomCul = $row["NomCul"];

        if($posGraCam=="")
        {

        }
        else
        {			        
	        $posXTexCam = $posXTexCam*$anchoSVG/100;
	        $posYTexCam = $posYTexCam*$altoSVG/100;
	        echo '<text class="textTexto" x="'.($posXTexCam+5).'" y="'.($posYTexCam).'" fill="#000">'.$nomCul.'-'.$nomCam.'</text>';	        
    	}
    }
}


//----------------Iconos del sensor(NT)----------------------------------	
$altoSeparacion=80;
$iNR=$altoSeparacion;
$iNT=$altoSeparacion;		

$sql = "SELECT IdDis, NomDis, PosXDis, PosYDis, EstConec FROM dispositivos WHERE TipDis=10";
$result = $conexion->query($sql);
if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
		$idDis = $row["IdDis"];
		$nomDis = $row["NomDis"];
		$posXDis = $row["PosXDis"];
		$posYDis = $row["PosYDis"];
		$estConec = $row["EstConec"];

		
		if($posXDis==0 || $posYDis==0)//sin posicion propia
		{			
			echo '<circle 
			onmousedown="mouseDownSensor('.$idDis.')" 
			onclick="clickSensorMapa('.$idDis.')" 
			class="rectSensor" 
			id="sensor'.$idDis.'"  
			cx="'.($posXDis+80).'" cy="'.($posYDis+$iNT).'" r="12"  />';	
			
			$iNT=$iNT+10;
		}
		else //con posicion propia
		{
			$posXNodTerAux = $posXDis*$anchoSVG/100;
			$posYNodTerAux = $posYDis*$altoSVG/100;	
	
			echo '<circle 
			onmousedown="mouseDownSensor('.$idDis.')"
			onclick="clickSensorMapa('.$idDis.')" 
			class="rectSensor" 
			id="sensor'.$idDis.'"  
			cx="'.($posXNodTerAux).'" cy="'.($posYNodTerAux).'" r="12"  />';

			echo '<text 
			onmousedown="mouseDownSensor('.$idDis.')"
			onclick="clickSensorMapa('.$idDis.')"  
			class="textTexto" style="cursor:pointer;"
			x="'.($posXNodTerAux-10).'" y="'.($posYNodTerAux+5).'" fill="#000">'.$nomDis.'</text>';
		}							
    }
} 

//-----------------------iconos de la valvula-------------------
$sql = "SELECT IdVal, NomVal, PosXDis, PosYDis, PosXVal, PosYVal, EstVal, AccVal, EstConec FROM dispositivos, nodoruteador, valvula WHERE dispositivos.IdDis=nodoruteador.IdDis AND valvula.IdNodRut=nodoruteador.IdNodRut AND TipDis=20";
$result = $conexion->query($sql);
if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
		$idVal = $row["IdVal"];
		$nomVal = $row["NomVal"];
		$posXDis = $row["PosXDis"];
		$posYDis = $row["PosYDis"];
		$posXVal = $row["PosXVal"];
		$posYVal = $row["PosYVal"];
		$estVal = $row["EstVal"];
		$accVal = $row["AccVal"];

		$estConec = $row["EstConec"];

		if($posXVal>0 || $posYVal>0) //las valvulas tienen posicion propia
		{
			$posXValAux = $posXVal*$anchoSVG/100;
			$posYValAux = $posYVal*$altoSVG/100;
	 
			$posiciones = ($posXValAux).','.($posYValAux).' '.($posXValAux+23).','.($posYValAux+23).' '.($posXValAux+23).','.($posYValAux).' '.($posXValAux).','.($posYValAux+23);

			if($estVal==1)
	    	{
	    		echo '<polygon 
				onmousedown="mouseDownValvula('.$idVal.')" 	
				onclick="verValvulaMapa('.$idVal.')"		
				class="rectValvulaAbierta rectValvula" 
	    		id="valvula'.$idVal.'" points="'.$posiciones.'"/>'; 
	    		/*echo '<polygon 
				onmousedown="mouseDownValvula('.$idVal.'), accionarSwitchValvulaMapa('.$idVal.')" 	
				onclick="verValvulaMapa('.$idVal.')"		
				class="rectValvulaAbierta rectValvula" 
	    		id="valvula'.$idVal.'" points="'.$posiciones.'"/>'; */
	    	}
	    	
	    	elseif($estVal==0)
	    	{
	    		echo '<polygon 
				onmousedown="mouseDownValvula('.$idVal.')" 	
				onclick="verValvulaMapa('.$idVal.')"
				class="rectValvulaCerrada rectValvula" 
	    		id="valvula'.$idVal.'" points="'.$posiciones.'"/>';
	    	}

	    	echo '<text 
			onmousedown="mouseDownValvula('.$idVal.')" 	
			onclick="verValvulaMapa('.$idVal.')"
			class="textTexto" style="cursor:pointer;"
			x="'.($posXValAux-1).'" y="'.($posYValAux+15).'" fill="#000">'.$nomVal.'</text>';
		}			
		
		elseif($posXDis==0 || $posYDis==0)//si los dispositivos no tiene posicion (estado inicio)
		{
			//$posiciones = (80).','.($iNT-23).' '.(80+23).','.($iNT+23).' '.(80+23).','.($iNT-11).' '.($iNT-23).','.(80);
	    	$posiciones = '40,'.($iNR-10).' 63,'.($iNR+13).' 63,'.($iNR-10).' 40,'.($iNR+13);

	    	if($estVal==1)
	    	{
	    		echo '<polygon 
				onmousedown="mouseDownValvula('.$idVal.')" 	
				onclick="verValvulaMapa('.$idVal.')"
				class="rectValvulaAbierta rectValvula" 
	    		id="valvula'.$idVal.'" points="'.$posiciones.'"/>';
	    	}
	    	elseif($estVal==0)
	    	{
	    		echo '<polygon  
				onmousedown="mouseDownValvula('.$idVal.')" 	
				onclick="verValvulaMapa('.$idVal.')"
				class="rectValvulaCerrada rectValvula" 
	    		id="valvula'.$idVal.'" points="'.$posiciones.'"/>';
	    	}
	    	$iNR=$iNR+10;
		}
		elseif($posXVal==0 || $posYVal==0)//si valvula no tiene posicion pero se movio el ruteador
		{
			$posXValAux = $posXDis*$anchoSVG/100;
			$posYValAux = $posYDis*$altoSVG/100;

	    	$posiciones = ($posXValAux-11).','.($posYValAux-11).' '.($posXValAux+12).','.($posYValAux+12).' '.($posXValAux+12).','.($posYValAux-11).' '.($posXValAux-11).','.($posYValAux+12);

	    	if($estVal==1)
	    	{
	    		echo '<polygon 
				onmousedown="mouseDownValvula('.$idVal.')" 	
				onclick="verValvulaMapa('.$idVal.')"
				class="rectValvulaAbierta rectValvula" 
	    		id="valvula'.$idVal.'" points="'.$posiciones.'"/>';
	    	}
	    	elseif($estVal==0)
	    	{
	    		echo '<polygon 
				onmousedown="mouseDownValvula('.$idVal.')" 	
				onclick="verValvulaMapa('.$idVal.')"		 
				class="rectValvulaCerrada rectValvula" 
	    		id="valvula'.$idVal.'" points="'.$posiciones.'"/>';
	    	}

	    	echo '<text 
			onmousedown="mouseDownValvula('.$idVal.')" 	
			onclick="verValvulaMapa('.$idVal.')"
			class="textTexto" style="cursor:pointer;"
			x="'.($posXValAux-1).'" y="'.($posYValAux+15).'" fill="#000">'.$nomVal.'</text>';
		}
				    				

		echo '</div>';
	}
}		        	

$conexion->close();

?>
