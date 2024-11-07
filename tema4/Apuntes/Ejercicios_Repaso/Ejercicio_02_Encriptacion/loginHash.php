<?php
if (isset($_POST['acceder'])) {
    // Realizamos una conexión a la BD.
    try {
        $conex = new PDO('mysql:host=localhost;dbname=encript;charset=utf8mb4;','dwes','abc123.');
        // Realizamos la consulta.
        $result = $conex->query("SELECT Clave FROM usuario WHERE Usuario='$_POST[user]'");
        // Comprobamos el resultado.
        if ($result->rowCount()) {
            // Convertimos el resultado en un objeto.
            $reg = $result->fetchObject();
            // Comprobamos si existe coincidencia entre la clave introducida
            // y la clave de la BD.
            if (password_verify($_POST['pwd'], $reg->Clave)) header ('Location:datos.php');
            else $msg = "Usuario o clave incorrecta!";
        } else {
            $msg = "Usuario o clave incorrecto!";
        }
    } catch (PDOException $ex) {
        die($ex->getMessage());
    }
}
?>
<html>
    <head>
        <title>BD encript - Autenticar con Password_hash()</title>
    </head>
    <body>
        <form action="" method="POST">
            <p>Usuario: <input type="text" name="user"></p>
            <p>Clave: <input type="password" name="pwd"></p>
            <input type="submit" name="acceder" value="Acceder">
        </form>
        <?php
        if (isset($_POST['acceder']) && isset($msg)) echo $msg;
        ?>
    </body>
</html>
