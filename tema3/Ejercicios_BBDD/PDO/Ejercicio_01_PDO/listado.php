<html>
    <head>
        <title>Ejercicio 01 PDO - Listado</title>
    </head>
    <style>
        #familia {
            background-color: #ddf0a4;
        }
        #productos {
            background: #EEEEEE;
            padding-bottom: 1em;
        }
        table, th, td {
            border-collapse: collapse;
            border: 1px solid black;
        }
        th, td {
            padding: 0.5em;
            text-align: center;
        }
        th {
            background-color: lightblue;
        }
        td {
            background-color: white;
        }
        table input {
            background-color: lightcyan;
        }
    </style>
    <body>
        <?php
        try {
            // Conexión con PDO a la BD.
            $conex = new PDO('mysql:host=localhost;dbname=dwes;charset=utf8mb4;','dwes','abc123.');
        } catch (PDOException $ex) {
            die ($ex->getMessage());
        }
        ?>
        <!--Formulario Mostrar Familia-->
        <div id="familia">
            <h1>Tarea: Listado de productos de una familia</h1>
            <form action="" method="POST">
                <p>Familia: 
                    <select name="familia">
                        <?php
                        try {
                            // Realizamos la consulta para obtener las familias.
                            $result = $conex->query("SELECT * FROM familia");
                            // Sacamos los posibles resultados como objetos.
                            if ($result->rowCount()) {
                                while ($fila = $result->fetchObject()) {
                                    echo "<option value='$fila->cod' ";
                                    if (isset($_POST['show']) && $_POST['familia'] == $fila->cod) echo "selected";
                                    echo ">$fila->nombre</option>";
                                }
                            }
                        } catch (PDOException $ex) {
                            die($ex->getMessage());
                        }
                        ?>
                    </select>
                    <input type="submit" name="show" value="Mostrar productos">
                </p>
            </form>
            <?php
            // Si hemos actualizado un producto.
            if (isset($_REQUEST['msg']) && !isset($_POST['show'])) {
                echo "<p><span style='color:green;font-weight:bold;'>PRODUCTO ACTUALIZADO CORRECTAMENTE!</span></p>";
            }
            ?>
        </div>
        <!--Formulario Productos según Familia-->
        <?php
        if (isset($_POST['show'])) {
            echo "<div id='productos'>";
            echo "<h2>Productos de la familia:</h2>";
            try {
                // Consulta que obtiene los posibles productos de una familia seleccionada.
                $result = $conex->prepare("SELECT * FROM producto WHERE familia = ?");
                $result->bindParam(1, $_POST['familia']);
                $result->execute();
                // Sacamos los posibles resultados como objetos.
                if ($result->rowCount()) {
                    echo "<table><tr><th>Producto</th><th>Precio(PVP)</th><th></th></tr>";
                    while ($fila = $result->fetchObject()) {
                        echo "<tr><td>".$fila->nombre_corto."</td><td>".$fila->PVP."€</td>";
                        echo "<td><form action='editar.php' method='POST'>";
                        echo "<input type='submit' name='editar' value='Editar'>";
                        echo "<input type='hidden' name='codProducto' value='$fila->cod'>";
                        echo "</form></td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>NO EXISTEN PRODUCTOS CON ESA FAMILIA!</p>";
                }
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
            echo "</div>";
        }
        ?>
    </body>
</html>
