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
// Si pulsamos sobre el botón Volver.
else if (isset($_POST['back']) && isset($_SESSION['credenciales'])) {
    header("Location:inicio.php");
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
        <title>Ejercicio 2: Logueo - Datos</title>
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
        <h2>Tus datos son:</h2>
        <?php
        // Realizamos un bucle for-each para sacar todos los datos del usuario.
        foreach ($autenticado as $key => $value) {
            if ($key != "pass") echo "<p>$key: $value</p>";
        }
        ?>
        <form action="" method="POST">
            <input type="submit" name="back" value="Volver">
            <input type="submit" name="exit" value="Salir">
        </form>
    </body>
</html>