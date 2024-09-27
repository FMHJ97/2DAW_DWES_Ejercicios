<!doctype html>
<html>
    <head>
        <title>Ejercicio 14</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }        
    </style>
    <body>

        <h1> Contar la Frecuencia de Elementos</h1>
        
        <?php
            # Creamos el array.
            $array=array(1,2,1,2,2,3,2,4,3,5,1,4,4);
            
            /*
             * Usamos un array asociativo para contar las coincidencias.
             * Los valores(elementos) se utilizarán como keys del nuevo
             * array, y la frecuencia o conteo como valor.
             */
            $arrayCont = array_count_values($array);
            
            # Recorremos el array contador y mostramos los resultados.
            foreach ($arrayCont as $element => $count) {
                echo "<p>El elemento ".$element." aparece ".$count." veces.</p>";
            }            
        ?>
        
    </body>
</html>
