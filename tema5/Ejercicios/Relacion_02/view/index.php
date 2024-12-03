<?php

require_once '../controller/conexion.php';
require_once '../controller/controllerEmpleado.php';
require_once '../model/empleado.php';

if (isset($_POST['login'])) {
    try {
        
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

?>

<html>
    <head>
        <title>MVC - Empleados</title>
    </head>
    <body>
        <h1>Login</h1>
        <form action="" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
            <label for="pwd">Password:</label>
            <input type="password" name="pwd" id="pwd">
            <input type="submit" name="login" value="Iniciar sesión">
        </form>
    </body>
</html>
