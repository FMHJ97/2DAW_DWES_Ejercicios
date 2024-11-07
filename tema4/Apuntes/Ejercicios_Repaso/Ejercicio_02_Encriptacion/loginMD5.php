<?php
if (isset($_POST['acceder'])) {
    // Encriptamos la clave introducida.
    $claveEncript = md5($_POST['pwd']);
    // Realizamos una conexión a la BD.
    try {
        $conex = new PDO('mysql:host=localhost;dbname=encript;charset=utf8mb4;','dwes','abc123.');
        // Realizamos la consulta.
        $result = $conex->query("SELECT * FROM usuario WHERE Usuario='$_POST[user]' AND Clave='$claveEncript'");
        // Comprobamos el resultado.
        if ($result->rowCount()) header ('Location:datos.php');
        else $msg = "Usuario o clave incorrecto!";       
    } catch (PDOException $ex) {
        die($ex->getMessage());
    }
}
?>
<html>
    <head>
        <title>BD encript - Autenticar con MD5</title>
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
