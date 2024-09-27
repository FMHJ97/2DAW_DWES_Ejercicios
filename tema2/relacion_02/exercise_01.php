<!doctype html>
<html>
    <head>
        <title>Ejercicio 1</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }
    </style>
    <body>

        <h1>Creación y Acceso a Elementos</h1>
        
        <?php
        
            // Creamos el array.
            $colores = array(
                1=>"rojo", 2=>"verde", 3=>"azul", 4=>"amarillo"
            );
            
            echo "<p>Primer elemento: ".$colores[1]
                    ."<br>Tercer elemento: ".$colores[3]."</p>";
            
            // Agregamos un nuevo elemento al array.
            $colores[] = "naranja";
            
            echo "<h2>Elementos del array</h2>";
            // Mostramos todos los elementos del array con sus índices.
            for ($i = 1; $i < count($colores); $i++) {
                echo "<p>[".$i."] : ".$colores[$i]."</p>";
            }
            
        ?>
        
    </body>
</html>
