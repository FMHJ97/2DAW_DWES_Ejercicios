<!doctype html>
<html>
    <head>
        <title>Exercise 02</title>
    </head>
    <body>
        
        <table border="1px solid black" style="border-collapse: collapse";>
            
            <?php

            $x = 10;
            $y = 10;
            
            # Generamos las filas.
            for ($i = 0; $i < $y; $i++) {
                # Etiquetas de filas y celdas.
                echo "<tr>";
                    # Generamos las columnas.
                    for ($j = 0; $j < $x ;$j++) {
                        # Generamos numero hasta conseguir impar.
                        do {
                            $num = rand(1, 100);
                        } while($num % 2 == 0);
                        # Agregamos en la celda correspondiente.
                        echo "<td>".$num."</td>";
                     }
                echo "</tr>";
            }

            ?>
            
        </table>        
        
    </body>
</html>
