<?php
require_once '../controller/conexion.php';
require_once '../controller/controllerEmpleado.php';
require_once '../model/empleado.php';

if (isset($_POST['login'])) {
    if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
        $emp = ControllerEmpleado::verifyEmpleado($_POST['email'], $_POST['pwd']);
        if ($emp) {
            ini_set("session.gc_maxlifetime", 1800);
            session_set_cookie_params(1800);
            session_start();
            $_SESSION['autenticado'] = $emp;
            // Redirigimos a Inicio.
            header("Location:inicio.php");
        } else {
            // Mensaje de error.
            $msg = "<br><span style='color:red'>USUARIO O CLAVE INCORRECTA!</span>";
        }
    } else {
        // Mensaje de error.
        $msg = "<br><span style='color:red'>USUARIO O CLAVE INCORRECTA!</span>";
    }
}
?>

<html>
    <head>
        <title>Login (MVC - Empleados)</title>
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
        <!-- Mostramos el mensaje de error -->
        <?php if (isset($_POST['login']) && isset($msg)) echo $msg; ?>
    </body>
</html>
