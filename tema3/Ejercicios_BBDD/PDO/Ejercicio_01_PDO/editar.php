<html>
    <head>
        <title>Ejercicio 01 PDO - Editar</title>
    </head>
    <style>
        h1 {
            background-color: #ddf0a4;
        }
        #producto {
            background: #EEEEEE;
            padding-bottom: 1em;
        }
        .boton {
            background-color: lightgreen;
        }
    </style>
    <body>
        <?php
        // Redirigimos al listado en caso de entrada directa.
        if (!isset($_POST['editar']) && !isset($_POST['actualizar'])) {
            header("Location: listado.php");
            exit();
        }
        
        // Conexión PDO a la BD.
        try {
            $conex = new PDO('mysql:host=localhost;dbname=dwes;charset=utf8mb4','dwes','abc123.');
            // Obtenemos el producto elegido previamente.
            $result = $conex->prepare("SELECT * FROM producto WHERE cod = ?");
            $result->bindParam(1, $_POST['codProducto']);
            $result->execute();
            // Sacamos el registro como objeto.
            if ($result->rowCount()) $registro = $result->fetchObject();
        } catch (PDOException $ex) {
            echo ($ex->getMessage());
        }
        ?>
        <h1>Tarea: Edición de un producto</h1>
        <div id="producto">
            <h2>Producto:</h2>
            <form action="" method="POST">
                <!-- Código producto -->
                <p>Código: <input readonly="" type="text" name="cod" value="<?php echo isset($registro)? $registro->cod:''; ?>"></p>
                <!-- Nombre Corto -->
                <p>Nombre corto: <input type="text" name="nombre_corto" value="<?php echo isset($registro)? $registro->nombre_corto:''; ?>"></p>
                <!-- Nombre -->
                <p>Nombre:</p>
                <textarea name="nombre" rows="2" cols="50"><?php echo isset($registro)? $registro->nombre:''; ?></textarea>
                <!-- Descripción -->
                <p>Descripción:</p>
                <textarea name="descripcion" rows="10" cols="50"><?php echo isset($registro)? $registro->descripcion:''; ?></textarea>            
                <!-- PVP -->
                <p>PVP: <input type="text" name="pvp" value="<?php echo isset($registro)? $registro->PVP:''; ?>"></p>                
                <!-- Actualizar -->
                <input class="boton" type="submit" name="actualizar" value="Actualizar">
                <!-- Cancelar -->                
                <a href="listado.php"><input class="boton" type="button" value="Cancelar"></a>
            </form>
        </div>
        
        <?php
        // Procedemos a realizar la modificación del registro.
        if (isset($_POST['actualizar'])) {
            try {
                // Iniciamos una transacción antes de realizar la actualización.
                $conex->beginTransaction();
                // Realizamos la consulta.
                $result = $conex->prepare("UPDATE producto SET nombre=?, nombre_corto=?, descripcion=?, PVP=? WHERE cod=?");
                $result->execute(array($_POST['nombre'],$_POST['nombre_corto'],$_POST['descripcion'],$_POST['pvp'],$_POST['cod']));
                if ($result->rowCount()) {
                    // Confirmamos los cambios.
                    $conex->commit();
                    // Volvemos a listado.
                    header("Location: listado.php?msg");
                    exit();
                } else {
                    echo "NO SE HA PODIDO ACTUALIZAR EL PRODUCTO!";
                }
            } catch (PDOException $ex) {
                $conex->rollBack();
                die ($ex->getMessage());
            }
        }
        ?>
    </body>
</html>
