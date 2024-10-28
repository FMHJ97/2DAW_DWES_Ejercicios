<html>
    <head>
        <title>BD futbol - Modificar jugador</title>
    </head>
    <body>
        <?php
        require_once 'funciones.php';
        // Posible redirección.
        redirectIfIdMissing();
        
        // Validation flags.
        $f_dni=false; $f_nombre=false; $f_dorsal=false; $f_posicion=false;
        $f_equipo=false; $f_goles=false;
        $main_flag=false;
        
        // DNI validation after 'Search'.
        if (isset($_POST['search'])) {
            if (isDniValid($_POST['dni'])) $f_dni=true;
        }
        ?>
        
        <h1>Modificar jugador</h1>
        <form action="" method="POST">
            <p>Introducir jugador (DNI): <input type="text" name="dni"></p>
            <input type="submit" name="search" value="Buscar">
        </form>
        
        <?php
        // Procedemos a buscar el posible registro.
        if (isset($_POST['search']) && $f_dni) {
            // Conexión a la BD.
            $conex = getConnection('futbol');
            // Realizamos la consulta.
            try {
                $stmt=$conex->prepare("SELECT * FROM jugador WHERE DNI = ?");
                $stmt->bind_param('s', $_POST['dni']);
                // Procedemos a ejecutar la consulta.
                if ($stmt->execute()) {
                    // Obtenemos los resultados de la consulta.
                    $result=$stmt->get_result();
                    // Comprobamos si ha devuelto filas.
                    if ($result->num_rows) {
                        // Obtenemos el objeto.
                        $row = $result->fetch_object();
                        //Mostramos el formulario de Modificar.
                        ?>
        
        
        
                        <?php
                    } else {
                        echo "<p><span style='font-weight:bold'>NO EXISTE UN JUGADOR CON ESE DNI EN LA BD!</span></p>";
                    }
                }
                // Cerramos la conexión.
                $conex->close();
            } catch (Exception $ex) {
                die("Error en la consulta a la BD: ".$ex->getMessage());
            }
        }
        ?>
    </body>
</html>
