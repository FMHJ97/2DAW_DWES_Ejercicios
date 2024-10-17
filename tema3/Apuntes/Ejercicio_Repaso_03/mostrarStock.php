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
                Producto:
                <select name="producto">
                    <?php
                        // Guarda el producto seleccionado si se envía el formulario
                        $selectedItem = isset($_POST['producto']) ? $_POST['producto'] : '';
                    
                        try {
                            $result = $conex->query("SELECT * FROM producto");
                            // Recorremos las filas obtenidas de la consulta.
                            while ($fila = $result->fetch_object()) {
                                // Marcar como seleccionado el producto que el usuario ha escogido
                                $selected = ($fila->cod == $selectedItem) ? 'selected' : '';                                
                                echo "<option value='$fila->cod' $selected>$fila->nombre_corto</option>";
                            }
                        } catch (Exception $ex) {
                            die($ex->getMessage());
                        }
                    ?>
                </select>
                <input type="submit" name="show" value="Mostrar Stock">
            </form>
        </div>
        
        <div id="contenido">
            <?php
                if (isset($_POST['show'])) {                     
                    try {
                        // Consulta la tienda y stock por producto
                        $stock_result = $conex->query(
                                "SELECT tienda, unidades FROM stock WHERE producto='$_POST[producto]'");

                        while ($row = $stock_result->fetch_object()) {
                            // Consulta el nombre de la tienda según el código de tienda obtenido en el stock
                            $tienda_result = $conex->query(
                                    "SELECT nombre FROM tienda WHERE cod = '$row->tienda'");

                            if ($tienda = $tienda_result->fetch_object()) {
                                echo "<p>Tienda $tienda->nombre = $row->unidades unidades</p>";
                            }
                        }
                    }
                    catch (Exception $ex) {
                        die($ex->getMessage());
                    }
                }
                
                // Cerramos la conexión.
                $conex->close();
            ?>
        </div>
        
    </body>
</html>
