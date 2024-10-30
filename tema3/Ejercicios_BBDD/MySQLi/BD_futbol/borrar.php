<html>
    <head>
        <title>BD futbol - Borrar jugador</title>
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
        // Importamos las funciones necesarias.
        require_once 'funciones.php';
        // Redirección(?).
        redirectIfIdMissing();
        
        // Validation flags.
        $f_dni=false;
        
        // Data validation.
        if (isset($_POST['search'])) $f_dni = isDniValid($_POST['dni']);        
        ?>
        
        <h1>Borrar jugador</h1>
        <form action="" method="POST">
            <p>Buscar jugador (DNI): 
                <input type="text" name="dni"
                       value="<?php if (isset($_POST['search']) && $f_dni) echo $_POST['dni']; ?>">
                <!-- Show error -->
                <?php if (isset($_POST['search']) && !$f_dni) echo "<span style='color:red'>Debe tener 8 números y una letra al final.</span>"; ?>
            </p>
            <input type="submit" name="search" value="Buscar">
            <a href="index.php"><input type="button" name="inicio" value="Inicio"></a>
            <br>
        </form>            
        <?php
        // Mostramos los posibles resultados de la búsqueda.
        if (isset($_POST['search']) && $f_dni) {
            try {
                // Conexión a la BD.
                $conex = getConnection('futbol');
                // Realizamos la consulta.
                $result = $conex->query("SELECT * FROM jugador WHERE DNI = '$_POST[dni]'");
                // Si existe un registro, procedemos a mostrarlo.
                if ($result->num_rows) {
                    // Mostramos el registro.
                    echo "<h2>Resultados</h2>";
                    showDataJugadorTable($result);
                    // Botón de borrado.
                    echo "<form action='' method='POST'>";
                    echo "<br><input type='submit' name='delete' value='Borrar'>";
                    // Mantenemos el valor DNI introducido.
                    echo "<input type='hidden' name='dni' value='$_POST[dni]'>";
                    echo "</form>";
                } else {
                    echo "<p><span style='font-weight:bold'>NO EXISTE UN JUGADOR CON DNI($_POST[dni]) EN LA BD!</span></p>";
                }
                // Cerramos la conexión.
                $conex->close();
            } catch (Exception $ex) {
                die ("<br>Se ha producido un error: ".$ex->getMessage());
            }
        }
        
        // Si pulsamos sobre Borrar, se borrará el registro y nos redirigiremos a index.php
        if (isset($_POST['delete'])) {
            try {
                $conex = getConnection('futbol');
                $conex->query("DELETE FROM jugador WHERE DNI = '$_POST[dni]'");
                $conex->close();
                // Llegados a este punto, se ha realizado el borrado del registro.
                header("Location: index.php?msg=REGISTRO BORRADO CORRECTAMENTE!");                             
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        }        
        ?>
    </body>
</html>
