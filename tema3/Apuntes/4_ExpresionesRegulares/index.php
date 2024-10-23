<html>
    <head>
        <title>Validación con Expresiones Regulares</title>
    </head>
    <body>
        <?php
            // Validation Flags.
            $f_dni=false; $f_nombre=false; $f_fecha=false;
            $f_email=false; $f_edad=false;
            // Bandera validación global.
            $main_flag=false;
        
            // Validaciones.
            if (isset($_POST['enviar'])) {
                if (preg_match('/^\d{8}[A-Z]{1}$/', $_POST['dni'])) $f_dni=true;
                if (preg_match('/^[a-z]{1,30}$/i', $_POST['nombre'])) $f_nombre=true;
                if (preg_match('/^\d{2}[-]\d{2}[-]\d{4}$/', $_POST['fecha'])) {
                    // Devuelve un array con los valores separados por guiones.
                    // Si type=date -> yyyy-MM-dd.
                    // 0=>dia, 1=>mes, 2=>año
                    $array=explode("-", $_POST['fecha']);
                    // Comprobamos si la fecha es válida.
                    if (checkdate($array[1], $array[0], $array[2])) $f_fecha=true;
                }
                if (preg_match('/^[\w\-\+\.]+[@][\w\-\+\.]+[.](com|es|org)/i', $_POST['email'])) $f_email=true;
                if (preg_match('/^\d+$/', $_POST['edad']) && $_POST['edad'] >= 18) $f_edad=true;
                // Si todas las banderas están a true, validación global correcta.
                if ($f_dni && $f_nombre && $f_fecha && $f_email && $f_edad) $main_flag=true;
            }
        
            if (isset($_POST['enviar']) && $main_flag) {
                echo "OPERACIÓN REALIZADA CORRECTAMENTE";
            } else {
                
                ?>
                <form action="" method="POST">
                    <p>DNI: <input type="text" name="dni"></p>
                    <p>Nombre: <input type="text" name="nombre"></p>
                    <p>Fecha de nacimiento: <input type="text" name="fecha"></p>
                    <p>Email: <input type="text" name="email"></p>
                    <p>Edad: <input type="number" name="edad"></p>
                    <input type="submit" name="enviar" value="Enviar">
                </form>
                <?php
            }
        ?>
    </body>
</html>
