<html>
    <head>
        <title>BD futbol - Introducir datos</title>
    </head>
    <body>
        
        <?php
        // Redirigimos al index en caso de entrar directamente aquí.
        if (!isset($_GET['id'])) {
            header("Location: index.php");
            exit();
        }
        
        // Validation flags.
        $f_dni=false; $f_nombre=false; $f_dorsal=false; $f_posicion=false;
        $f_equipo=false; $f_goles=false;
        $main_flag=false;
        
        // Comprobamos si cumplen los requisitos de los campos.
        if(isset($_POST['insertar'])) {
            // Format validation.
            if (preg_match('/^\d{8}[a-zA-Z]$/', $_POST['dni'])) $f_dni=true;
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
        
        <h1>Introducir datos</h1>
        <form action="" method="POST">
            <p>DNI: <input type="text" name="dni" value="<?php if ($f_dni) echo $_POST['dni']; ?>">
                <!--Show error-->
                <?php if (isset($_POST['insertar']) && !$f_dni) echo "<span style='color:red'>Debe tener 8 números y una letra al final.</span>"; ?>
            </p>
            <p>Nombre: <input type="text" name="nombre" value="<?php if ($f_nombre) echo $_POST['nombre']; ?>">
                <!--Show error-->
                <?php if (isset($_POST['insertar']) && !$f_nombre) echo "<span style='color:red'>No puede estar vacío. Sólo letras.</span>"; ?>                
            </p>
            <p>Dorsal: 
                <select name="dorsal">
                    <?php
                    for ($i = 1; $i <= 11; $i++) {
                        ?>
                    <option value="<?php echo $i; ?>" <?php if ($f_dorsal && $_POST['dorsal'] == $i) echo "selected"; ?>><?php echo $i; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>Posición:
                <select name="posicion[]" multiple="">
                    <option value="Portero"
                            <?php if ($f_posicion && in_array("Portero", $_POST['posicion'])) echo "selected"; ?>>Portero</option>
                    <option value="Defensa"
                            <?php if ($f_posicion && in_array("Defensa", $_POST['posicion'])) echo "selected"; ?>>Defensa</option>
                    <option value="Centrocampista"
                            <?php if ($f_posicion && in_array("Centrocampista", $_POST['posicion'])) echo "selected"; ?>>Centrocampista</option>
                    <option value="Delantero"
                            <?php if ($f_posicion && in_array("Delantero", $_POST['posicion'])) echo "selected"; ?>>Delantero</option>
                </select>
                <!-- Show Error -->
                <?php if (isset($_POST['insertar']) && !$f_posicion) echo "<span style='color:red'>Seleccione una o varias posiciones.</span>"; ?>                    
            </p>
            <p>Equipo: <input type="text" name="equipo" value="<?php if ($f_equipo) echo $_POST['equipo']; ?>">
                <!-- Show Error -->
                <?php if (isset($_POST['insertar']) && !$f_equipo) echo "<span style='color:red'>No puede estar vacío.</span>"; ?>
            </p>
            <p>Número de goles: <input type="text" name="goles" value="<?php if ($f_goles) echo $_POST['goles']; ?>">
                <!-- Show Error -->
                <?php if (isset($_POST['insertar']) && !$f_goles) echo "<span style='color:red'>No puede estar vacio. Sólo números.</span>"; ?>
            </p>
            <input type="submit" name="insertar" value="Insertar">
            <a href="index.php"><input type="button" name="inicio" value="Inicio"></a>
        </form>        
        
        <?php
        // En caso de pulsar Insertar y todo validado, insertamos el registro.
        if (isset($_POST['insertar']) && $main_flag) {
            // Inicializamos una conexión a la BD.
            try {
                $conex = new mysqli("localhost","dwes","abc123.","futbol");
                $conex->set_charset("utf8mb4");
            } catch (Exception $ex) {
                die("ERROR. NO SE HA PODIDO CONECTAR A LA BD.");
            }
            // Realizamos la consulta.
            try {
                // Obtenemos las posiciones seleccionadas.
                $posiciones= implode(",", $_POST['posicion']);
                
                $conex->query(
                        "INSERT INTO jugador VALUES ('$_POST[dni]','$_POST[nombre]',$_POST[dorsal],'$posiciones','$_POST[equipo]',$_POST[goles])");     
            
                
            } catch (Exception $ex) {
                if ($ex->getCode() == 1062) die("ERROR. EXISTE UN REGISTRO CON EL MISMO DNI.");
                die($ex->getMessage());
            }
            // Llegados a este punto, se ha realizado la inserción.
            // Mostramos el mensaje en el menú principal (index.php).
            header("Location: index.php?msg=REGISTRO INSERTADO CORRECTAMENTE!");             
            $conex->close();             
        }
        ?>       
    </body>
</html>
