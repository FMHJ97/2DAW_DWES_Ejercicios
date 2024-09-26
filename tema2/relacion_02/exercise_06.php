<!doctype html>
<html>
    <head>
        <title>Ejercicio 6</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }        
    </style>
    <body>

        <h1>Funciones de Arrays</h1>
        
        <?php
            # Creamos el array.
            $nombres = array("Ana","Luis","Carlos","María");
            
            # Mostramos los nombres en orden inverso.
            foreach (array_reverse($nombres) as $value) {
                echo "<p>".$value."</p>";
            }
            
            echo "<br>";
            
            # Comprobamos si "Carlos" está en el array.
            if (in_array("Carlos", $nombres)) {
                echo "<p>Carlos si está en el array</p>";
            } else {
                echo "<p>Carlos no está en el array</p>";
            }
            
            echo "<br>";
            
            # Agregamos "Juan" al final de array y mostramos.
            array_push($nombres, "Juan");
            foreach ($nombres as $value) {
                echo "<p>".$value."</p>";
            }
        ?>
        
    </body>
</html>
