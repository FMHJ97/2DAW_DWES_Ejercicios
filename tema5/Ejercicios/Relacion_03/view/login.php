<?php

// Importaciones.
require_once '../model/cliente.php';
require_once '../controller/controllerCliente.php';

// Si procedemos a Iniciar sesión.
if (isset($_POST['login'])) {
    
}

?>

<html>
    <head>
        <title>Login - MVC (alquiler_juegos)</title>
    </head>
    <body>
        <h1>Iniciar sesión</h1>
        <form action="" method="POST">
            <p>Usuario: <input type="text" name="user"></p>
            <p>Clave: <input type="password" name="pwd"></p>
            <input type="submit" name="login" value="Iniciar sesión">
        </form>
        <a href="registro.php"><button>Registro</button></a>
    </body>
</html>
