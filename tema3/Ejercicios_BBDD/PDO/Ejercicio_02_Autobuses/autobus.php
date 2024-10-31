<html>
    <head>
        <title>BD Autobuses - Nuevo Autobús</title>
    </head>
    <body>
        <?php
        // Importamos las funciones necesarias.
        require_once './funciones.php';
        // Posible redirección si accedemos directamente.
        redirectMenu();
        // Banderas de validación.
        $f_matricula=false; $f_marca=false; $f_plazas=false;
        // Validaciones de campos.
        if (isset($_POST['agregar'])) {
            $f_matricula = isMatriculaValid($_POST['matricula']);
            $f_marca = isTextValid($_POST['marca']);
            $f_plazas = isNumValid($_POST['plazas']);
        }
        ?>
        <h1>Nuevo autobús</h1>
        <form action="" method="POST">
            <p>Matrícula: <input type="text" name="matricula"
                                 value="<?php if ($f_matricula) echo $_POST['matricula']; ?>">
                <!-- Error validación -->
                <?php if (isset($_POST['agregar']) && !$f_matricula) echo "<span style='color:red;'>Error. Debe estar compuesta por 3 números seguidos por 3 letras mayúsculas.</span>"; ?>
            </p>
            <p>Marca: <input type="text" name="marca"
                             value="<?php if ($f_marca) echo $_POST['marca']; ?>">
                <!-- Error validación -->
                <?php if (isset($_POST['agregar']) && !$f_marca) echo "<span style='color:red;'>Error. La marca solo debe contener letras.</span>"; ?>                
            </p>
            <p>Nº plazas: <input type="text" name="plazas"
                                 value="<?php if ($f_plazas) echo $_POST['plazas']; ?>">
                <!-- Error validación -->
                <?php if (isset($_POST['agregar']) && !$f_plazas) echo "<span style='color:red;'>Error. Introduzca un valor númerico positivo.</span>"; ?>                                
            </p>
            <input type="submit" name="agregar" value="Añadir">
        </form>
        <a href="index.html">Volver a Menú</a>
        <?php
        // Si procedemos a insertar y todos los campos son válidos.
        if (isset($_POST['agregar']) && ($f_matricula && $f_marca && $f_plazas)) {
            try {
                // Establecemos una conexión PDO a la BD autobuses.
                $conex = getConnectionPDO('autobuses');
                // Comenzamos una transacción.
                $conex->beginTransaction();
                // Realizamos la consulta INSERT.
                $res = $conex->exec("INSERT INTO autos VALUES ('$_POST[matricula]','$_POST[marca]',$_POST[plazas])");
                // Comprobamos las filas afectadas por la consulta.
                // Utilizamos exec() para INSERT, UPDPATE y DELETE.
                // Puede devolver false (ERROR en la ejecución de la consulta),
                // 0 (Consulta ejecutada pero NINGUNA FILA AFECTADA) y
                // n > 0 (Consulta ejecutada y FILAS AFECTADAS).
                if ($res) {
                    echo "<br><br><span style='color:green;'>AUTOBÚS INSERTADO CORRECTAMENTE!</span>";
                    // Confirmamos los cambios.
                    $conex->commit();
                } else {
                    echo "<br><br><span style='color:red;'>ERROR EN LA EJECUCIÓN DE LA CONSULTA!</span>";
                    // Deshacemos los cambios.
                    $conex->rollBack();
                }
            } catch (PDOException $ex) {
                $conex->rollBack();
                if ($ex->errorInfo[1] == 1062) die("<br><br><span style='color:red;'>EXISTE UN AUTOBÚS CON DICHA MATRÍCULA!</span>");
                else die("<br><br><span style='color:red;'>ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2]."</span>");
            }
        }
        ?>
    </body>
</html>
