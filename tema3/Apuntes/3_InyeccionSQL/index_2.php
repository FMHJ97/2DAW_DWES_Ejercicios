<html>
    <head>
        <title>Inyección SQL - 2</title>
    </head>
    <body>

        <form action="" method="POST">
            <p>Usuario: <input type="text" name="user"></p>
            <p>Contraseña: <input type="text" name="pwd"></p>
            <input type="submit" name="send" value="Enviar">
        </form>
        
        <?php
            if (isset($_POST['send'])) {
                try {
                    $conex = new mysqli("localhost","dwes","abc123.","empleados");
                    $conex->set_charset("utf8mb4");
                    
                    // Vamos a prevenir la Inyección SQL.
                    $stmt = $conex->prepare(
                            "SELECT * FROM marketing WHERE "
                            . "Usuario=? AND Password=?");
                    
                    $stmt->bind_param('ss', $_POST['user'], $_POST['pwd']);
                    
                    // Comprobamos si devuelve resultados.
                    if ($stmt->execute()) {
                        $result = $stmt->get_result();
                        if ($result->num_rows) {
                            echo "Credenciales Correctas!<br>";
                            $fila = $result->fetch_object();
                            echo "Hola, ".$fila->Nombre." ".$fila->Apellidos;
                        } else {
                            echo "Credenciales Incorrectas!";
                        }
                    }
                    
                } catch (Exception $ex) {
                    die($ex->getMessage());
                }
            }
        ?>
        
    </body>
</html>
