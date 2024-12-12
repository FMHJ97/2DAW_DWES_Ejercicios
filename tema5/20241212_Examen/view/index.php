<?php
require_once '../model/agencia.php';
require_once '../controller/controllerAgencia.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID'])) session_start();

// Si existe una sesión Logueado, redirigimos a menu.
if (isset($_SESSION['logueado'])) {
    header("Location:menu.php");
    exit();
}

// Pulsamos sobre Iniciar sesión.
if (isset($_POST['login'])) {
    // Si los campos de texto NO ESTÁN vacíos.
    if (!empty($_POST['user']) && !empty($_POST['pwd'])) {
        // Obtenemos la agencia introducida.
        $agencia = ControllerAgencia::findById($_POST['user']);
        // Comparamos la clave introducida.
        if (password_verify($_POST['pwd'], $agencia->pass)) {
            // Vamos a establecer un tiempo de vida a la sesión.
            ini_set("session.gc_maxlifetime", 1800);
            // Establece un tiempo de expiración de 1800 segundos para la cookie de sesión.
            session_set_cookie_params(1800);
            session_start();
            $_SESSION['logueado'] = $agencia;

            header("Location:menu.php");
            exit();
        } else {
            // Mensaje de error.
            $msg = "<br><br><span style='color:red'>USUARIO O CLAVE INCORRECTA!</span>";
        }
    } else {
        // Mensaje de error.
        $msg = "<br><br><span style='color:red'>USUARIO O CLAVE INCORRECTA!</span>";
    }
}
?>

<html>
    <head>
        <title>Examen DWES - Trenes (Login)</title>
    </head>
    <body>
        <h1>Iniciar sesión</h1>
        <form action="" method="POST">
            <p>Usuario: <input type="text" name="user"></p>
            <p>Pass: <input type="password" name="pwd"></p>
            <button type="submit" name="login">Iniciar sesión</button>
        </form>
        <!-- Mostramos el mensaje de error -->
        <?php if (isset($_POST['login']) && isset($msg)) echo $msg; ?>
    </body>
</html>