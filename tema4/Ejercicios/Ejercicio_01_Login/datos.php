<?php
// Posible redirección si accedemos directamente.
if (!isset($_GET['login'])) {
    header('Location:login.php');
    exit();
}

// Comprobamos si hemos entrado por primera vez.
if (isset($_COOKIE['login'])) {
    $msg = "Bienvenid@, $_COOKIE[name] $_COOKIE[surname]! Tu último acceso fue $_COOKIE[time]";
    setcookie('time', date('d-m-Y H:i:s', time()));
} else {
    setcookie('login','on');
    setcookie('time', date('d-m-Y H:i:s', time()));
    $msg = "Es la primera vez que entras. Bienvenid@, $_COOKIE[name] $_COOKIE[surname]!";
}

// Si pulsamos sobre Salir.
if (isset($_POST['salir'])) {
    header('Location:login.php');
    exit();
}
?>

<html>
    <head>
        <title>BD encript - Credenciales Autenticadas</title>
    </head>
    <body>
        <h1>Credenciales Autenticadas</h1>
        <?php echo $msg; ?><br><br>
        <form action="" method="POST">
            <input type="submit" name="salir" value="Salir">
        </form>
    </body>
</html>
