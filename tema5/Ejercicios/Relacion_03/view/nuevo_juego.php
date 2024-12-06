<?php
// Importaciones.
require_once '../model/juego.php';
require_once '../controller/controllerJuego.php';
?>

<html>
    <head>
        <title>Nuevo juego - MVC (alquiler_juegos)</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col py-3">
                    <h1>Nuevo juego</h1>
                    <form action="" method="POST">
                        <div class="mb-3 mt-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Introduzca el nombre" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="anio" class="form-label">Año:</label>
                            <input type="text" class="form-control" id="anio" placeholder="Introduzca el año" name="year">
                        </div>
                        <div class="mb-3">
                            <label for="consola" class="form-label">Consola:</label>
                            <input type="text" class="form-control" id="consola" placeholder="Introduzca la consola" name="console">
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio:</label>
                            <input type="text" class="form-control" id="precio" placeholder="Introduzca el precio" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen:</label>
                            <input type="file" class="form-control" id="imagen" placeholder="Introduzca la imagen" name="image">
                        </div>
                        <button type="submit" name="insert" class="btn btn-success">Agregar juego</button>
                    </form>
                    <a href="inicio.php"><button class="btn btn-primary">Volver a Inicio</button></a>
                </div>
            </div>
        </div>
    </body>
</html>
