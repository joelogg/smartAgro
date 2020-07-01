<?php
/*imagen*/
$imagen = $_POST['img_val'];
/*Id del componente*/
$idComponente = $_POST['idComponente'];
/*tipo de Componente
Campos=1, Campo=2, Valvula=3, Sensor=4, OtrosDispositivos=5, 
NCoordinadores=6, NCoordinador=7, NRuteadores=8, NRuteador=9, 
Cultivos=10, Cultivo=11*/
$tipoComponente = $_POST['tipoComponente'];
/*tipo de Guardado
Guardar para un reporte final=1, Guardar PDF solo para ese componenteCampo=2, 
Guardar solo imagen=3*/
$tipoGuardado = $_POST['tipoGuardado'];

//Get the base-64 string from data
$filteredData=substr($imagen, strpos($imagen, ",")+1);

//Decode the string
$unencodedData=base64_decode($filteredData);

//Save the image
$name= "".time();

//reporte final
if($tipoGuardado==1)
{
    include ("generarReporteCompleto.php");
}
//simple pdf
elseif($tipoGuardado==2)
{
    if($tipoComponente==3)
    {
    	file_put_contents('imgValvulaPDF.jpg', $unencodedData);
        include ("generarPDFValvula.php");
    }
    elseif($tipoComponente==4)
    {
    	file_put_contents('imgSensorPDF.jpg', $unencodedData);
        include ("generarPDFNodoTerminal.php");
    }
}
//solo imagen
elseif($tipoGuardado==3)
{
    if($tipoComponente==3)
    {
        file_put_contents('imgValvula.jpg', $unencodedData);
        include ("generarSoloImagenValvula.php");
    }
    elseif($tipoComponente==4)
    {
        file_put_contents('imgSensor.jpg', $unencodedData);
        include ("generarSoloImagenNodoTerminal.php");
    }    
}
?>    
