<?php
$titulo = "ZONA URBANA - CATASTRO";

include "encabezado.php";

if (isset($_GET["resultado"]))
{
    echo $_GET["resultado"];
}

?>
<div class="full_width clear">
<fieldset><legend>Datos de Zona</legend>

    <?php
    
    $conexion=new mysqli("localhost", "eavila", "emildaniel","catastro");
    
    if ($conexion->connect_error != 0){
        die("No se ha podido conectar a la base de datos: " .  $conexion->connect_error);
    }
    
    $consulta = $conexion->prepare("SELECT * FROM zonaurbana");
    ?>
        <table border=2 width=100%>
            <tr>
                <td><b>NOMBRE ZONA</b></td>
                <td><b>ODZONA</b></td>
                <td colspan="2"><b>OPERACIONES</b></td>
            </tr>
    <?php 
    $consulta->execute();
    $consulta->bind_result($nombreZNA,$odZNA);
    while($consulta->fetch()){
        
        echo "<tr>";
        
        echo "<td>".$nombreZNA."</td>";
        echo "<td>".$odZNA."</td>";
        echo '<td><a href=znaureliminar.php?nombreZona='.urlencode($nombreZNA).'>ELIMINAR</a></td>';
        echo '<td><a href=znauractualizar.php?nombreZona='.urlencode($nombreZNA).'>ACTUALIZAR</a></td>';
        echo "</tr>";
    }
    
    ?>
            <tr><form action="znaurinsertar.php" method="POST">
                <td><input type="text" name="nombreZona" class="textEntry"></td>
                <td><input type="text" name="odZona" class="textEntry"></td>
                <td colspan="2"><input type="submit" value="Agregar"></td>
            </form>
            </tr>
    </table>
</fieldset>
</div>
<?php
include "pie.php";
?>