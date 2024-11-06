<?php
// Si queremos modificar el tamaño del output buffering,
// tenemos que acceder al fichero php.ini (xampp -> config)
// 
// Es un mecanismo que controla el flujo de datos que enviamos
// (excluyendo headers y cookies) cuando PHP no puede contener más.

// Podemos activar el output buffering manualmente.
// Almacena hasta que le digamos.
ob_start();

echo "Hola";
echo "Adios";

// Podemos visualizar el tamaño del buffer.
echo ob_get_length();

// Volcar (enviar) el búfer de salida y deshabilitar el almacenamiento en el mismo.
ob_end_flush();
?>