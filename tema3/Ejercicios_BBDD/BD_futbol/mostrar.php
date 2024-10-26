<html>
    <head>
        <title>BD futbol - Mostrar datos</title>
    </head>
    <style>
        table, th, td {
            border-collapse: collapse;
            border: 1px solid black;
        }
        th, td {
            padding: 0.5em;
            text-align: center;
        }
        th {
            background-color: lightblue;
        }
    </style>
    <body>
        <?php
        // Importamos funciones necesarias.
        require_once 'funciones.php';
        
        // Redirigimos a index.php si es necesario.
        redirectIfIdMissing();
        ?>
        
        <h1>Lista de jugadores</h1>
        
        <?php   
        // Obtenemos una conexión a la BD.
        $conex = getConnection("futbol");
        
        try {
            // Realizamos una consulta para obtener los registros.
            $result = $conex->query("SELECT * FROM jugador");
            // Si existen registros, procedemos a mostrarlos.
            if ($result->num_rows) {
                showDataJugadorTable($result);
            } else {
                echo "<p><span style='font-weight:bold'>NO HAY JUGADORES EN LA BD!</span></p>";
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        // Cerramos la conexión.
        $conex->close();
        ?>
        <br>
        <a href="index.php"><input type="button" name="inicio" value="Inicio"></a>
    </body>
</html>
