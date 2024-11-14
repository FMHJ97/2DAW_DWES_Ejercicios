<?php
// Propagamos la sesión.
session_start();

// Posible redirección.
if (!isset($_SESSION['credenciales'])) {
    header("Location:index.php");
    exit();
} else {
    // Sacamos el nombre y apellidos del usuario autenticado.
    $full_name = $_SESSION['credenciales']->nombre." ".$_SESSION['credenciales']->apellidos;
}
?>
<html>
    <head>
        <title>Ejercicio 2: Logueo - Inicio</title>
    </head>
    <body>
        <a href="index.php">Salir</a>
        <h1>Hola, <?php if (isset($_SESSION['credenciales'])) echo $full_name; ?>!</h1>
        <h2>Bienvenid@ a nuestra web!</h2>
        <a href="datos.php"><input type="button" value="Ver más datos"></a>
        <a href="modificar.php"><input type="button" value="Modificar datos"></a>
    </body>
</html>
