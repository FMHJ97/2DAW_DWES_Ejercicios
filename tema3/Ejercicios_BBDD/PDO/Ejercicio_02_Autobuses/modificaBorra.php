<html>
    <head>
        <title>BD autobuses - Borra o modifica un viaje</title>
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
        td {
            background-color: white;
        }
        table input {
            background-color: lightcyan;
        }
        table input:hover {
            background-color: lightblue;
        }
    </style>
    <body>
        <?php
        // Inicia el "output buffering". Esto significa que toda la salida generada 
        // a partir de este punto se almacenará en un búfer en lugar de enviarse 
        // inmediatamente al navegador.
        ob_start();
        
        // Importamos las funciones necesarias.
        require_once './funciones.php';
        // Posible redirección si accedemos directamente.
        // Si cargamos la página para ver el mensaje de Borrar y Modificar,
        // no seremos redirigidos.
        if (!isset($_REQUEST['index']) && !isset($_REQUEST['msgBorrar']) && !isset($_REQUEST['msgModificar'])) {
            header("Location: index.html");
            exit();
        }
        // Establecemos una conexión PDO a la BD autobuses.
        $conex = getConnectionPDO('autobuses');
        
        // Banderas de validación (Formulario).
        $f_fecha=false; $f_matricula=false; $f_origen=false; $f_destino=false; $f_plazasLibres=false;
        // Bandera de validación donde Origen != Destino.
        $f_localizacion=false;
        // Bandera principal.
        $f_principal=false;
        // Validación de campos.
        if (isset($_POST['editar'])) {
            $f_fecha = isFechaValid($_POST['fecha']);
            $f_matricula = isset($_POST['matricula']);
            $f_origen = isTextValid($_POST['origen']);
            $f_destino = isTextValid($_POST['destino']);
            // Comprobamos si el Origen y Destino están en distintas localizaciones.
            // Para ello, pasamos ambas cadenas a minúsculas.
            if (strtolower($_POST['origen']) != strtolower($_POST['destino'])) $f_localizacion = true;
            $f_plazasTotales = isNumValid($_POST['plazasTotales']);
            // Para comprobar que las plazas libres sean válidas,
            // debemos obtener el número de plazas del autobús seleccionado.
            try {
                // Consulta para obtener las plazas del autobús.
                $reg = $conex->query("SELECT Num_plazas FROM autos WHERE Matricula='$_POST[matricula]'");
                // Obtenemos el nº plazas desde el objeto.
                if ($reg->rowCount()) $plazasAutobus = ($reg->fetchObject())->Num_plazas;
            } catch (PDOException $ex) {
                echo "ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
            }
            $f_plazasLibres = isPlazasLibresValid($_POST['plazasLibres'], $plazasAutobus);
            // Si todas las validaciones son correctas, la bandera principal será true.
            if ($f_fecha && $f_matricula && $f_origen && $f_destino && $f_plazasLibres && $f_localizacion && $f_plazasTotales) {
                $f_principal=true;
            }
        }
        
        ?>
        <h1>Borra o modifica un viaje</h1>
        <?php
        try {
            // Consulta para mostrar los posibles registros.
            $result = $conex->query("SELECT v.Fecha, v.Matricula, v.Origen, v.Destino, T1.Num_plazas, v.Plazas_libres FROM viajes v "
                    . "JOIN (SELECT Matricula, Num_plazas FROM autos) T1 WHERE v.Matricula = T1.Matricula;");
            // Comprobamos el resultado obtenido.
            if ($result->rowCount()) {
                ?>
        <table>
            <tr>
                <th>Fecha</th><th>Matrícula</th><th>Origen</th><th>Destino</th>
                <th>Plazas</th><th>Plazas libres</th><th>Acción</th>
            </tr>
            <?php
            // Extraemos los datos de cada fila como un objeto.
            // Asignamos cada objeto a una fila.
            while($fila = $result->fetchObject()) {
                echo "<tr>";
                echo "<td>$fila->Fecha</td><td>$fila->Matricula</td><td>$fila->Origen</td><td>$fila->Destino</td><td>$fila->Num_plazas</td><td>$fila->Plazas_libres</td>";
                echo "<td><form action='' method='POST'>";
                echo "<input type='submit' name='modificar' value='Modificar'> ";
                echo "<input type='submit' name='borrar' value='Borrar'>";
                // Pasamos los datos necesarios como hidden para las futuras consultas.
                echo "<input type='hidden' name='fecha_original' value='$fila->Fecha'>";
                echo "<input type='hidden' name='matricula_original' value='$fila->Matricula'>";
                echo "<input type='hidden' name='origen_original' value='$fila->Origen'>";
                echo "<input type='hidden' name='destino_original' value='$fila->Destino'>";
                echo "<input type='hidden' name='plazasLibres_original' value='$fila->Plazas_libres'>";
                echo "<input type='hidden' name='plazasTotales_original' value='$fila->Num_plazas'>";
                echo "</form></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br><a href="index.html">Volver a Menú</a>
                <?php
                // Mostramos el mensaje correspondiente tras Borrar.
                if (isset($_REQUEST['msgBorrar']) && !isset($_POST['borrar']) && !isset($_POST['modificar'])) {
                    echo "<p>".$_REQUEST['msgBorrar']."</p>";
                }
                // Mostramos el mensaje correspondiente tras Modificar.
                if (isset($_REQUEST['msgModificar']) && !isset($_POST['borrar']) && !isset($_POST['modificar'])) {
                    echo "<p>".$_REQUEST['msgModificar']."</p>";
                }
            } else {
                echo "<span style='font-weight:bold;'>NO EXISTEN REGISTROS EN LA BD!</span>";
            }
        } catch (PDOException $ex) {
            echo "ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
        }
        
        // Si pulsamos sobre el botón Modificar en la tabla,
        // o pulsamos Modificar en el formulario y hay errores.
        if (isset($_POST['modificar']) || (isset($_POST['editar']) && !$f_principal)) {
            // Mostramos el formulario Modificar.
            ?>
        <form action="" method="POST">
            <p>Fecha: <input type="date" name="fecha"
                             value="<?php
                             if (isset($_POST['modificar'])) echo $_POST['fecha_original'];
                             else if($f_fecha) echo $_POST['fecha'];
                             ?>">
                <!-- Error validación -->
                <?php if (isset($_POST['editar']) && !$f_fecha) echo "<span style='color:red;'>Error. Insertar una fecha válida.</span>"; ?>            
            </p>
            <p>Matrícula:
                <select name="matricula">
                    <?php
                    try {
                        // Consulta para obtener todas las matrículas.
                        $result = $conex->query("SELECT * FROM autos");
                        // Comprobamos los resultados obtenidos.
                        if ($result->rowCount()) {
                            while ($fila = $result->fetchObject()) {
                                echo "<option value='$fila->Matricula' ";
                                // Mantenemos la matrícula seleccionada.
                                if (isset($_POST['modificar']) && $_POST['matricula_original'] == $fila->Matricula) echo "selected";
                                else if ($f_matricula && $_POST['matricula'] == $fila->Matricula) echo "selected";
                                echo ">$fila->Matricula</option>";
                            }
                        }
                    } catch (PDOException $ex) {
                        echo "ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
                    }
                    ?>
                </select>
            </p>
            <p>Origen: <input type="text" name="origen"
                              value="<?php
                                    if (isset($_POST['modificar'])) echo $_POST['origen_original'];
                                    else if($f_origen) echo $_POST['origen'];
                                    ?>">
                <!-- Error validación -->
                <?php if (isset($_POST['editar']) && !$f_origen) echo "<span style='color:red;'>Error. Origen debe contener letras.</span>"; ?>                        
            </p>
            <p>Destino: <input type="text" name="destino"
                             value="<?php
                             if (isset($_POST['modificar'])) echo $_POST['destino_original'];
                             else if($f_destino) echo $_POST['destino'];
                             ?>">
                <!-- Error validación -->
                <?php if (isset($_POST['editar']) && !$f_destino) echo "<span style='color:red;'>Error. Destino debe contener letras.</span>"; ?>            
            </p>
            <p>Plazas: <input type="text" name="plazasTotales"
                             value="<?php
                             if (isset($_POST['modificar'])) echo $_POST['plazasTotales_original'];
                             else if($f_plazasTotales) echo $_POST['plazasTotales'];
                             ?>">
            </p>
            <p>Plazas disponibles: <input type="text" name="plazasLibres"
                             value="<?php
                             if (isset($_POST['modificar'])) echo $_POST['plazasLibres_original'];
                             else if($f_plazasLibres) echo $_POST['plazasLibres'];
                             ?>">
                <!-- Error validación -->
                <?php if (isset($_POST['editar']) && !$f_plazasLibres) echo "<span style='color:red;'>Error. Las plazas libres no deben superar las plazas del autobús (".$plazasAutobus." plazas)</span>"; ?>            
            </p>
            <input type="submit" name="editar" value="Modificar">
            <!--Mantenemos los datos originales como hidden para el UPDATE.-->
            <input type='hidden' name='fecha_original' value='<?php echo $_POST['fecha_original']; ?>'>
            <input type='hidden' name='matricula_original' value='<?php echo $_POST['matricula_original']; ?>'>
            <input type='hidden' name='origen_original' value='<?php echo $_POST['origen_original']; ?>'>
            <input type='hidden' name='destino_original' value='<?php echo $_POST['destino_original']; ?>'>
            <input type='hidden' name='plazasLibres_original' value='<?php echo $_POST['plazasLibres_original']; ?>'>
            <input type='hidden' name='plazasTotales_original' value='<?php echo $_POST['plazasTotales_original']; ?>'>
        </form>
            <?php
        // Error validación Origen y Destino iguales.
        if (isset($_POST['editar']) && !$f_localizacion) echo "<span style='color:red;'>El Origen y Destino deben ser diferentes!</span>";            
        }
        
        // Proceso para realizar la consulta de Modificar (UPDATE).
        if (isset($_POST['editar']) && $f_principal) {
                try {
                //Comenzamos la transacción.
                $conex->beginTransaction();
                // Realizamos la consulta.
                $res = $conex->exec("UPDATE viajes SET Fecha='$_POST[fecha]', Matricula='$_POST[matricula]', "
                        . "Origen='$_POST[origen]', Destino='$_POST[destino]', Plazas_libres=$_POST[plazasLibres] "
                        . "WHERE Fecha='$_POST[fecha_original]' AND Matricula='$_POST[matricula_original]' AND Origen='$_POST[origen_original]' AND Destino='$_POST[destino_original]'");
                // Comprobamos las filas afectadas por la consulta.
                // Utilizamos exec() para INSERT, UPDPATE y DELETE.
                // Puede devolver false (ERROR en la ejecución de la consulta),
                // 0 (Consulta ejecutada pero NINGUNA FILA AFECTADA) y
                // n > 0 (Consulta ejecutada y FILAS AFECTADAS).
                if ($res) {
                    $msgModificar = "<span style='color:green;'>VIAJE MODIFICADO CORRECTAMENTE!</span>";
                    // Confirmamos los cambios.
                    $conex->commit();
                } else if ($res === 0) {
                    $msgModificar = "<span style='color:red;'>NO SE HA ACTUALIZADO NINGÚN DATO DEL VIAJE!</span>";
                    $conex->rollBack();
                } else {
                    $msgModificar = "<span style='color:red;'>ERROR EN LA EJECUCIÓN DE LA CONSULTA!</span>";
                    // Deshacemos los cambios.
                    $conex->rollBack();
                }
            } catch (PDOException $ex) {
                $conex->rollBack();
                echo "ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
            }
            // Mensaje que devolvemos (recargamos la página).
            header('Location: modificaBorra.php?msgModificar='.$msgModificar);
            exit();
        }
        
        // Si pulsamos sobre el botón Borrar en la tabla.
        if (isset($_POST['borrar'])) {
            try {
                // Comenzamos la transacción.
                $conex->beginTransaction();
                // Consulta para el borrado del viaje.
                $reg=$conex->exec("DELETE FROM viajes WHERE Fecha='$_POST[fecha]' AND Matricula='$_POST[matricula]' "
                        . "AND Origen='$_POST[origen]' AND Destino='$_POST[destino]'");
                // Comprobamos las filas afectadas por la consulta.
                // Utilizamos exec() para INSERT, UPDPATE y DELETE.
                // Puede devolver false (ERROR en la ejecución de la consulta),
                // 0 (Consulta ejecutada pero NINGUNA FILA AFECTADA) y
                // n > 0 (Consulta ejecutada y FILAS AFECTADAS).
                if ($reg) {
                    $msgBorrar = "<span style='color:green;'>VIAJE BORRADO CORRECTAMENTE!</span>";
                    // Confirmamos los cambios.
                    $conex->commit();
                } else if ($reg === 0) {
                    $msgBorrar = "<span style='color:red;'>NO SE HA BORRADO NINGÚN REGISTRO!</span>";
                    $conex->rollBack();
                } else {
                    $msgBorrar = "<span style='color:red;'>ERROR EN LA EJECUCIÓN DE LA CONSULTA!</span>";
                    // Deshacemos los cambios.
                    $conex->rollBack();
                }
            } catch (PDOException $ex) {
                echo "ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
            }
            // Mensaje que devolvemos (tras recargar la página).
            header('Location: modificaBorra.php?msgBorrar='.$msgBorrar);
            exit();
        }
        
        // Envía todo el contenido del búfer al navegador y apaga el "output buffering".
        ob_end_flush();
        ?>
    </body>
</html>
