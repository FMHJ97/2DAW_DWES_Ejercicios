<!doctype html>

<html>
    <head>
        <title>Exercise 03</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }
    </style>    
    <body>
        
        <h1>¿Qué número es mayor?</h1>

        <?php
        
            $num1 = 10;
            $num2 = -5;
            $num3 = 12;
            
            echo "<p>Número 1: ".$num1."</p>";
            echo "<p>Número 2: ".$num2."</p>";
            echo "<p>Número 3: ".$num3."</p>";
            
            if (($num1 >= $num2) && ($num1 >= $num3)) {
                echo "<br><p>Número Mayor: ".$num1."</p>";
            } elseif (($num2 >= $num1) && ($num2 >= $num3)) {
                echo "<br><p>Número Mayor: ".$num2."</p>";
            } else {
                echo "<br><p>Número Mayor: ".$num3."</p>";
            }
        
        ?>
        
    </body>
</html>
