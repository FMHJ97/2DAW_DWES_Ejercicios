<!doctype html>

<html>
    <head>
        <title>Exercise 06 - For</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }
    </style>    
    <body>

        <h1>Sumar los números de 1 al 100 (For)</h1>
        
        <?php

            $sum = 0;
            
            for ($cont = 1; $cont <= 100; $cont++) {
                $sum += $cont;
            }
            
            echo "<p>Resultado = ".$sum."</p>";
        
        ?>
        
    </body>
</html>
