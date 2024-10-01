<html>
    <head>
        <title>Formulario - Apuntes 01</title>
    </head>
    <body>
        <?php
            # Si se ha enviado el formulario, ejecutará el siguiente código.
            if (isset($_POST['enviar'])) {
                
                # Si los siguientes campos NO están vacíos, y existe
                # al menos un módulo seleccionado, procesa formulario.
                if (!empty($_POST['nombre']) && !empty($_POST['apellido'])
                        && isset($_POST['modulos'])) {
                    # Muestra los valores independientemente del método.
                    echo $_REQUEST['nombre']." - ".$_REQUEST['apellido']."<br>";

                    # Si seleccionamos varios checkbox, debemos recorrer el array.
                    foreach ($_POST['modulos'] as $value) {
                        echo $value."<br>";
                    }
                    # Enlace que nos devuelve a la página principal después de enviar datos.
                    echo "<br><a href='datos_v4_validacion01.php'>Introducir otro</a>"; 
                    
                    # En caso contrario, mostramos formulario con errores y datos correctos.
                } else {
                    ?>
                    <h1>Méthod POST</h1>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        Nombre: <input type="text" name="nombre">
                        <!-- Agregamos validación en el campo nombre -->
                        <?php
                            if (empty($_POST['nombre'])) echo "<span style='color: red'>El nombre no puede estar vacío</span>";
                        ?>
                        
                        <br>Apellido: <input type="text" name="apellido">
                        <!-- Agregamos validación en el campo apellido -->
                        <?php
                            if (empty($_POST['apellido'])) echo "<span style='color: red'>El apellido no puede estar vacío</span>";
                        ?>
                        
                        <br>Modulos:
                        <!-- Agregamos validación en el campo modulos -->
                        <?php
                            if (empty($_POST['modulos'])) echo "<span style='color: red'>Debe seleccionar al menos un módulo</span>";
                        ?>                        
                        
                        <!-- Cuando creemos un checkbox, el atributo name debe ser un array,
                        dado que los checkbox permiten la multi-selección.-->
                        <br><input type="checkbox" name="modulos[]" value="DWES">Desarrollo Web Entorno Servidor</input><br>
                        <input type="checkbox" name="modulos[]" value="DWEC">Desarrollo Web Entorno Cliente</input><br>
                        <input type="checkbox" name="modulos[]" value="HLC">Horas de Libre Configuración</input><br>                        
                        
                        <br><input type="submit" name="enviar" value="Enviar">
                    </form>
                    <?php
                }
            # En caso contrario, mostrará el formulario (HTML).
            } else {
                ?>
                <h1>Méthod POST</h1>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    Nombre: <input type="text" name="nombre"><br>
                    Apellido: <input type="text" name="apellido"><br>
                    Modulos: <br>
                    <!-- Cuando creemos un checkbox, el atributo name debe ser un array,
                    dado que los checkbox permiten la multi-selección.-->
                    <input type="checkbox" name="modulos[]" value="DWES">Desarrollo Web Entorno Servidor</input><br>
                    <input type="checkbox" name="modulos[]" value="DWEC">Desarrollo Web Entorno Cliente</input><br>
                    <input type="checkbox" name="modulos[]" value="HLC">Horas de Libre Configuración</input><br>
                    <br><input type="submit" name="enviar" value="Enviar">
                </form>

                <!-- Para enviar datos a través de un enlace.
                Se enviará por GET (defecto)-->
                <a href="procesa.php?nombre=pepe&apellido=garcia">Ir a procesa</a>        
                <?php
            }          
        ?>        
    </body>
</html>
