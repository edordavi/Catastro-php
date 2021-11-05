<?php

$nombre = $_GET["nombreZona"];

$conexion = new mysqli("localhost","eavila","emildaniel","catastro");

$consulta=$conexion->prepare("DELETE FROM ZONAURBANA WHERE NOMBRE_ZONA = ?");

$consulta->bind_param("s", $nombre);

$consulta->execute();

$resultado = $consulta->affected_rows;

if ($resultado>0){
    
    $resultado ="<p>ZONA URBANA ELIMINADA CORRECTAMENTE</p>";
    
}else {
    $resultado ="<p>ZONA URBANA NO SE PUDO ELIMINAR: ". ($consulta->errno). " - " .($consulta->error) ."</p>";
}

$conexion->close();

//
echo <<<HTML
   <html>
        <meta http-equiv="REFRESH" content="0;url=zona_urbana.php?resultado=$resultado"
   </html>
HTML;

?>
