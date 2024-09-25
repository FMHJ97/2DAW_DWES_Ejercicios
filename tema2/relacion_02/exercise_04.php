<!doctype html>
<html>
    <head>
        <title>Ejercicio 4</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }
    </style>
    <body>

        <h1>Contar Elementos de un Array</h1>
        
        <?php
        
            // Creamos el array.
            $animales = array("gato","perro","elefante","jirafa");
            
            // Mostramos el número de elementos del array.
            echo "<p>Total elementos: ". count($animales)."</p>";
            
            // Agregamos dos elementos nuevos al array.
            $animales[] = "león";
            $animales[] = "rinoceronte";
            
            // Mostramos el número actualizado de elementos.
            echo "<p>Total elementos (actualizado): ". count($animales)."</p>";
        
        ?>
        
    </body>
</html>
