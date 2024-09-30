<!doctype html>
<html>
    <head>
        <title>Ejercicio 13</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }        
    </style>
    <body>

        <h1>Eliminar Elementos Duplicados</h1>
        
        <?php
            # Creamos el array.
            $array=array(1,2,1,2,2,3,2,4,3,5,1,4);
            
            /*
             * Recorremos el array en busca de duplicados.
             * Comenzamos desde el primer elemento del array.
             */
            for ($i = 0; $i < count($array); $i++) {
                /*
                 * Para eliminar el elemento duplicado,
                 * procedemos a desplazarnos de derecha a izquierda.
                 */
                for ($j = count($array) - 1; $j > $i; $j--) {
                    # Si existe coincidencia, procedemos a eliminar.
                    if ($array[$i] === $array[$j]) {
                        /*
                         * Elimina aquellos elementos desde la posición indicada.
                         * Al indicar el valor 1, informamos cuantos elementos
                         * queremos eliminar. **REAJUSTA LAS KEYS DEL ARRAY**.
                         * 
                         * En este caso, no es relevante la correlación índice y valor.
                         * Sin embargo, en los casos que si sea, el reajuste de
                         * índices puede ser mala idea (pueden aportar info sobre
                         * el contenido).
                         */
                        array_splice($array, $j, 1);
                    }
                }                
            }
            
            # Mostramos el array sin duplicados.
            foreach ($array as $value) {
                echo "<p>".$value."</p>";
            }
        ?>
        
    </body>
</html>
