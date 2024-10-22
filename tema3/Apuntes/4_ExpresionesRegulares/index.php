<html>
    <head>
        <title>Validación con Expresiones Regulares</title>
    </head>
    <body>
        <?php
            // Validation Flags.
            $f_dni=false; $f_nombre=false; $f_fecha=false;
            $f_email=false; $f_edad=false;
        
            // Validaciones.
            if (isset($_POST['enviar'])) {
                if (preg_match('/^[a-z]{8}\d{1}/i', $_POST['dni'])) $f_dni=true;
                if (preg_match('/^[a-z]{1,30}$/i', $_POST['nombre'])) $f_nombre=true;
                if (preg_match('/\d{2}(-)\d{2}(-)\d{4}/', $_POST['fecha'])) $f_fecha=true;
                if (preg_match('/\w+(@)/', $subject))
            }
        
            if (isset($_POST['enviar'])) {
                
            } else {
                
                ?>
                <form action="" method="POST">
                    <p>DNI: <input type="text" name="dni"></p>
                    <p>Nombre: <input type="text" name="nombre"></p>
                    <p>Fecha de nacimiento: <input type="date" name="fecha"></p>
                    <p>Email: <input type="email" name="email"></p>
                    <p>Edad: <input type="number" name="edad"></p>
                    <input type="submit" name="enviar" value="Enviar">
                </form>
                <?php
            }
        ?>
    </body>
</html>
