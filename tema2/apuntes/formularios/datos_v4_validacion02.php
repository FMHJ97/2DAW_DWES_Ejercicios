<html>
    <head>
        <title>Formulario - Validación 02</title>
    </head>
    <body>
        
        <?php
            // Banderas para validar datos.
            $b_nombre = false; $b_apell = false; $b_modulo = false; $bandera = false;
        
            // Validamos los datos del formulario.
            // El nombre debe ser Pepe, apellido y módulos NO pueden estar vacíos. 
            if (isset($_POST['enviar'])) {
                
                if ($_POST['nombre'] == "Pepe") $b_nombre = true;
                if (!empty($_POST['apellido'])) $b_apell = true;
                if (isset($_POST['modulos'])) $b_modulo = true;
                
                // Bandera principal (Si no hay errores, la bandera está a true).
                if ($b_nombre && $b_apell && $b_modulo) $bandera = true;
            }
        
            // Si se ha enviado el formulario y NO hay errores (bandera == true), procesamos datos.
            if (isset($_POST['enviar']) && $bandera) {
                
                    # Muestra los valores independientemente del método.
                    echo $_REQUEST['nombre']." - ".$_REQUEST['apellido']."<br>";
                    # Si seleccionamos varios checkbox, debemos recorrer el array.
                    foreach ($_POST['modulos'] as $value) {
                        echo $value."<br>";
                    }
                    # Enlace que nos devuelve a la página principal después de enviar datos.
                    echo "<br><a href='datos_v4_validacion02.php'>Introducir otro</a>";                
            } else {
                ?>
                <h1>Méthod POST</h1>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    Nombre: <input type="text" name="nombre"
                                   value="<?php if ($b_nombre) echo $_POST['nombre']; ?>">
                    <?php if (isset($_POST['enviar']) && !$b_nombre) echo "<span style='color: red'>El nombre no es Pepe</span>" ?><br>
                    
                    Apellido: <input type="text" name="apellido"
                                   value="<?php if ($b_apell) echo $_POST['apellido']; ?>">
                    <?php if (isset($_POST['enviar']) && !$b_apell) echo "<span style='color: red'>El apellido no puede estar vacío</span>" ?><br>
                    
                    Modulos:
                    <?php if (isset($_POST['enviar']) && !$b_modulo) echo "<span style='color: red'>Selecciona al menos un módulo</span>" ?><br>
                    <!-- Cuando creemos un checkbox, el atributo name debe ser un array,
                    dado que los checkbox permiten la multi-selección.-->
                    <input type="checkbox" name="modulos[]" value="DWES"
                           <?php if ($b_modulo && in_array("DWES", $_POST['modulos'])) echo "checked"; ?>>Desarrollo Web Entorno Servidor</input><br>
                    <input type="checkbox" name="modulos[]" value="DWEC"
                           <?php if ($b_modulo && in_array("DWEC", $_POST['modulos'])) echo "checked"; ?>>Desarrollo Web Entorno Cliente</input><br>
                    <input type="checkbox" name="modulos[]" value="HLC"
                           <?php if ($b_modulo && in_array("HLC", $_POST['modulos'])) echo "checked"; ?>>Horas de Libre Configuración</input><br>
                    <br><input type="submit" name="enviar" value="Enviar">
                </form>
                <?php
            }
        ?>
                    
    </body>
</html>
