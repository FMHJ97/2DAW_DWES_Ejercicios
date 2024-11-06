<?php
// Creamos la cookie.
setcookie('login', date('d-m-Y', time()), time() + 3600*24*365);
// Condiciones.
if (isset($_COOKIE['login'])) echo "Su última visita fue ".$_COOKIE['login'];
else echo "Bienvenido, gracias por su visita."
?>