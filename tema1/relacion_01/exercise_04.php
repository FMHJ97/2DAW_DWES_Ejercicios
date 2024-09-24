<!doctype html>

<html>
    <head>
        <title>Exercise  04</title>
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

        <h1>Tabla con los primeros 35 Números Naturales</h1><br>
        
        <table>
            
            <?php
                $y = 5; # Filas
                $x = 7; # Columnas
                $num = 1; #Contador

                # Generamos las filas.
                for ($i = 0; $i < $y; $i++) {
                    # Etiquetas de filas y celdas.
                    echo "<tr>";
                        # Generamos las columnas.
                        for ($j = 0; $j < $x ;$j++) {
                            # Agregamos en la celda correspondiente.
                            echo "<td>".$num."</td>";
                            $num++;
                         }
                    echo "</tr>";
                }
            ?>
            
        </table>
        
    </body>
</html>
