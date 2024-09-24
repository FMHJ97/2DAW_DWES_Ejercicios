<!doctype html>

<html>
    <head>
        <title>Exercise 06 - While</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }
    </style>    
    <body>

        <h1>Sumar los números de 1 al 100 (While)</h1>
        
        <?php
        
            $cont = 1;
            $sum = 0;
            
            while ($cont <= 100) {
                $sum += $cont;
                $cont++;
            }
            
            echo "<p>Resultado = ".$sum."</p>";
        
        ?>
        
    </body>
</html>
