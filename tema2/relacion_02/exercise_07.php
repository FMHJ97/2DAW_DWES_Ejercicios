<!doctype html>
<html>
    <head>
        <title>Ejercicio 7</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }        
    </style>
    <body>

        <h1>Eliminar Elementos de un Array</h1>
        
        <?php
            # Creamos el array.
            $paises = array("España","Francia","Italia","Alemania","Portugal");
            
            # Eliminamos Italia del array.
            foreach ($paises as $key => $value) {
                if ($value === "Italia") {
                    unset($paises[$key]);
                }
            }
            # Mostramos el array resultante.
            foreach ($paises as $value) {
                echo "<p>".$value."</p>";
            }
            
            echo "<br>";
            
            # Borramos el último elemento del array y mostramos array actualizado.
            array_pop($paises);
            foreach ($paises as $value) {
                echo "<p>".$value."</p>";
            }            
        ?>
        
    </body>
</html>
