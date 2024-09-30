<!doctype html>
<html>
    <head>
        <title>Ejercicio 12</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }        
    </style>
    <body>

        <h1>Suma de Todos los Elementos</h1>
        
        <?php
            # Creamos el array.
            $array=array(12,42,13,25,33);
            
            # Variable suma.
            $suma = 0;
            
            # Sumamos todos los elementos del array.
            for ($i = 0; $i < count($array); $i++) {
                $suma += $array[$i];
            }            
            
//            Alternativa
//            $suma= array_sum($array);
            
            # Mostramos el resultado.
            echo "<p>La suma total es ".$suma."</p>";
        ?>
        
    </body>
</html>
