<!doctype html>

<html>
    <head>
        <title>Exercise 09</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }
    </style>
    <body>

        <h1>Ordena tres números de mayor a menor</h1>
        
        <?php
        
            $num1 = 2;
            $num2 = 10;
            $num3 = 10;
            
            // Comprobamos si el primer número es mayor.
            if ($num1 >= $num2 && $num1 >= $num3) {
                // Comprobamos si el segundo número es el siguiente mayor.
                if ($num2 >= $num1) {
                    echo "<p>Resultado = ".$num1." : ".$num2." : ".$num3;
                } else {
                    echo "<p>Resultado = ".$num1." : ".$num3." : ".$num2;
                }
            // Comprobamos si el segundo número es mayor.
            } elseif ($num2 >= $num1 && $num2 >= $num3) {
                // Comprobamos si el tercer número es el siguiente mayor.
                if ($num3 >= $num1) {
                    echo "<p>Resultado = ".$num2." : ".$num3." : ".$num1;
                } else {
                    echo "<p>Resultado = ".$num2." : ".$num1." : ".$num3;
                }
            // Comprobamos si el tercer número es mayor.
            } elseif ($num3 >= $num1 && $num3 >= $num2) {
                // Comprobamos si el primer número es el siguiente mayor.
                if ($num1 >= $num2) {
                    echo "<p>Resultado = ".$num3." : ".$num1." : ".$num2;
                } else {
                    echo "<p>Resultado = ".$num3." : ".$num2." : ".$num1;
                }            
            }
        
        ?>
        
    </body>
</html>
