<html>
    <head>
        <title>BD Autobuses - Nuevo Autobús</title>
    </head>
    <body>
        <?php
        // Importamos las funciones necesarias.
        require_once './funciones.php';
        // Posible redirección si accedemos directamente.
        redirectMenu();
        // Establecemos una conexión PDO a la BD autobuses.
        $conex = getConnectionPDO('autobuses');
        // Banderas de validación.
        $f_matricula=false; $f_marca=false; $f_plazas=false;
        // Validaciones de campos.
        if (isset($_POST['agregar'])) {
            $f_matricula = isMatriculaValid($_POST['matricula']);
            $f_marca = preg_match('/^[a-zA-Z]+$/', $_POST['marca']);
            $f_plazas = preg_match('/^\d+$/', $_POST['plazas']);
        }
        ?>
        <h1>Nuevo autobús</h1>
        <form action="" method="POST">
            <p>Matrícula: <input type="text" name="matricula"></p>
            <p>Marca: <input type="text" name="marca"></p>
            <p>Nº plazas: <input type="text" name="plazas"></p>
            <input type="submit" name="agregar" value="Añadir">
        </form>
        <a href="index.html">Volver a Menú</a>
        <?php
        // Realizamos la consulta de inserción.
        
        ?>
    </body>
</html>
