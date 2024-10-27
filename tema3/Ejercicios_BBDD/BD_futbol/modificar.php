<html>
<head>
    <title>BD futbol - Modificar jugador</title>
</head>
<body>
    <?php
    require_once 'funciones.php';
    redirectIfIdMissing();

    // Variables de validación
    $f_dni = $f_nombre = $f_dorsal = $f_posicion = $f_equipo = $f_goles = false;

    // Validación de datos
    if (isset($_POST['search'])) {
        $f_dni = isDniValid($_POST['dni']);
    }

    // Procesamiento del formulario de modificación
    if (isset($_POST['modificar'])) {
        $f_dni = isDniValid($_POST['dni']);
        $f_nombre = !empty($_POST['nombre']) && preg_match("/^[a-zA-Z ]+$/", $_POST['nombre']);
        $f_dorsal = in_array($_POST['dorsal'], range(1, 11));
        $f_posicion = isset($_POST['posicion']) && is_array($_POST['posicion']) && count($_POST['posicion']) > 0;
        $f_equipo = !empty($_POST['equipo']);
        $f_goles = is_numeric($_POST['goles']);

        if ($f_dni && $f_nombre && $f_dorsal && $f_posicion && $f_equipo && $f_goles) {
            try {
                $conex = getConnection('futbol');
                $stmt = $conex->prepare("UPDATE jugador SET nombre = ?, dorsal = ?, posicion = ?, equipo = ?, goles = ? WHERE DNI = ?");
                $posicion = implode(',', $_POST['posicion']);
                $stmt->bind_param('sissss', $_POST['nombre'], $_POST['dorsal'], $posicion, $_POST['equipo'], $_POST['goles'], $_POST['dni']);
                $stmt->execute();
                echo "<p><span style='color:green;font-weight:bold'>¡Jugador modificado correctamente!</span></p>";
                $stmt->close();
            } catch (Exception $ex) {
                die("Error al modificar el jugador: " . $ex->getMessage());
            }
        } else {
            echo "<p><span style='color:red;font-weight:bold'>Corrige los errores antes de modificar.</span></p>";
        }
    }
    ?>

    <h1>Modificar jugador</h1>
    <form action="" method="POST">
        <p>Buscar jugador (DNI):
            <input type="text" name="dni" value="<?php echo isset($_POST['dni']) ? htmlspecialchars($_POST['dni']) : ''; ?>">
            <?php if (isset($_POST['search']) && !$f_dni) echo "<span style='color:red'>Debe tener 8 números y una letra al final.</span>"; ?>
        </p>
        <input type="submit" name="search" value="Buscar">
        <a href="index.php"><input type="button" name="inicio" value="Inicio"></a>
        <br>

        <?php
        if (isset($_POST['search']) && $f_dni) {
            try {
                $conex = getConnection('futbol');
                $stmt = $conex->prepare("SELECT * FROM jugador WHERE DNI = ?");
                $stmt->bind_param('s', $_POST['dni']);
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    if ($result->num_rows) {
                        $row = $result->fetch_assoc();
                        $_POST['nombre'] = isset($_POST['nombre']) ? $_POST['nombre'] : $row['nombre'];
                        $_POST['dorsal'] = isset($_POST['dorsal']) ? $_POST['dorsal'] : $row['dorsal'];
                        $_POST['posicion'] = isset($_POST['posicion']) ? $_POST['posicion'] : explode(',', $row['posicion']);
                        $_POST['equipo'] = isset($_POST['equipo']) ? $_POST['equipo'] : $row['equipo'];
                        $_POST['goles'] = isset($_POST['goles']) ? $_POST['goles'] : $row['goles'];
                        ?>

                        <p>DNI: <input type="text" name="dni" value="<?php echo htmlspecialchars($_POST['dni']); ?>" readonly></p>
                        <p>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($_POST['nombre']); ?>">
                            <?php if (isset($_POST['modificar']) && !$f_nombre) echo "<span style='color:red'>No puede estar vacío. Sólo letras.</span>"; ?>
                        </p>
                        <p>Dorsal:
                            <select name="dorsal">
                                <?php for ($i = 1; $i <= 11; $i++) { ?>
                                    <option value="<?php echo $i; ?>" <?php if ($_POST['dorsal'] == $i) echo "selected"; ?>><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </p>
                        <p>Posición:
                            <select name="posicion[]" multiple>
                                <option value="Portero" <?php if (in_array("Portero", $_POST['posicion'])) echo "selected"; ?>>Portero</option>
                                <option value="Defensa" <?php if (in_array("Defensa", $_POST['posicion'])) echo "selected"; ?>>Defensa</option>
                                <option value="Centrocampista" <?php if (in_array("Centrocampista", $_POST['posicion'])) echo "selected"; ?>>Centrocampista</option>
                                <option value="Delantero" <?php if (in_array("Delantero", $_POST['posicion'])) echo "selected"; ?>>Delantero</option>
                            </select>
                            <?php if (isset($_POST['modificar']) && !$f_posicion) echo "<span style='color:red'>Seleccione una o varias posiciones.</span>"; ?>
                        </p>
                        <p>Equipo: <input type="text" name="equipo" value="<?php echo htmlspecialchars($_POST['equipo']); ?>">
                            <?php if (isset($_POST['modificar']) && !$f_equipo) echo "<span style='color:red'>No puede estar vacío.</span>"; ?>
                        </p>
                        <p>Número de goles: <input type="text" name="goles" value="<?php echo htmlspecialchars($_POST['goles']); ?>">
                            <?php if (isset($_POST['modificar']) && !$f_goles) echo "<span style='color:red'>Sólo números.</span>"; ?>
                        </p>
                        <input type="submit" name="modificar" value="Modificar">

                        <?php
                    } else {
                        echo "<p><span style='font-weight:bold;color:red'>No se ha encontrado un jugador con ese DNI.</span></p>";
                    }
                }
                $conex->close();
            } catch (Exception $ex) {
                die("Error al buscar el jugador: " . $ex->getMessage());
            }
        }
        ?>
    </form>
</body>
</html>
