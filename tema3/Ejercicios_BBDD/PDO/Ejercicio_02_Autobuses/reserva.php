<html>
    <head>
        <title>BD autobuses - Reserva viaje</title>
    </head>
    <body>
        <?php
        // Importamos las funciones necesarias.
        require_once './funciones.php';
        // Posible redirección si accedemos directamente.
        redirectMenu();
        // Establecemos una conexión PDO a la BD autobuses.
        $conex = getConnectionPDO('autobuses');
        // Banderas de validación (Primer formulario).
        $f_fecha=false; $f_origen=false; $f_destino=false;
        // Bandera de validación donde Origen != Destino.
        $f_localizacion=false;
        // Bandera principal.
        $f_principal=false;
        // Validación de campos.
        if (isset($_POST['consultar'])) {
            $f_fecha = isFechaValid($_POST['fecha']);
            $f_origen = isset($_POST['origen']);
            $f_destino = isset($_POST['destino']);
            // Comprobamos si el Origen y Destino están en distintas localizaciones.
            // Para ello, pasamos ambas cadenas a minúsculas.
            if (strtolower($_POST['origen']) != strtolower($_POST['destino'])) $f_localizacion = true;
            // Si todas las validaciones son correctas, la bandera principal será true.
            if ($f_fecha && $f_origen && $f_destino && $f_localizacion) {
                $f_principal=true;
            }
        }
        
        // Si procedemos a consultar y todos los campos son válidos.
        if (isset($_POST['consultar']) && $f_principal) {
            try {
                // Consulta para mostrar el posible viaje.
                $registro = $conex->query("SELECT * FROM viajes WHERE Fecha = '$_POST[fecha]' AND Origen = '$_POST[origen]' AND Destino = '$_POST[destino]'");
                // Comprobamos los resultados obtenidos.
                if ($registro->rowCount()) {
                    // Si existe coincidencia, mostramos el siguiente formulario
                    // con los datos del registro (Más abajo).
                    $registroConsultado = $registro->fetchObject();
                    // Guardamos los datos del registro consultado
                    // en la variable $_POST[] para mostrarlos en el formulario.
                    $_POST['fecha'] = $registroConsultado->Fecha;
                    $_POST['origen'] = $registroConsultado->Origen;
                    $_POST['destino'] = $registroConsultado->Destino;
                    $_POST['plazasLibres'] = $registroConsultado->Plazas_libres;
                } else {
                    echo "<br><br><span style='color:red;'>No hay ningún viaje desde $_POST[origen] hasta $_POST[destino] en la fecha: $_POST[fecha]!</span>";
                }
            } catch (PDOException $ex) {
                die ("ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2]);
            }
        }        
        
        // Bandera Validación (segundo formulario).
        $f_plazas=false;
        
        // Pulsamos sobre Reservar y campos válidos.
        // Procedemos a realizar la reserva.
        if (isset($_POST['reservar']) && $f_plazas) {
            try {
                // Calculamos las plazas restantes.
                $plazas = ($_POST['plazasLibres'] - $_POST['plazasReserva']);
                // Realizamos la consulta de reserva (update).
                $res = $conex->exec("UPDATE viajes SET Plazas_libres=$plazas "
                        . "WHERE Fecha='$_POST[fecha]' AND Origen='$_POST[origen]' AND Destino='$_POST[destino]'");
                // Comprobamos las filas afectadas por la consulta.
                // Utilizamos exec() para INSERT, UPDPATE y DELETE.
                // Puede devolver false (ERROR en la ejecución de la consulta),
                // 0 (Consulta ejecutada pero NINGUNA FILA AFECTADA) y
                // n > 0 (Consulta ejecutada y FILAS AFECTADAS).
                if ($res) {
                    $msgReserva = "<span style='color:green;'>Ha reservado $_POST[plazasReserva] plazas para ir desde $_POST[origen] hasta $_POST[destino] en la fecha: $_POST[fecha]!</span>";
                } else if ($res === 0) {
                    $msgReserva = "<span style='color:black;'>NO SE HA ACTUALIZADO NINGÚN DATO!</span>";
                } else {
                    $msgReserva = "<span style='color:red;'>ERROR EN LA EJECUCIÓN DE LA CONSULTA!</span>";
                }
            } catch (PDOException $ex) {
                echo "ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
            }
        }        
        
        ?>
        <h1>Reserva viaje</h1>
        <form action="" method="POST">
            <p>Fecha: <input type="date" name="fecha"
                             value="<?php if ($f_fecha) echo $_POST['fecha']; ?>">
            <?php
            // Error validación - Fecha.
            if (isset($_POST['consultar']) && !$f_fecha) echo "<span style='color:red;'>Error. Introduzca una fecha válida!</span>";
            ?>
            </p>
            <p>Origen: 
                <select name="origen">
                    <?php
                    try {
                        // Consulta para obtener todas las localizaciones de Origen.
                        $result = $conex->query("SELECT Origen FROM viajes GROUP BY Origen");
                        // Comprobamos los resultados obtenidos.
                        if ($result->rowCount()) {
                            while ($fila = $result->fetchObject()) {
                                echo "<option value='$fila->Origen' ";
                                // Mantenemos el Origen seleccionado si accionamos Añadir.
                                if ($f_origen && ($_POST['origen'] == $fila->Origen)) echo "selected";
                                echo ">$fila->Origen</option>";
                            }
                        }
                    } catch (PDOException $ex) {
                        echo "ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
                    }
                    ?>
                </select>
            </p>
            <p>Destino: 
                <select name="destino">
                    <?php
                    try {
                        // Consulta para obtener todas las localizaciones de Destino.
                        $result = $conex->query("SELECT Destino FROM viajes GROUP BY Destino");
                        // Comprobamos los resultados obtenidos.
                        if ($result->rowCount()) {
                            while ($fila = $result->fetchObject()) {
                                echo "<option value='$fila->Destino' ";
                                // Mantenemos el Destino seleccionado si accionamos Añadir.
                                if ($f_destino && ($_POST['destino'] == $fila->Destino)) echo "selected";
                                echo ">$fila->Destino</option>";
                            }
                        }
                    } catch (PDOException $ex) {
                        echo "ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
                    }
                    ?>
                </select>
            </p>
            <input type="submit" name="consultar" value="Consultar">            
        </form>
        <a href="index.html">Volver a Menú</a>
        <?php
        // Error validación - Origen y Destino iguales.
        if (isset($_POST['consultar']) && !$f_localizacion) echo "<br><br><span style='color:red;'>El Origen y Destino deben ser diferentes!</span>";        
        
        // Mostramos el mensaje correspondiente tras Reservar.
        if (isset($msgReserva) && !isset($_POST['consultar'])) {
            echo "<p>".$msgReserva."</p>";
        }
        
        // Mostramos el siguiente formulario si hemos obtenido
        // un registro anteriormente (consulta) o si pulsamos sobre Reservar.
        if (isset($registroConsultado) || (isset($_POST['reservar']) && !$f_plazas)) {
            // Validamos los datos.
            if (isset($_POST['reservar'])) {
                // Comprobamos si nº plazas a reservar es un número positivo
                // mayor que 0 y que su valor sea igual o menor que las plazas
                // disponibles.
                $f_plazas = (($_POST['plazasLibres'] >= $_POST['plazasReserva'])
                        && isNumValid($_POST['plazasReserva']));
            }
            ?>
            <hr>
            <form action="" method="POST">
                <p>Fecha: <input type="text" name="fecha" value="<?php echo $_POST['fecha']; ?>" readonly=""></p>
                <p>Origen: <input type="text" name="origen" value="<?php echo $_POST['origen']; ?>" readonly=""></p>
                <p>Destino: <input type="text" name="destino" value="<?php echo $_POST['destino']; ?>" readonly=""></p>
                <p>Plazas disponibles: <input type="text" name="plazasLibres" value="<?php echo $_POST['plazasLibres']; ?>" readonly=""></p>
                <p>Nº plazas a reservar: <input type="text" name="plazasReserva">
            <?php
            // Error validación.
            if (isset($_POST['reservar']) && !$f_plazas) echo "<span style='color:red;'>El número de plazas a reservar debe ser menor o igual que las plazas disponibles y distinto de 0!</span>";            
            ?>
                </p>
                <input type="submit" name="reservar" value="Reservar">
            </form>
        <?php
        }
        ?>  
    </body>
</html>
