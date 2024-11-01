<html>
    <head>
        <title>BD Autobuses - Nuevo Viaje</title>
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
        $f_fecha=false; $f_matricula=false; $f_origen=false; $f_destino=false; $f_plazasLibres=false;
        // Bandera de validación donde Origen != Destino.
        $f_localizacion=false;
        // Bandera principal.
        $f_principal=false;
        // Validación de campos.
        if (isset($_POST['agregar'])) {
            $f_fecha = isFechaValid($_POST['fecha']);
            $f_matricula = isset($_POST['matricula']);
            $f_origen = isTextValid($_POST['origen']);
            $f_destino = isTextValid($_POST['destino']);
            // Comprobamos si el Origen y Destino están en distintas localizaciones.
            // Para ello, pasamos ambas cadenas a minúsculas.
            if (strtolower($_POST['origen']) != strtolower($_POST['destino'])) $f_localizacion = true;
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
            if ($f_fecha && $f_matricula && $f_origen && $f_destino && $f_plazasLibres && $f_localizacion) {
                $f_principal=true;
            }
        }
        ?>
        <h1>Nuevo viaje</h1>
        <form action="" method="POST">
            <p>Fecha: <input type="date" name="fecha"
                             value="<?php if ($f_fecha) echo $_POST['fecha']; ?>">
                <!-- Error validación -->
                <?php if (isset($_POST['agregar']) && !$f_fecha) echo "<span style='color:red;'>Error. Insertar una fecha válida.</span>"; ?>            
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
                                // Mantenemos la matrícula seleccionada si accionamos Añadir.
                                if ($f_matricula && ($_POST['matricula'] == $fila->Matricula)) echo "selected";
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
                              value="<?php if ($f_origen) echo $_POST['origen']; ?>">
                <!-- Error validación -->
                <?php if (isset($_POST['agregar']) && !$f_origen) echo "<span style='color:red;'>Error. Origen debe contener letras.</span>"; ?>                        
            </p>
            <p>Destino: <input type="text" name="destino"
                               value="<?php if ($f_destino) echo $_POST['destino']; ?>">
                <!-- Error validación -->
                <?php if (isset($_POST['agregar']) && !$f_destino) echo "<span style='color:red;'>Error. Destino debe contener letras.</span>"; ?>            
            </p>
            <p>Plazas disponibles: <input type="text" name="plazasLibres"
                                          value="<?php if ($f_plazasLibres) echo $_POST['plazasLibres']; ?>">
                <!-- Error validación -->
                <?php if (isset($_POST['agregar']) && !$f_plazasLibres) echo "<span style='color:red;'>Error. Las plazas libres no deben superar las plazas del autobús (".$plazasAutobus." plazas)</span>"; ?>            
            </p>
            <input type="submit" name="agregar" value="Añadir">
        </form>
        <a href="index.html">Volver a Menú</a>
        <?php
        // Error validación Origen y Destino iguales.
        if (isset($_POST['agregar']) && !$f_localizacion) echo "<br><br><span style='color:red;'>El Origen y Destino deben ser diferentes!</span>";
        
        // Si procedemos a insertar y todos los campos son válidos.
        if (isset($_POST['agregar']) && $f_principal) {
            try {
                // Comenzamos una transacción.
                $conex->beginTransaction();
                // Realizamos la consulta INSERT.
                $res = $conex->exec("INSERT INTO viajes VALUES ('$_POST[fecha]','$_POST[matricula]','$_POST[origen]','$_POST[destino]',$_POST[plazasLibres])");
                // Comprobamos las filas afectadas por la consulta.
                // Utilizamos exec() para INSERT, UPDPATE y DELETE.
                // Puede devolver false (ERROR en la ejecución de la consulta),
                // 0 (Consulta ejecutada pero NINGUNA FILA AFECTADA) y
                // n > 0 (Consulta ejecutada y FILAS AFECTADAS).
                if ($res) {
                    echo "<br><br><span style='color:green;'>VIAJE INSERTADO CORRECTAMENTE!</span>";
                    // Confirmamos los cambios.
                    $conex->commit();
                } else {
                    echo "<br><br><span style='color:red;'>ERROR EN LA EJECUCIÓN DE LA CONSULTA!</span>";
                    // Deshacemos los cambios.
                    $conex->rollBack();
                }
            } catch (PDOException $ex) {
                $conex->rollBack();
                if ($ex->errorInfo[1] == 1062) die("<br><br><span style='color:red;'>EXISTE UN VIAJE CON DICHA FECHA, MATRÍCULA, ORIGEN Y DESTINO!</span>");
                else die("<br><br><span style='color:red;'>ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2]."</span>");
            }            
        }
        ?>
    </body>
</html>
