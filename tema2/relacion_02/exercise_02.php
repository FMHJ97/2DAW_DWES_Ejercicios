<!doctype html>
<html>
    <head>
        <title>Ejercicio 2</title>
    </head>
    <style>
        p {
            font-size: 1.5em;
        }
    </style>
    <body>

        <h1>Array Asociativo</h1>
        
        <?php
        
            // Creamos el array.
            $persona = array(
                "nombre"=>"Juan", "edad"=>25, "ciudad"=>"Madrid"
            );
            
            // Mostramos el nombre y la ciudad.
            echo "<p>Nombre: ".$persona["nombre"]
                    ."<br>Ciudad: ".$persona["ciudad"]."</p>";
            
            // Agregamos un nuevo elemento al array.
            $persona["profesion"] = "Ingeniero";
            
            echo "<h2>Elementos del array</h2>";
            // Mostramos todos los elementos del array con sus índices.
            foreach ($persona as $key => $value) {
                echo "<p>[".$key."] : ".$value."</p>";
            }
        
        ?>
        
    </body>
</html>
