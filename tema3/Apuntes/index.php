<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            if (isset($_POST['insertar'])) {
                // $driver = new mysqli_driver();
                // $driver -> report_mode = MYSQLI_REPORT_ERROR;

                // Creamos una conexión.
                // $conex = new mysqli("localhost","dwes","abc123.","empleados");

                // Alternativa.
                // $conex = new mysqli("localhost","dwes","abc123.");
                // $conex -> select_db("empleados");

                // Usando esta última, mantenemos las conexiones de las BBDD abiertas.
                // Es decir, con select_db podemos acceder a varias BBDD con una misma conexión.

                // Devuelve la versión de MySQL Server.
                //echo $conex -> server_info;

                // Muestra errores producidos en la BBDD.
                // echo $conex -> connect_errno." - ".$conex -> connect_error;

                // Para OCULTAR errores, usaremos error_reporting(). 
                // error_reporting(0);            
                // Esto dará un error (no existe BBDD).
                // $conex2 = new mysqli("localhost","dwes","abc123.","empleados2");

                // Para atrapar errores.
                try {
                    $conex = new mysqli("localhost","dwes","abc123.","empleados");
                    // Recomendable.
                    // Establecemos la codificación de caracteres.
                    $conex->set_charset("utf8mb4");
                    
                    // Desactivamos el autocommit.
                    $conex->autocommit(false);
                } catch (Exception $ex) {
                    // Muestra el mensaje de error por pantalla.
                    // die($ex -> getMessage());
                    // Mensaje de error personalizado.
                    if ($ex ->getCode() == 1045) die("Error en las credenciales de acceso");
                    if ($ex ->getCode() == 1049) die("Error en el nombre de BD");
                }

                // Con die(), matamos la ejecución.

                // El método query() lo utilizaremos para realizar consultas.
                // Podemos realizar 2 tipos de operaciones:
                // 1.- Instrucciones que no devuelven datos.
                // 2.- Intrucciones que devuelven resultados.
                //      (se almacenan en el objeto mysqli_result)

                // Primer Tipo
                try {
                    // Devuelve true o false.
                    if ($conex->query("INSERT INTO marketing (DNI,Nombre,Apellidos,Salario) "
                            . "VALUES ('$_POST[dni]','$_POST[nombre]','$_POST[apellidos]',$_POST[salario])")) {
                        echo "Registro insertado correctamente!"." - ".$conex->affected_rows." filas afectadas<br>";
                    }
                    // Actualizamos su valor. Debemos eliminar el registro previo.
                    $conex->query("UPDATE marketing SET Salario=30000 WHERE DNI='11111111A'");
                    echo "Registro actualizado!"." - ".$conex->affected_rows." filas afectadas<br>";
                    // Eliminamos registros.
                    $conex->query("DELETE FROM marketing WHERE Salario > 20000");
                    echo "Registro eliminado!"." - ".$conex->affected_rows." filas afectadas";
                    // Realizamos el commit (dado que hemos desactivado el autocommit).
                    $conex->commit();
                } catch (Exception $ex) {
                    // Error personalizado para claves primarias duplicadas.
                    if ($ex->getCode() == 1062) echo "El DNI del empleado ya existe!<br>";
                    // echo $ex->getCode()." - ".$ex->getMessage();
                    // En caso de encontar un fallo, procedemos a revertir las operaciones realizadas.
                    $conex->rollback();
                    echo "ERROR";
                }
                
                // Antes de cerrar la conexión, volvemos a activar el autocommit.
                $conex->autocommit(true);
                // Para cerrar la conexión con la BD. Por defecto, se cierra al acabar el script.
                $conex->close();
            }
        ?>

        <form action="" method="POST">
            <p>DNI: <input type="text" name="dni"></p>
            <p>Nombre: <input type="text" name="nombre"></p>
            <p>Apellidos: <input type="text" name="apellidos"></p>
            <p>Salario: <input type="number" name="salario"></p>
            <input type="submit" name="insertar" value="Insertar">
        </form>

    </body>
</html>
