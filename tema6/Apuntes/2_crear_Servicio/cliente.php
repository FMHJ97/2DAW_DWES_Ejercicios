<?php

$datos = file_get_contents("http://localhost/2DAW_DWES_Ejercicios/tema6/2_crear_Servicio/server.php");

$trenes = json_decode($datos);

foreach ($trenes as $tren) {
    echo "<strong>Recorrido:</strong> $tren->recorrido , <strong>Hora:</strong> $tren->hora, <strong>Precio:</strong> $tren->precio <br><br>";
}

?>