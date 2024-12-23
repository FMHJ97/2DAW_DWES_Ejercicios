<?php
// Importaciones.
require_once '../model/cliente.php';
require_once '../model/juego.php';
require_once '../controller/controllerJuego.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID'])) {
    session_start();
}

// Si existe sesión del Cliente, obtenemos los datos correspondientes.
if (isset($_SESSION['logueado'])) {
    $autenticado = $_SESSION['logueado'];
}

// Si existe sesión Logueado y pulsamos sobre Cerrar sesión.
if (isset($autenticado) && isset($_POST['logout'])) {
    // Cerramos la sesión actual.
    session_unset();
    session_destroy();
    setcookie("PHPSESSID", "", time() - 3600, "/"); // Eliminación en el cliente.
    // Volvemos a cargar la página.
    header("Location:inicio.php");
    exit();
}
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
                <div class="col pt-4 pb-2">
                    <?php
                    // Si existe un cliente logueado, mostramos botón de Cerrar sesión.
                    if (isset($autenticado)) {
                        ?>
                        <label for="form-logout">Hola, <?php echo $autenticado->nombre . " " . $autenticado->apellidos; ?></label>
                        <form class="d-inline-block ps-3" id="form-logout" action="" method="POST">
                            <button type="submit" name="logout" class="btn btn-dark">Cerrar sesión</button>
                        </form>
                        <?php
                    } else {
                        ?>
                        <a href="login.php"><button class="btn btn-info">Iniciar sesión</button></a>
                        <a href="registro.php"><button class="btn btn-info">Registro</button></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col pb-4">
                    <?php
                    // Si existe un cliente logueado, mostramos botón de Cerrar sesión.
                    if (isset($autenticado)) {
                        ?>
                        <a href="inicio.php"><button class="btn btn-primary">Todos</button></a>
                        <a href="mis_alquilados.php"><button class="btn btn-primary">Mis alquilados</button></a>
                        <a href="no_alquilados.php"><button class="btn btn-primary">No alquilados</button></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            if (isset($autenticado) && $autenticado->tipo === "admin") {
                ?>
                <div class="row">
                    <div class="col pb-4">
                        <a href="nuevo_juego.php"><button class="btn btn-danger">Nuevo juego</button></a>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="row">
                <div class="col pb-5">
                    <h1>Juegos</h1>
                </div>
            </div>
            <?php ?>
            <div class="row row-cols-4">
                <?php
                // Mostramos las carátulas de todos los juegos.
                showAllGames(ControllerJuego::getAll());
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
    if ($juegos) {
        foreach ($juegos as $juego) {
            echo "<div class='col mb-4'>";
            echo "<form action='ficha_juego.php' method='POST'>";
            echo "<input type='hidden' name='cod_juego' value='$juego->codigo'>";
            echo "<input type='image' src='$juego->imagen' weight='200px' height='250px'>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "NO HAY JUEGOS EN LA BD!";
    }
}
?>
