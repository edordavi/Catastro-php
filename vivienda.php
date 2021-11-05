<?php
$titulo="VIVIENDA - CATASTRO";
include "encabezado.php";


if (isset($_GET["resultado"]))
{
    echo $_GET["resultado"];
}
?>

<div class="full_width clear" id="datos">
<fieldset><legend>Datos de Vivienda</legend>

    <?php
    
    $conexion=new mysqli("localhost", "eavila", "emildaniel","catastro");
    
    if ($conexion->connect_error != 0){
        die("No se ha podido conectar a la base de datos: " .  $conexion->connect_error);
    }
    
    $consulta = $conexion->prepare("SELECT * FROM vivienda");
    ?>
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
    echo "<td>".$nombreZ."</td>";
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
                        echo "<option value='".$zona."'>".$zona."</option>";
                    }
                    $conexion->close();
                ?>
                </select></td>
                <td colspan="2"><input type="button" value="Agregar" onclick="insertaVivienda();"></td>
            
            </tr>
    </table>
</fieldset>
</div>
<script type="text/javascript">
    function viviendaconsulta(cadena)
    { 
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
         document.getElementById("datos").innerHTML=xmlhttp.responseText;
        }
      }
    xmlhttp.open("GET",cadena,true);
    xmlhttp.send();
    }
    
    function insertaVivienda(){
        var calle = document.getElementById("calle").value;
        var numero = document.getElementById("numero").value;
        var tipo_v = document.getElementById("tipo_v").value;
        var codigo_p = document.getElementById("codigo_p").value;
        var metros = document.getElementById("metros").value;
        var od_v = document.getElementById("od_v").value;
        var nombre_z = document.getElementById("nombre_z").value;
        
        if(calle!="" && numero != "" && tipo_v!="" && codigo_p!="" && metros!=""
            && od_v!=""){
            var cadena = "vivinsertar.php?calle=" + encodeURIComponent(calle) +
                    "&numero="+numero +
                    "&tipo_v=" + tipo_v + "&codigo_p=" + codigo_p +
                    "&metros="+metros+
                    "&od_v=" + encodeURIComponent(od_v) + 
                    "&nombre_z=" + encodeURIComponent(nombre_z)
            viviendaconsulta(cadena);
        }
        
    }
    
    function modificaVivienda(){
        var calle = document.getElementById("calle").value;
        var callev = document.getElementById("callev").value;
        var numero = document.getElementById("numero").value;
        var numerov = document.getElementById("numerov").value;
        var tipo_v = document.getElementById("tipo_v").value;
        var codigo_p = document.getElementById("codigo_p").value;
        var metros = document.getElementById("metros").value;
        var od_v = document.getElementById("od_v").value;
        var nombre_z = document.getElementById("nombre_z").value;
        
        if(calle!="" && numero != "" && tipo_v!="" && codigo_p!="" && metros!=""
            && od_v!=""){
            var cadena = "vivactualizar.php?calle=" + encodeURIComponent(calle) +
                    "&numero="+numero +
                    "&tipo_v=" + tipo_v + "&codigo_p=" + codigo_p +
                    "&metros="+metros+
                    "&od_v=" + encodeURIComponent(od_v) + 
                    "&nombre_z=" + encodeURIComponent(nombre_z)+
                    "&callev=" + encodeURIComponent(callev) +
                    "&numerov="+numerov;
            viviendaconsulta(cadena);
        }
        
    }
</script>

<?php
include "pie.php";
?>