<html>
    <head>
        <title>BBDD_DWES - Tienda</title>
    </head>
    <body>
        <?php
            if (isset($_POST['actualizar'])) {
                // Realizamos la conexión a la BD.
                try {
                    $conex = new mysqli("localhost","dwes","abc123.","dwes");
                    $conex->set_charset("utf8mb4");
                    $conex->autocommit(false);
                } catch (Exception $ex) {
                    die($ex->getMessage());
                }
                
                // Realizamos las consultas.
                try {
                    if ($conex->query(
                            "UPDATE stock SET unidades=unidades-$_POST[unidades] "
                            . "WHERE tienda=$_POST[origen] AND producto='$_POST[codProd]'")) {
                        echo "Actualización realizada - Filas afectadas: ".$conex->affected_rows;
                    }
                    
                    $conex->commit();
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    $conex->rollback();
                }
                // Cerramos la conexión a la BD.
                $conex->autocommit(true);
                $conex->close();
            }            
        ?>
        
        <!-- Formulario -->
        <h1>Traspaso Stock</h1>
        <form action="" method="POST">
            <p>Tienda Origen: 
                <select name="origen">
                    <option value="1">Central</option>
                    <option value="2">Sucursal 1</option>
                    <option value="3">Sucursal 2</option>
                </select>
            </p>
            <p>Tienda Destino: 
                <select name="destino">
                    <option value="1">Central</option>
                    <option value="2">Sucursal 1</option>
                    <option value="3">Sucursal 2</option>
                </select>
            </p>
            <p>Código Producto: <input type="text" name="codProd"></p>
            <p>Unidades: <input type="number" name="unidades"></p>
            <input type="submit" name="actualizar" value="Actualizar">
        </form>
    </body>
</html>
