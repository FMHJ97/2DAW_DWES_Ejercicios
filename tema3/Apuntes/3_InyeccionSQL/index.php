<html>
    <head>
        <title>Inyección SQL</title>
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
                    // Realizamos consulta.
                    // Si agregamos BINARY a la consulta, diferencia entre Mayúsculas y Minúsculas.
                    $result = $conex->query(
                            "SELECT * FROM marketing WHERE "
                            . "Usuario=BINARY '$_POST[user]' AND Password=BINARY '$_POST[pwd]'");
                    // Comprobamos si devuelve resultados.
                    if ($result->num_rows) {
                        echo "Credenciales Correctas!<br>";
                        $fila = $result->fetch_object();
                        echo "Hola, ".$fila->Nombre." ".$fila->Apellidos;
                    } else {
                        echo "Credenciales Incorrectas!";
                    }
                    
                } catch (Exception $ex) {
                    die($ex->getMessage());
                }
            }
        ?>
        
    </body>
</html>
