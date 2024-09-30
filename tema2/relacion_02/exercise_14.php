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
            # Variable contador.
            $contador = 0;
            
            /*
             * Usamos un array asociativo para contar las coincidencias.
             * Los valores(elementos) se utilizarán como keys del nuevo
             * array, y la frecuencia o conteo como valor.
             */
//            $arrayCont = array_count_values($array);
            
            foreach ($array as $valArray) {
                foreach ($array as $ele) {
                    if ($valArray === $ele) {
                        $contador++;
                    }
                }
                /* 
                 * Array donde los valores del array original se utilizarán como keys,
                 * y la frecuencia o conteo como valor.
                 */
                $arrayCont[$valArray]=$contador;           
                # Reiniciamos contador.
                $contador = 0;
            }            
            
            # Recorremos el array contador y mostramos los resultados.
            foreach ($arrayCont as $element => $count) {
                echo "<p>El elemento ".$element." aparece ".$count." veces.</p>";
            }            
        ?>
        
    </body>
</html>
