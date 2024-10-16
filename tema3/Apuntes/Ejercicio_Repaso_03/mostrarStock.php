<html>
    <head>
        <title>Mostrar Stock de Producto</title>
    </head>
    <style>
        h1 {margin-bottom:0;}
        #encabezado {background-color:#ddf0a4;}
        #contenido {background-color:#EEEEEE;height:600px;}
        #pie {background-color:#ddf0a4;color:#ff0000;height:30px;}
    </style>
    <body>
        
        <?php
            try {
                $conex = new mysqli("localhost","dwes","abc123.","dwes");
                $conex->set_charset("utf8mb4");
            } catch (Exception $ex) {
                die("ERROR, NO SE HA PODIDO CONECTAR A LA BD.");
            }
        ?>
        
        <div id="encabezado">
            <h1>Mostrar Stock de un Producto en cada una de las Tiendas</h1>
            <form action="" method="POST">
                <select name="producto">
                    <?php
                        try {
                            $result = $conex->query("SELECT * FROM producto");
                            if ($result->num_rows) {
                                $fila = $result->fetch_object();
                                
                            }
                        } catch (Exception $ex) {
                            die($ex->getMessage());
                        }
                    ?>
                </select>
            </form>
        </div>
        
    </body>
</html>
