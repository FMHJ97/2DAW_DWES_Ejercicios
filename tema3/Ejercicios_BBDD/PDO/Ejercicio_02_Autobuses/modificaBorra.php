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
                echo "<input type='hidden' name='fecha' value='$fila->Fecha'>";
                echo "<input type='hidden' name='matricula' value='$fila->Matricula'>";
                echo "<input type='hidden' name='origen' value='$fila->Origen'>";
                echo "<input type='hidden' name='destino' value='$fila->Destino'>";
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
                // Mostramos el mensaje correspondiente tras Borrar.
                if (isset($_REQUEST['msgModificar']) && !isset($_POST['borrar']) && !isset($_POST['modificar'])) {
                    echo "<p>".$_REQUEST['msgModificar']."</p>";
                }
            } else {
                echo "<span style='font-weight:bold;'>NO EXISTEN REGISTROS EN LA BD!</span>";
            }
        } catch (PDOException $ex) {
            echo "ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
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
