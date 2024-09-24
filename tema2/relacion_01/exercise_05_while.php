<!doctype html>

<html>
    <head>
        <title>Exercise 05 - While</title>
    </head>
    <style>
        table, td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 1.5em;
            padding: 1em;
        }
    </style>    
    <body>

        <h1>Tabla Ejercicio 04 usando While y Do-While</h1><br>
        
        <h2>Tabla con While</h2>
        <table>
            
            <?php
                $y = 5; # Filas
                $x = 7; # Columnas
                $num = 1; #Contador
                
                while ($y > 0) {
                    // Volvemos a inicializar las columnas.
                    $col = $x;
                    echo "<tr>";
                    while ($col > 0) {
                        # Agregamos en la celda correspondiente.
                        echo "<td>".$num."</td>";
                        $num++;
                        $col--;
                    }
                    echo "</tr>";
                    $y--;
                }

            ?>
            
        </table>
        
    </body>
</html>
