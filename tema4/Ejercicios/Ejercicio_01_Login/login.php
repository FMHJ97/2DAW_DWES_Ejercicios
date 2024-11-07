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
        $result = $conex->prepare("SELECT Clave FROM usuario WHERE Usuario=?");
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
                    
                } else {
                    
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
            <p>Usuario: <input type="text" name="user"></p>
            <p>Clave: <input type="password" name="pwd"></p>
            <input type="checkbox" name="remember"><label>Recuérdame</label>
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
