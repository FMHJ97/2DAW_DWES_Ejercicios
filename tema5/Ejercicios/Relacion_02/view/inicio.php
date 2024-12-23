<?php
require_once '../controller/conexion.php';
require_once '../controller/controllerEmpleado.php';
require_once '../controller/controllerTarea.php';
require_once '../controller/controllerRealiza.php';
require_once '../model/empleado.php';
require_once '../model/tarea.php';
require_once '../model/realiza.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID'])) session_start();

// Si no existe sesión, redirigir a Index
if (!isset($_SESSION['logueado'])) {
    header("Location:index.php");
    exit();
} else {
    $autenticado = $_SESSION['logueado'];
}

// Si pulsamos sobre Cerrar sesión.
if (isset($_POST['logout'])) {
    // Eliminamos todo rastro de la sesión actual.
    session_unset();
    session_destroy();
    setcookie("PHPSESSID", "", time() - 3600, "/"); // Eliminación en el cliente.
    // Volvemos a login.
    header("Location:index.php");
    exit();
}
?>

<html>
    <head>
        <title>Inicio (MVC - Empleados)</title>
    </head>
    <body>
        <h1>Inicio</h1>
        <p>Bienvenido, <?php echo isset($autenticado)?$autenticado->nombre:""; ?></p>
        <form action="" method="POST">
            <button type="submit" name="logout">Cerrar sesión</button>
        </form>
        <div>
            <a href="nueva_tarea.php">1.- Nueva tarea</a><br>
            <a href="actualiza_tarea.php">2.- Actualizar tarea</a>
        </div>
    </body>
</html>
