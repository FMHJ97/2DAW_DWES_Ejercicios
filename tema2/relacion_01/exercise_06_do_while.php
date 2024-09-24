<!doctype html>

<html>
    <head>
        <title>Exercise 06 - Do While</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }
    </style>    
    <body>

        <h1>Sumar los números de 1 al 100 (Do While)</h1>
        
        <?php
        
            $cont = 1;
            $sum = 0;
            
            do {
                $sum += $cont;
                $cont++;
            } while ($cont <= 100);
            
            echo "<p>Resultado = ".$sum."</p>";
        
        ?>
        
    </body>
</html>
