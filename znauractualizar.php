<?php
$titulo = "MODIFICAR ZONA - CATASTRO";
include "encabezado.php";

if(isset($_POST["nombreNuevoZona"]))
{
    $conexion=new mysqli("localhost", "eavila", "emildaniel","catastro");
    
    if ($conexion->connect_error != 0){
        die("No se ha podido conectar a la base de datos: ".  $conexion->connect_error);
    }
    
    $consulta = $conexion->prepare("CALL catastro.sp_modZonaUrbana(?,?,?)");
    $consulta->bind_param("sss",$_POST["nombreAntiguoZona"], $_POST["nombreNuevoZona"],$_POST["odZona"]);

    if ($consulta->execute()){

        $resultado ="<p>ZONA URBANA ACTUALIZADA CORRECTAMENTE</p>";

    }else {
        $resultado ="<p>ZONA URBANA NO SE PUDO ACTUALIZAR: ". ($consulta->errno). " - " .($consulta->error) ."</p>";
    }

    $conexion->close();

    //
    echo <<<HTML
       <html>
            <meta http-equiv="REFRESH" content="0;url=zona_urbana.php?resultado=$resultado"
       </html>
HTML;
}

$conexion=new mysqli("localhost", "eavila", "emildaniel","catastro");
    
    if ($conexion->connect_error != 0){
        die("No se ha podido conectar a la base de datos: ".  $conexion->connect_error);
    }
    
    $consulta = $conexion->prepare("SELECT * FROM zonaurbana WHERE NOMBRE_ZONA= ?");
    $consulta->bind_param("s", $_GET["nombreZona"]);
    $consulta->execute();
    $consulta->bind_result($nombreZNA,$odZNA);
    $consulta->fetch();
?>
<fieldset><legend>Actualizar Datos</legend>
<form action="znauractualizar.php" method="POST">
    <table>
        <tr>
            <td>NOMBRE ZONA</td>
            <td>OTRO DATO ZONA</td>
            <td></td>
        </tr>
        <tr>
            <?php
                echo <<<HTML
                <td><input type="text" name="nombreNuevoZona" value="$nombreZNA" class="textEntry"></td>
                <td><input type="text" name="odZona" value="$odZNA" class="textEntry"></td>
                <td><input type="text" name="nombreAntiguoZona" value="$nombreZNA" class="oculto">
                    <input type="submit" value="Actualizar"></td>
HTML;
                $conexion->close();
            ?>
        </tr>
    </table>
</form>
</fieldset>

<?php
include "pie.php";
?>