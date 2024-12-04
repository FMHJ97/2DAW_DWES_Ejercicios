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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Juegos</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="login.php"><button class="btn btn-primary">Iniciar sesión</button></a>
                    <a href="registro.php"><button class="btn btn-primary">Registro</button></a>
                </div>
            </div>
            <div class="row">
                <?php
                // Mostramos las carátulas de todos los juegos.
                showAllGames($juegos);
                ?>
            </div>
        </div>
    </body>
</html>

<?php

/**
 * 
 */
function showAllGames($juegos) {
    foreach ($juegos as $juego) {
        echo "<div class='col'>";
        echo "<form action='' method='POST'>";
        echo "<input type='image' src='$juego->imagen' value='$juego->codigo' weight='200px' height='250px'>";
        echo "</form>";
        echo "</div>";
    }
}
?>
