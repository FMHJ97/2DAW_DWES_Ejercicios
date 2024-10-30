<!DOCTYPE html>
<html>
    <head>
        <title>BD futbol - Menú</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        // En caso de que se realice un insertado, borrado o modificación
        // correcta, mostrará un mensaje.
        if (isset($_REQUEST['msg'])) {
            echo "<span style='color: green; font-weight: bold'>".$_REQUEST['msg']."</span>";
        }
        ?>
        <h1>Menú</h1>
        <a href="introducir.php?id=1">1.- Introducir datos</a><br><br>
        <a href="mostrar.php?id=2">2.- Mostrar datos</a><br><br>
        <a href="buscar.php?id=3">3.- Buscar datos</a><br><br>
        <a href="modificar.php?id=4">4.- Modificar datos</a><br><br>
        <a href="borrar.php?id=5">5.- Borrar datos</a>
    </body>
</html>