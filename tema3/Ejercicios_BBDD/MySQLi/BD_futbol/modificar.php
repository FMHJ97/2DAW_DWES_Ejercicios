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
        
        // Modificar data validation.
        if(isset($_POST['modificar'])) {
            // Format validation.
            if (isDniValid($_POST['dni'])) $f_dni=true;
            if (preg_match('/^([a-zA-Z]+\s?)+$/', $_POST['nombre'])) $f_nombre=true;
            if (isset($_POST['dorsal'])) $f_dorsal=true;
            if (isset($_POST['posicion'])) $f_posicion=true;
            if (preg_match('/^([a-zA-Z]+\s?)+$/', $_POST['equipo'])) $f_equipo=true;
            if (preg_match('/^\d+$/', $_POST['goles'])) $f_goles=true;
            
            // Main validation.
            if ($f_dni && $f_nombre && $f_dorsal && $f_posicion && $f_equipo && $f_goles) {
                $main_flag = true;
            }
        }
        ?>
        
        <h1>Modificar jugador</h1>
        <form action="" method="POST">
            <p>Introducir jugador (DNI): <input type="text" name="dni">
                <!--Show error-->
                <?php if (isset($_POST['search']) && !$f_dni) echo "<span style='color:red'>Error. Introduzca 8 números y 1 letra.</span>"; ?>                            
            </p>
            <input type="submit" name="search" value="Buscar">
            <a href="index.php"><input type="button" name="inicio" value="Inicio"></a>
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
                        // Obtenemos el registro como un objeto objeto.
                        $registro = $result->fetch_object();
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
        
        // Mostramos el formulario para modificar el registro.
        if (isset($registro) || (isset($_POST['modificar']) && !$main_flag)) {
            ?>
            <hr>
            <form action="" method="POST">
                <p>DNI: <input type="text" name="dni" value="<?php echo $registro->DNI; ?>" readonly="">
                </p>
                <p>Nombre: <input type="text" name="nombre" value="<?php echo $registro->Nombre; ?>">
                </p>
                <p>Dorsal: 
                    <select name="dorsal">
                        <?php
                        for ($i = 1; $i <= 11; $i++) {
                            ?>
                        <option value="<?php echo $i; ?>" <?php if ($registro->Dorsal == $i) echo "selected"; ?>><?php echo $i; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </p>
                <?php
                // Convertimos la posición a un array.
                $posiciones = is_array($registro->Posicion) ? $registro->Posicion : explode(',', $registro->Posicion);
                ?>
                <p>Posición:
                    <select name="posicion[]" multiple="">
                        <option value="Portero"
                                <?php if (in_array("Portero", $posiciones)) echo "selected"; ?>>Portero</option>
                        <option value="Defensa"
                                <?php if (in_array("Defensa", $posiciones)) echo "selected"; ?>>Defensa</option>
                        <option value="Centrocampista"
                                <?php if (in_array("Centrocampista", $posiciones)) echo "selected"; ?>>Centrocampista</option>
                        <option value="Delantero"
                                <?php if (in_array("Delantero", $posiciones)) echo "selected"; ?>>Delantero</option>
                    </select>
                </p>
                <p>Equipo: <input type="text" name="equipo" value="<?php echo $registro->Equipo; ?>">
                </p>
                <p>Número de goles: <input type="text" name="goles" value="<?php echo $registro->Goles; ?>">
                </p>
                <input type="submit" name="modificar" value="Modificar">
                <input type="hidden" name="dni" value="<?php echo $registro->DNI; ?>">
            </form>        
            <?php
        }
        
        // Procedemos a realizar la consulta si hemos pulsado Modificar.
        if (isset($_POST['modificar']) && $main_flag) {
            // Conexión a la BD.
            $conex= getConnection('futbol');
            // Realizamos la consulta.
            try {
                $stmt=$conex->prepare(
                        "UPDATE jugador SET Nombre = ?, Dorsal = ?, Posicion = ?, Equipo = ?, Goles = ? "
                        . "WHERE DNI = ?");
                
                // Convertimos el array Posiciones a string.
                $posicion = implode(',', $_POST['posicion']);
                
                // Agregamos los parámetros a la consulta.
                $stmt->bind_param('sissis',
                        $_POST['nombre'],
                        $_POST['dorsal'],
                        $posicion,
                        $_POST['equipo'],
                        $_POST['goles'],
                        $_POST['dni']);
                
                if ($stmt->execute()) {
                    // Llegados a este punto, se ha realizado el borrado del registro.
                    header("Location: index.php?msg=REGISTRO MODIFICADO CORRECTAMENTE!");                             
                } else {
                    echo "ERROR. NO SE HA PODIDO MODIFICAR EL REGISTRO!";
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
