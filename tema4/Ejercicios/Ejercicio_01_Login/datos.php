<?php
// Posible redirección si accedemos directamente.
if (!isset($_GET['login'])) {
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
        <?php
        
        ?>
    </body>
</html>
