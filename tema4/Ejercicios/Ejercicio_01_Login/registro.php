<?php
// Creamos una conexión a BD.
if (isset($_POST['registrar']) && !isset($conex)) {
    try {
        $conex = new PDO('mysql:host=localhost;dbname=encript;charset=utf8mb4;','dwes','abc123.');
    } catch (PDOException $ex) {
        die($ex->getMessage());
    }
}

// Si pulsamos sobre Registrar.
if (isset($_POST['registrar'])) {
    // Codificamos la clave introducida usando password_hash().
    $clave_ph = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    try {
        // Preparamos la consulta a la BD.
        $stmt = $conex->prepare("INSERT INTO usuario VALUES (?,?,?,?,?)");
        // Ejecutamos la consulta.
        $stmt->execute(array($_POST['dni'],$_POST['name'],$_POST['surname'],$_POST['user'],$clave_ph));
        // Comprobamos la operación.
        if ($stmt->rowCount()) {
            header("Location: login.php?success");
            exit();
        }
    } catch (PDOException $ex) {
        echo $ex->errorInfo[1]." => ".$ex->errorInfo[2];
    }
}
?>

<html>
    <head>
        <title>BD encript - Formulario de acceso</title>
    </head>
    <body>
        <h1>Formulario de acceso - Registro</h1>
        <form action="" method="POST">
            <p>DNI: <input type="text" name="dni"></p>
            <p>Nombre: <input type="text" name="name"></p>
            <p>Apellidos: <input type="text" name="surname"></p>
            <p>Usuario: <input type="text" name="user"></p>
            <p>Clave: <input type="password" name="pwd"></p>
            <input type="submit" name="registrar" value="Registrar">
            <a href="login.php"><input type="button" value="Login"></a>
        </form>
    </body>
</html>
