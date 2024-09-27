<!doctype html>
<html>
    <head>
        <title>Ejercicio 10</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }        
    </style>
    <body>

        <h1>Contar las Vocales en una Cadena</h1>
        
        <?php
            # Creamos una cadena de texto.
            $str = "La Casa Azul";
            # Contador de vocales.
            $cont=0;
            
            /* 
             * Recorremos cada carácter del string. Para
             * mejorar la búsqueda, convertimos la cadena
             * a minúsculas.
             */
            $strLower = strtolower($str);
            for ($i = 0; $i < strlen($strLower); $i++) {
                if ($strLower[$i] == "a" || $strLower[$i] == "e" || $strLower[$i] == "i"
                        || $strLower[$i] == "o" || $strLower[$i] == "u") {
                    $cont++;
                }
            }
            
            # Mostramos el resultado.
            echo "<p>La cadena de texto = ".$str." contiene ".$cont." vocales.</p>";            
        ?>
        
    </body>
</html>
