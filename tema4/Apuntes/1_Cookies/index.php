<?php
// Creamos una cookie.
setcookie('usuario','Francisco');

// Para la fecha de expiración, podemos usar
// la función time(). Le sumamos el número de segundos
// antes de que queramos que expire.
//
//setcookie('usuario','Francisco', time() + 3600);
//
// Para eliminar una cookie, usaremos time()-1.

// Si queremos modificar el tamaño del output buffering,
// tenemos que acceder al fichero php.ini (xampp -> config)
// 
// Es un mecanismo que controla el flujo de datos que enviamos
// (excluyendo headers y cookies) cuando PHP no puede contener más.

// Para acceder a las cookies ejecutadas en el servidor.
// Enviadas desde el Cliente (almacenadas).
if (isset($_COOKIE['usuario'])) echo$_COOKIE['usuario'];
?>

<br><a href="clienteCookie.php">Ir a clienteCookie</a>