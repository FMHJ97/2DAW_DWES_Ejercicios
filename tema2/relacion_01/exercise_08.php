<!doctype html>

<html>
    <head>
        <title>Exercise 08</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }
    </style>    
    <body>

        <h1>Suma de los 100 primeros números enteros pares</h1>
        
        <?php
        
            $cont = 1;
            $sum = 0;
            $num = 0;
            
            while ($cont <= 100) {
                
                do {
                    $num++;
                } while ($num % 2 != 0);
                
                $sum += $num;
                $cont++;
            }
            
            echo "<p>Resultado = ".$sum."</p>";
        
        ?>
        
    </body>
</html>
