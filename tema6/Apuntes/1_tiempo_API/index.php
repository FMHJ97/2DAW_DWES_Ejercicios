<?php 

$datos = file_get_contents(
        "https://api.openweathermap.org/data/2.5/weather?q=Lucena,es&units=metric&appid=72387bb2b356819ecbab7845c36e75e0");

//echo $datos;

// Usaremos un json_decode para descodificar el JSON obtenido.

$datos_decode = json_decode($datos); // Devuelve un objeto.

//var_dump($datos_decode);

echo "En la ciudad de " . $datos_decode->name . " tendrá la siguiente temperatura:<br>";
echo "Mínima: " . $datos_decode->main->temp_min . "ºC";

?>