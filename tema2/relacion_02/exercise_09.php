<!doctype html>
<html>
    <head>
        <title>Ejercicio 9</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }        
    </style>
    <body>

        <h1>Encontrar el Valor Máximo y Mínimo</h1>
        
        <?php
            # Creamos el array.
            $array = array(20,55,4,1,33);
            
            # Seleccionamos el primer valor como min y max.
            $min = $array[0];
            $max = $array[0];
            
            /*
             * Recorremos el array en busca del valor máximo y mínimo.
             * Comenzamos desde el segundo elemento del array.
             */
            for ($i = 1; $i < count($array); $i++) {
                if ($array[$i] <= $min) {
                    $min=$array[$i];
                } elseif ($array[$i] >= $max) {
                    $max=$array[$i];
                }
            }
            
            # Mostramos los valores máximo y mínimo.
            echo "<p>El valor mínimo es ".$min." y el valor máximo es ".$max;
        ?>
        
    </body>
</html>
