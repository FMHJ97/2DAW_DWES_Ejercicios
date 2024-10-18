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
                } catch (Exception $ex) {
                    die("ERROR AL CONECTAR CON EL SERVIDOR DE BD");
                }
                
                // Realizamos las consultas.
                try {
                    $conex->autocommit(false);
                    
                    // Actualizamos la tienda de origen.
                    $conex->query(
                            "UPDATE stock SET unidades=unidades-$_POST[unidades] "
                            . "WHERE tienda=$_POST[origen] AND producto='$_POST[codigo]' AND unidades >= $_POST[unidades]");
                    
                    if (!$conex->affected_rows) {
                        echo "Número de unidades superior al stock de tienda origen.";
                    }
                    else {
                    // Actualizamos la tienda de destino.                    
                    $conex->query(
                            "UPDATE stock SET unidades=unidades+$_POST[unidades] "
                            . "WHERE tienda=$_POST[destino] AND producto='$_POST[codigo]'");
                        if (!$conex->affected_rows) {                   
                            $conex->query(
                                    "INSERT INTO stock VALUES ('$_POST[codigo]',$_POST[destino],$_POST[unidades])");
                        }
                    }
                    // Realizar cambios.
                    $conex->commit();
                    echo "Operación Realizada con Éxito!";
                    // Cerramos la conexión.
                    $conex->close();
                } catch (Exception $ex) {
                    $conex->rollback();
                    echo "ERROR, no se ha podido realizar el traspaso de stock. Inténtelo más tarde.";
                }
                
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
            <p>Código Producto: <input type="text" name="codigo"></p>
            <p>Unidades: <input type="number" name="unidades"></p>
            <input type="submit" name="actualizar" value="Actualizar">
        </form>
    </body>
</html>
