<!doctype html>

<html>
    <head>
        <title>Exercise 07</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }
    </style>    
    <body>

        <h1>Suma de los cuadrados de los 100 primeros números enteros</h1>
        
        <?php
        
            $cont = 1;
            $sum = 0;
            
            while ($cont <= 100) {
                $sum += pow($cont, 2);
                $cont++;
            }
            
            echo "<p>Resultado = ".$sum."</p>";
        
        ?>
        
    </body>
</html>
