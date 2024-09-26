<!doctype html>
<html>
    <head>
        <title>Ejercicio 8</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }        
    </style>
    <body>

        <h1>Buscar en un Array</h1>
        
        <?php
            # Creamos el array.
            $edades = array(20,30,40,25,35);
            
            # Variable con la edad a buscar en el array.
            $age = 25;
            
            /*
             * Comprobamos la posición de la edad 25.
             * En caso positivo, mostramos posición.
             * En caso contrario, mostramos un mensaje en pantalla.
             */
            if (array_search($age, $edades)) {
                echo "<p>La posición de la edad ".$age." es ".array_search($age, $edades)."</p>";
            } else {
                echo "<p>La edad ".$age." no está en el array.</p>";
            }
        ?>
        
    </body>
</html>
