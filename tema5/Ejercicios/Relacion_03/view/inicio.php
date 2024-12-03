<?php
// Importaciones.
require_once '../model/alquiler.php';
require_once '../model/cliente.php';
require_once '../model/juego.php';
require_once '../controller/controllerAlquiler.php';
require_once '../controller/controllerCliente.php';
require_once '../controller/controllerJuego.php';

// Obtenemos todos los juegos en la BD.
$juegos = ControllerJuego::getAll();
?>

<html>
    <head>
        <title>Inicio - MVC (alquiler_juegos)</title>
    </head>
    <body>
        <h1>Juegos</h1>
        <?php
        // Mostramos las carátulas de todos los juegos.
        foreach ($juegos as $juego) {
            echo "<div>";
            echo "<form action='' method='POST'>";
            echo "<button type='submit' value='$juego->codigo'>";
            echo "<img src='$juego->imagen'>";
            echo "</button>";
            echo "</form>";
            echo "</div>";
        }
        ?>
    </body>
</html>
