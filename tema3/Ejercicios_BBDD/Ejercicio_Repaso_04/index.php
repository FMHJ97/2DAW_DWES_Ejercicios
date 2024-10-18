<html>
    <head>
        <title>Ejercicio 04 - BD(empleados)</title>
    </head>
    <body>
        
        <?php
            if (isset($_POST["insertar"])) {
                // Obtenemos los valores introducidos.
                $dni=$_POST["dni"]; $nombre=$_POST["nombre"]; $apellidos=$_POST["apellidos"];
                $salario=$_POST["salario"]; $idiomas=$_POST["idiomas"];
                
                // Establecemos la conexión.
                try {
                    $conex = new mysqli("localhost","dwes","abc123.","empleados");
                    $conex->set_charset("utf8mb4");
                    $conex->autocommit(false);
                }
                catch (Exception $ex) {
                    die("ERROR. NO SE HA PODIDO ESTABLECER CONEXIÓN CON LA BD!");
                }
                
                // Realizamos las consultas.
                try {
                    // Insertamos los datos correspondientes en la tabla marketing.
                    $conex->query(
                            "INSERT INTO marketing VALUES ('$dni','$nombre','$apellidos',$salario)");
                    // Insertamos los datos correspondientes en la tabla idiomas.
                    // Dado que es posible tener que insertar varios registros,
                    // haremos uso de una consulta preparada.
                    $stmt=$conex->prepare(
                            "INSERT INTO idiomas VALUES (?,?)");
                    // Recorremos los valores del array Idiomas.
                    foreach ($idiomas as $value) {
                        $stmt->bind_param("ss", $dni,$value);
                        $stmt->execute();
                    }
                }
                catch (Exception $ex) {
                    
                }
                
            }
        ?>
        
        <h1>Insertar Registro en BD empleados</h1>
        <form action="" method="POST">
            <p>DNI: <input type="text" name="dni"></p>
            <p>Nombre: <input type="text" name="nombre"></p>
            <p>Apellidos: <input type="text" name="apellidos"></p>
            <p>Salario: <input type="number" name="salario"></p>
            <p>Idiomas: 
                <input type="checkbox" name="idiomas[]" value="Inglés"><label>Inglés</label>
                <input type="checkbox" name="idiomas[]" value="Francés"><label>Francés</label>
                <input type="checkbox" name="idiomas[]" value="Alemán"><label>Alemán</label>
                <input type="checkbox" name="idiomas[]" value="Chino"><label>Chino</label>
            </p>
            <input type="submit" name="insertar" value="Insertar">
        </form>
        
    </body>
</html>
