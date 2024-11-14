<?php
if (!isset($_SESSION['credenciales'])) {
    header("Location:index.php");
    exit();
}
?>
<html>
    <head>
        <title>Ejercicio 02: Logueo - Intentos</title>
    </head>
    <body>
        <h1>Ha agotado el número de intentos!</h1>
        <h2>Cierre el navegador e inténtalo más tarde.</h2>
    </body>
</html>
