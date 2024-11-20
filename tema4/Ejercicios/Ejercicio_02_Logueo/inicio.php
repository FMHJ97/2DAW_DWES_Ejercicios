<?php
// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID'])) session_start ();

// Si pulsamos sobre el botón Salir.
if (isset($_POST['exit']) && isset($_SESSION['credenciales'])) {
    // Cerramos la sesión actual.
    session_unset();
    session_destroy();
    setcookie("PHPSESSID", "", time()-3600, "/"); // Eliminación en el cliente.
    // Realizamos la redirección a index.
    header("Location:index.php");
    exit();
}
// Si pulsamos sobre el botón Ver más datos.
else if (isset($_POST['show']) && isset($_SESSION['credenciales'])) {
    header("Location:datos.php");
    exit();
}
// Si pulsamos sobre el botón Modificar datos.
else if (isset($_POST['modify']) && isset($_SESSION['credenciales'])) {
    header("Location:modificar.php");
    exit();
}

// Posible redirección.
if (!isset($_SESSION['credenciales'])) {
    header("Location:index.php");
    exit();
} else {
    // Guardamos el usuario autenticado en variable.
    $autenticado = $_SESSION['credenciales'];
}
?>
<html>
    <head>
        <title>Ejercicio 2: Logueo - Inicio</title>
        <?php
        if (isset($_SESSION['credenciales'])) {
            echo "<style>";
            echo "body {";
            echo "color: $autenticado->color_letra;";
            echo "background-color: $autenticado->color_fondo;";
            echo "font-family: $autenticado->tipo_letra;";
            echo "font-size: $autenticado->tam_letra;";
            echo "}";
            echo "</style>";
        }
        ?>
    </head>
    <body>
        <h1>Hola, <?php if (isset($_SESSION['credenciales'])) echo $autenticado->nombre." ".$autenticado->apellidos; ?>!</h1>
        <h2>Bienvenid@ a nuestra web!</h2>
        <form action="" method="POST">
            <input type="submit" name="show" value="Ver más datos">
            <input type="submit" name="modify" value="Modificar datos">
            <input type="submit" name="exit" value="Salir">
        </form>
    </body>
</html>
