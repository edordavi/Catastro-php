<?php

$calle=utf8_decode($_GET["calle"]);
$numero=$_GET["numero"];


$conexion = new mysqli("localhost","eavila","emildaniel","catastro");

$consulta=$conexion->prepare("DELETE FROM VIVIENDA WHERE calle=? AND numero=?;");

$consulta->bind_param("si", $calle,$numero);

$consulta->execute();

$resultado = $consulta->affected_rows;

if(!$resultado>0)
{
$error="<p>".$consulta->errno . " - " . $consulta->error . " - ".utf8_encode($nombre_z)."</p>";
}else
{$error="";}

$conexion->close();
    
$conexion=new mysqli("localhost", "eavila", "emildaniel","catastro");

if ($conexion->connect_error != 0){
    die("No se ha podido conectar a la base de datos: " .  $conexion->connect_error);
}

$consulta = $conexion->prepare("SELECT * FROM vivienda");
echo <<<_HTML
<fieldset><legend>Datos de Vivienda</legend>
    {$error}
   <table border=2 width=100% id="datos1">
        <tr>
            <td><b>CALLE</b></td>
            <td><b>NUMERO</b></td>
            <td><b>TIPO VIVIENDA</b></td>
            <td><b>CODIGO POSTAL</b></td>
            <td><b>METROS</b></td>
            <td><b>OD VIVIENDA</b></td>
            <td><b>NOMBRE ZONA</b></td>
            <td colspan="2"><b>OPERACIONES</b></td>
        </tr>
_HTML;
$consulta->execute();
$consulta->bind_result($calle,$numero,$tipo_v,$codigo_p,$metros,$od_v,$nombreZ);
while($consulta->fetch()){

    echo "<tr>";
    echo "<td>".utf8_encode($calle)."</td>";
    echo "<td>".utf8_encode($numero)."</td>";
    echo "<td>".utf8_encode($tipo_v)."</td>";
    echo "<td>".utf8_encode($codigo_p)."</td>";
    echo "<td>".utf8_encode($metros)."</td>";
    echo "<td>".utf8_encode($od_v)."</td>";
    echo "<td>".utf8_encode($nombreZ)."</td>";
    echo <<<HTML
        <td><input type='button' onclick='viviendaconsulta(
            "viveliminar.php?calle=$calle&numero=$numero");' value='ELIMINAR'>
        </td> 
        <td><input type='button' 
            onclick='viviendaconsulta("vivactualizar.php?calle=$calle&numero=$numero");'
                value="ACTUALIZAR"></td>'
        </tr>
HTML;
}
$conexion->close();
echo <<<_HTML
        <tr><td><input type="text" name="calle" id="calle" class="textEntry" maxlength="8"></td>
                <td><input type="number" name="numero" id="numero" class="textEntry" maxlength="3" min="0" max="999"></td>
                <td><input type="text" name="tipo_v" id="tipo_v" class="textEntry" maxlength="1"></td>
                <td><input type="number" name="codigo_p" id="codigo_p" class="textEntry" maxlength="5" min="0" max="99999"></td>
                <td><input type="number" name="metros" id="metros" class="textEntry" maxlength="5" min="1" max="99999"></td>
                <td><input type="text" name="od_v" id="od_v" class="textEntry"></td>
                <td><select name="nombre_z" id="nombre_z" class="textEntry">
_HTML;
                $conexion=new mysqli("localhost", "eavila", "emildaniel","catastro");

                if ($conexion->connect_error != 0){
                    die("No se ha podido conectar a la base de datos: " .  $conexion->connect_error);
                }

                $consulta = $conexion->prepare("SELECT nombre_zona FROM zonaurbana");
                $consulta->execute();
                $consulta->bind_result($zona);
                while($consulta->fetch()){
                    echo "<option value='".utf8_encode($zona)."'>".utf8_encode($zona)."</option>";
                }
                $conexion->close();
echo <<<_HTML
            </select></td>
            <td colspan="2"><input type="button" value="Agregar" onclick="insertaVivienda();"></td>
        
        </tr>
        </table>
    </fieldset>
_HTML;

?>



