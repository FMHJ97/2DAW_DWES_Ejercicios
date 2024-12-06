<?php
// Importaciones.
require_once '../model/juego.php';
require_once '../model/alquiler.php';
require_once '../controller/controllerJuego.php';
require_once '../controller/controllerAlquiler.php';

// Obtenemos los datos del juego seleccionado en Inicio.
if (isset($_POST['cod_juego'])) {
    // Guardamos el juego en la sesión.
    session_start();
    $_SESSION['juego'] = ControllerJuego::getJuegoById($_POST['cod_juego']);
    // Sacamos el juego de la sesión.
    $juego = $_SESSION['juego'];
}

// Si no existe un juego en la sesión.
if (!isset($_SESSION['juego'])) {
    // Volvemos a cargar la página.
    header("Location:inicio.php");
}

// Si pulsamos sobre Alquilar.
if (isset($_POST['rent'])) {
    // Volvemos a cargar la página.
    header("Location:registro.php");
}

// Si pulsamos sobre Volver a Inicio.
if (isset($_POST['go_back'])) {
    // Eliminamos solo el juego de la sesión.
    unset($_SESSION['juego']);
    // Redirigimos a Inicio.
    header("Location:inicio.php");
    exit();
}
?>

<html>
    <head>
        <title>Ficha juego - MVC (alquiler_juegos)</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col pt-3 pb-5">
                    <h1>Ficha juego</h1>
                    <form action="" method="POST">
                        <button type="submit" name="go_back" class="btn btn-dark">Volver a Inicio</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <!-- Columna izquierda -->
                <div class="col-4 text-center">
                    <div class="row d-flex flex-column">
                        <!-- Imagen -->
                        <div class="col pb-4">
                            <img src="<?php echo $juego->imagen; ?>" width="300px" height="350px" alt="Imagen de Juego"/>
                        </div>
                        <!-- Acciones -->
                        <div class="col">
                            <?php
                            // Si el juego no está alquilado, mostramos botón.
                            if (strcasecmp($juego->alquilado, "no") === 0) {
                                ?>
                                <form action="" method="POST">
                                    <button type="submit" name="rent" class="btn btn-primary w-50 fs-4">Alquilar</button>
                                </form>
                                <?php
                            } else {
                                // En caso contrario, mostramos mensaje y fecha de devolución.
                                $alquiler = ControllerAlquiler::getAlquilerByJuegoAlquilado($juego->codigo);
                                // Por defecto, el alquiler son de 7 días contando desde el día de alquiler.
                                //
                                // Le sumamos 7 días a la fecha de alquiler del juego seleccionado.
                                $fecha_7_dias = strtotime("+7 days", strtotime($alquiler->fecha_alquiler));
                                // Obtenemos una fecha con el formato deseado.
                                $fecha_devolucion = date("d-m-Y", $fecha_7_dias);
                                
                                echo "<div>";
                                echo "<p><strong>El juego está alquilado!</strong></p>";
                                echo "<p><strong>Fecha de devolución prevista:</strong> $fecha_devolucion</p>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Columna derecha - Detalles -->
                <div class="col-8">
                    <h2>Datos</h2>
                    <form action="" method="POST">
                        <div class="my-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="name" 
                                   value="<?php echo $juego->nombre_juego; ?>">
                        </div>
                        <div class="my-3">
                            <label for="anio" class="form-label">Año:</label>
                            <input type="text" class="form-control" id="anio" name="year" 
                                   value="<?php echo $juego->anio; ?>">
                        </div>
                        <div class="my-3">
                            <label for="consola" class="form-label">Consola:</label>
                            <input type="text" class="form-control" id="consola" name="console" 
                                   value="<?php echo $juego->nombre_consola; ?>">
                        </div>
                        <div class="my-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea id="descripcion" class="form-control" name="details" rows="3" cols="5"><?php echo $juego->descripcion; ?></textarea>
                        </div>        
                        <div class="my-3">
                            <label for="precio" class="form-label">Precio(€):</label>
                            <input type="text" class="form-control" id="precio" name="price" 
                                   value="<?php echo $juego->precio; ?>">
                        </div>                               
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
