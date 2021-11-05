<?php

$nombre = $_POST["nombreZona"];
$od = $_POST["odZona"];

$conexion = new mysqli("localhost","eavila","emildaniel","catastro");

$consulta=$conexion->prepare("INSERT INTO ZONAURBANA VALUES(?,?)");

$consulta->bind_param("ss", $nombre, $od);

$consulta->execute();

$resultado = $consulta->affected_rows;

if ($resultado>0){
    
    $resultado ="<p>ZONA URBANA INSERTADA CORRECTAMENTE</p>";
    
}else {
    $resultado ="<p>ZONA URBANA NO SE PUDO INSERTAR: ". ($consulta->errno). " - " .($consulta->error) ."</p>";
}

$conexion->close();

echo <<<HTML
   <html>
        <meta http-equiv="REFRESH" content="0;url=zona_urbana.php?resultado=$resultado"
   </html>
HTML;

?>
