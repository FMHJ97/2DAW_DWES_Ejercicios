<?php
// Las sesiones se crean en el servidor.
// Dichas sesiones se almacenan en el propio servidor
// en ficheros, normalmente.
// Cada fichero de sesión estará identificado por una identificación (SID).
// 
// En el cliente, en las cabeceras, se enviarán las SID de cada sesión.
// Estos datos se almacenan en cookies.
// En un solo cliente (navegador) solo puede haber una sesión activa.
//
// Para acceder a todas las variables de sesión, solo debemos
// recorrer en la variable superglobal $_SESSION[].

// Creamos o propagamos una sesión, creando una cookie.
session_start();

// Podemos visualizar el nombre y valor de la sesión actual.
echo session_name()." <=> ". session_id();

// Si queremos cambiar el nombre por defecto de la cookie
// de sesión (PHPSESSID), debemos hacerlo antes de crear
// o propagar la sesión.
session_name("comares");

session_start();

// Para eliminar una sesión o su cookie de sesión,
// debemos seguir 3 pasos:
// 
// 1.- Eliminar la sesión físicamente.
session_destroy();

// 2.- Eliminar la sesión en memoria.
session_unset();

// 3.- Eliminar la cookie de sesión en el cliente (navegador).
// El último parámetro indica que busque en la carpeta raíz.
setcookie("comares", "", time()-3600, "/");
?>