<?php
// Creamos una conexión a BD.
if (isset($_POST['acceder']) && !isset($conex)) {
    try {
        $conex = new PDO('mysql:host=localhost;dbname=encript;charset=utf8mb4;','dwes','abc123.');
    } catch (PDOException $ex) {
        die($ex->getMessage());
    }
}

// Si pulsamos sobre Acceder.
if (isset($_POST['acceder'])) {
    try {
        // Realizamos una consulta a la BD para verificar las credenciales.
        $result = $conex->prepare("SELECT * FROM usuario WHERE Usuario=?");
        // Asignamos parámetros.
        $result->bindParam(1, $_POST['user']);
        // Ejecutamos la consulta y comprobamos resultados.
        if ($result->execute()) {
            // Convertimos el registro a un objeto.
            $registro = $result->fetchObject();
            // Verificamos si las claves coinciden.
            if (password_verify($_POST['pwd'], $registro->Clave)) {
                // Auntenticado, luego creamos una cookie con los datos.
                // Comprobamos si el checkbox está seleccionado.
                if (isset($_POST['remember'])) {
                    // Se guardarán durante 1 año.
                    // Pasamos el usuario, contraseña, remember, nombre, apellidos y fecha-hora actuales.
                    setcookie('user', $registro->Usuario, time()+3600*24*365);
                    setcookie('pwd', $_POST['pwd'], time()+3600*24*365);
                    setcookie('remember', 'on', time()+3600*24*365);
                    setcookie('name', $registro->Nombre, time()+3600*24*365);
                    setcookie('surname', $registro->Apellidos, time()+3600*24*365);
                } else {
                    // Se guardarán mientras dure la sesión.
                    // Pasamos el usuario, contraseña, nombre, apellidos y fecha-hora actuales.
                    setcookie('user', $registro->Usuario);
                    setcookie('pwd', $_POST['pwd']);
                    setcookie('remember', 'off');
                    setcookie('name', $registro->Nombre);
                    setcookie('surname', $registro->Apellidos);
                }
                // Nos dirigimos al fichero datos.
                header('Location:datos.php?login');
            } else {
                $msg = "Usuario o clave incorrectos!";
            }
        } else {
            $msg = "Usuario o clave incorrectos!";
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
?>

<html>
    <head>
        <title>BD encript - Formulario de acceso</title>
    </head>
    <body>
        <h1>Formulario de acceso</h1>
        <form action="" method="POST">
            <p>Usuario: <input type="text" name="user"
                               value="<?php echo ($_COOKIE['remember'] === 'on') ? $_COOKIE['user']:''; ?>"></p>
            <p>Clave: <input type="password" name="pwd"
                             value="<?php echo ($_COOKIE['remember'] === 'on') ? $_COOKIE['pwd']:''; ?>"></p>
            <input type="checkbox" name="remember"
                   <?php echo ($_COOKIE['remember'] === 'on') ? 'checked':''; ?>><label>Recuérdame</label>
            <br><br>
            <input type="submit" name="acceder" value="Acceder">
            <a><input type="button" value="Registrar"></a>
        </form>
        <?php
        if (isset($_POST['acceder']) && isset($msg)) {
            echo $msg;
        }
        ?>
    </body>
</html>
