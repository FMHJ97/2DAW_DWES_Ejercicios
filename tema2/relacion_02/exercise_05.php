<!doctype html>
<html>
    <head>
        <title>Ejercicio 5</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 1em;
            font-size: 1.25em;
            text-align: center;
        }
        th {
            background-color: lightblue;
        }        
    </style>
    <body>

        <h1>Arrays Multidimensionales</h1>
        
        <?php
            # Creamos el array multidimensional(matriz).
            $productos=array(
                0=>array("nombre"=>"Mesa","precio"=>110,"cantidad"=>10),
                1=>array("nombre"=>"Silla","precio"=>85,"cantidad"=>20),
                2=>array("nombre"=>"Lámpara","precio"=>32.50,"cantidad"=>15)
            );
            
            # Mostramos el nombre y precio del segundo producto.
            echo "<p>Segundo Producto: ".$productos[1]["nombre"]." - "
                    .$productos[1]["precio"]."€";
        ?>
        
        <br>
        
        <!-- Mostramos todos los productos -->
        <table>
            <?php
                echo "<tr>";
                foreach ($productos[0] as $indC => $col) {
                    echo "<th>".$indC."</th>";
                }
                echo "</tr>";
                foreach ($productos as $indR => $row) {
                    echo "<tr>";
                    foreach ($row as $indC => $col) {
                        echo "<td>".$col."</td>";
                    }
                    echo "</tr>";
                }
            ?>
        </table>
        
    </body>
</html>
