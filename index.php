

<?php
session_start();
$titulo='CATASTRO DESDE INDEX';
include "encabezado.php";
if(isset($_POST["user"]))
{
    $_SESSION["usuario"]=$_POST["user"];
}

echo "<p>HOLA {$_SESSION['usuario']}</p>";
?>
<fieldset><legend>Ingrese su nombre</legend>
    <form action="index.php" method="POST">
        <input type="text" class="textEntry" name="user" 
            placeholder="Ingrese su primer nombre">
        <input type="submit" value="Iniciar Usario">
    </form>
</fieldset>
<?php
include "pie.php"
?>