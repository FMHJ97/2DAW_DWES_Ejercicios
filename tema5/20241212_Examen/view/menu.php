<?php
// Importamos
require_once '../model/agencia.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID']))
    session_start();

// Si existe sesión de la Agencia, obtenemos los datos correspondientes.
if (isset($_SESSION['logueado'])) {
    $agencia = $_SESSION['logueado'];
} else {
    header("Location:index.php");
    exit();
}

if (isset($agencia) && isset($_POST['logout'])) {
    // Cerramos la sesión actual.
    session_unset();
    session_destroy();
    setcookie("PHPSESSID", "", time() - 3600, "/"); // Eliminación en el cliente.
    // Volvemos a cargar la página.
    header("Location:index.php");
    exit();
}

?>

<html>
    <head>
        <title>Examen DWES - Trenes (Menú)</title>
    </head>
    <body>
        <h1>Menú</h1>
        <p>Agencia: <?php echo isset($agencia) ? $agencia->nombre : ""; ?></p>
        <p>Teléfono: <?php echo isset($agencia) ? $agencia->telf : ""; ?></p>
        <form action="" method="POST">
            <button type="submit" name="logout">Cerrar sesión</button>
        </form>
        <div>
            <br>
            <a href="reservas.php">1.- Reservas</a><br>
            <a href="billetes.php">2.- Consulta billetes</a>
        </div>
    </body>
</html>
