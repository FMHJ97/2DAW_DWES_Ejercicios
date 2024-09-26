<html>
    <head>
        <title>Ejercicio 01</title>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 1em;
            }
            th {
                font-size: 1.25em;
                background-color: lightblue;
            }
        </style>
    </head>
    <body>

        <h1>Tabla sobre $_Server</h1>
        
        <table>
            
            <th>Índice</th><th>Valor</th>
            
            <?php
                foreach ($_SERVER as $key => $value) {
                    echo "<tr><td>".$key."</td><td>".$value."</td></tr>";
                }
            ?>
            
        </table>
        
    </body>
</html>

