<html>
    <head>
        <title>Formulario - Apuntes 01</title>
    </head>
    <body>
        <?php
            # Si se ha enviado el formulario, ejecutará el siguiente código.
            if (isset($_POST['enviar'])) {
                # Muestra los valores independientemente del método.
                echo $_REQUEST['nombre']." - ".$_REQUEST['apellido']."<br>";

                # Si seleccionamos varios checkbox, debemos recorrer el array.
                foreach ($_POST['modulos'] as $value) {
                    echo $value."<br>";
                }
                # Enlace que nos devuelve a la página principal después de enviar datos.
                echo "<br><a href='datos_v3.php'>Introducir otro</a>";
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
