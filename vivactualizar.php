<?php

$calle=  utf8_decode($_GET["calle"]);
$numero=  utf8_decode($_GET["numero"]);

if(isset($_GET["tipo_v"])){
    $tipo_v=  utf8_decode($_GET["tipo_v"]);
    $codigo_p=  utf8_decode($_GET["codigo_p"]);
    $metros=  utf8_decode($_GET["metros"]);
    $od_v=  utf8_decode($_GET["od_v"]);
    $nombreZ=  utf8_decode($_GET["nombre_z"]);
    $callev=  utf8_decode($_GET["callev"]);
    $numerov=  utf8_decode($_GET["numerov"]);
    
    $conexion=new mysqli("localhost", "eavila", "emildaniel","catastro");
    
    if ($conexion->connect_error != 0){
        die("No se ha podido conectar a la base de datos: " .  $conexion->connect_error);
    }
    
    $consulta = $conexion->prepare("UPDATE vivienda ".
            "SET calle=?,numero=?".
            ",tipo_vivienda=?,codigo_postal=?".
            ",metros=?,od_vivienda=?".
            ",nombre_zona=? ".
            " WHERE calle=? AND numero=?");
    $consulta->bind_param("sisiisssi", $calle,$numero,$tipo_v,$codigo_p,
            $metros,$od_v,$nombreZ,$callev,$numerov);

    if(!$consulta->execute())
    {
        $error="<p>".$consulta->errno . " - " . $consulta->error . " - ".utf8_encode($nombreZ)."</p>";
    }else
    {
        $error="";
    }
$conexion->close();

$conexion=new mysqli("localhost", "eavila", "emildaniel","catastro");

if ($conexion->connect_error != 0){
    die("No se ha podido conectar a la base de datos: " .  $conexion->connect_error);
}

$consulta = $conexion->prepare("SELECT * FROM vivienda");
echo $error
        ?>
   <fieldset><legend>Datos de Vivienda</legend>
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
<?php
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
?>
        <tr>
             <td><input type="text" name="calle" id="calle" class="textEntry" maxlength="8"></td>
                <td><input type="number" name="numero" id="numero" class="textEntry" maxlength="3" min="0" max="999"></td>
                <td><input type="text" name="tipo_v" id="tipo_v" class="textEntry" maxlength="1"></td>
                <td><input type="number" name="codigo_p" id="codigo_p" class="textEntry" maxlength="5" min="0" max="99999"></td>
                <td><input type="number" name="metros" id="metros" class="textEntry" maxlength="5" min="1" max="99999"></td>
                <td><input type="text" name="od_v" id="od_v" class="textEntry"></td>
                <td><select name="nombre_z" id="nombre_z" class="textEntry">
<?php
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
?>
            </select></td>
            <td colspan="2"><input type="button" value="Agregar" onclick="insertaVivienda();"></td>
        
        </tr>
    </table>
    </fieldset>
<?php
    
}else{
    $conexion=new mysqli("localhost", "eavila", "emildaniel","catastro");
    
    if ($conexion->connect_error != 0){
        die("No se ha podido conectar a la base de datos: " .  $conexion->connect_error);
    }
    
    $consulta = $conexion->prepare("SELECT * FROM vivienda WHERE calle=? AND numero=?");
    $consulta->bind_param("si", $calle,$numero);
?>    

<table>
    
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

<?php

    $consulta->execute();
    $consulta->bind_result($calle,$numero,$tipo_v,$codigo_p,$metros,$od_v,$nombreZ);
    $consulta->fetch();
        
        echo "<tr>";
        echo "<td><input type=text id='calle' value='".
                utf8_encode($calle)."'>
                    <input type=text id='callev' value='".
                utf8_encode($calle)."' class='oculto'></td>";
        echo "<td><input type=number min=1 max=999 id='numero' value='".
                utf8_encode($numero)."'>
                    <input type=number min=1 max=999 id='numerov' value='".
                utf8_encode($numero)."' class='oculto'></td>";
        echo "<td><input type=text id='tipo_v' value='".
                utf8_encode($tipo_v)."'></td>";
        echo "<td><input type=number min=1 max=99999 id='codigo_p' value='".
                utf8_encode($codigo_p)."'></td>";
        echo "<td><input type=number min=1 max=99999 id='metros' value='".
                utf8_encode($metros)."'></td>";
        echo "<td><input type=text id='od_v' value='".
                utf8_encode($od_v)."'></td>";
        echo "<td>"?><select id='nombre_z'>
            <?php
            
            $conexion=new mysqli("localhost", "eavila", "emildaniel","catastro");
    
                    if ($conexion->connect_error != 0){
                        die("No se ha podido conectar a la base de datos: " .  $conexion->connect_error);
                    }

                    $consulta = $conexion->prepare("SELECT nombre_zona FROM zonaurbana");
                    $consulta->execute();
                    $consulta->bind_result($zona);
                    while($consulta->fetch()){
                        echo "<option value='".utf8_encode($zona)."'>".
                                utf8_encode($zona)."</option>";
                    }
                    $conexion->close();
            
            ?>
        </select></td>
        
    <?php
        echo "<td><input type='button' ".
                "onclick='modificaVivienda();' ".
                "value='ACTUALIZAR'></td>".
            "</tr>";
}
?>
    </table>