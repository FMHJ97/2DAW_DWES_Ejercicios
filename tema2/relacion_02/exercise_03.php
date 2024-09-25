<!doctype html>
<html>
    <head>
        <title>Ejercicio 3</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }
    </style>
    <body>

        <h1>Ordenación de Arrays</h1>
        
        <?php
        
            // Creamos el array.
            $numeros = array(3, 1, 4, 1, 5, 9);
            
            echo "<h2>Ordenación ascendente</h2>";
            
            /*
             * Esta función asigna nuevas clave a los elemenos
             * del array. Eliminará cualquier clave existente que
             * haya sido asignada, en lugar de reordenar las claves.
             */
            sort($numeros); # Ascendente(menor a mayor).
            
            foreach ($numeros as $key => $value) {
                echo "<p>[".$key."] : ".$value."</p>";
            }
            
            echo "<h2>Ordenación descendente</h2>";
            
            /*
             * Esta función asigna nuevas clave a los elemenos
             * del array. Eliminará cualquier clave existente que
             * haya sido asignada, en lugar de reordenar las claves.
             */
            rsort($numeros); # Descendente(mayor a menor).
            
            foreach ($numeros as $key => $value) {
                echo "<p>[".$key."] : ".$value."</p>";
            }            
        
        ?>
        
    </body>
</html>
