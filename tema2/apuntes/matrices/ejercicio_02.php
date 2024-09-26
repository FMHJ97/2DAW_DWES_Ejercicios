<html>
    <head>
        <title>Ejercicio 02</title>
    </head>
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
    <body>

        <table>
            
            <?php
            
                $m1=array(
                    "Contabilidad"=>array("Nombre"=>"Pepe","Apellido"=>"López","Salario"=>2100,"Edad"=>35),
                    "Marketing"=>array("Nombre"=>"Juan","Apellido"=>"Rodríguez","Salario"=>2220,"Edad"=>41),
                    "Ventas"=>array("Nombre"=>"María","Apellido"=>"Sánchez","Salario"=>2315,"Edad"=>38),
                    "Administración"=>array("Nombre"=>"Susana","Apellido"=>"Ramírez","Salario"=>1850,"Edad"=>53),
                    "Dirección"=>array("Nombre"=>"Rosa","Apellido"=>"Carpio","Salario"=>3550,"Edad"=>58)
                );
                
                echo "<th></th>";
                foreach ($m1["Ventas"] as $index => $col) {
                    echo "<th>".$index."</th>";
                }
                
                foreach ($m1 as $indF => $fila) {
                    echo "<tr><td>".$indF."</td>";
                    foreach ($fila as $indC => $col) {
                        echo "<td>".$col."</td>";
                    }
                    echo "</tr>";
                }
            
            ?>
            
        </table>
        
    </body>
</html>
