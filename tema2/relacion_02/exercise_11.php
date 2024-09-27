<!doctype html>
<html>
    <head>
        <title>Ejercicio 11</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }        
    </style>
    <body>

        <h1>Calcular el Promedio de un Array</h1>
        
        <?php
            # Creamos el array.
            $array=array(12,42,13,25,33);
            
            # Obtenemos el promedio.
            $promedio = (array_sum($array) / count($array));
            
            # Mostramos el promedio.
            echo "<p>El promedio es ".$promedio."</p>";
        ?>
        
    </body>
</html>
