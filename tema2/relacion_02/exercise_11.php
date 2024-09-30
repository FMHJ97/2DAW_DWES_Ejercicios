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
            # Variable suma.
            $suma = 0;
            
            # Obtenemos el promedio.
            for ($i = 0; $i < count($array); $i++) {
                $suma += $array[$i];
            }
            $promedio = $suma / count($array);

//            Alternativa con funciones.
//            $promedio = (array_sum($array) / count($array));
            
            # Mostramos el promedio.
            echo "<p>El promedio es ".$promedio."</p>";
        ?>
        
    </body>
</html>
