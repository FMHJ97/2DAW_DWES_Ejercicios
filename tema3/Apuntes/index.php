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
            // Creamos una conexión.
            $conex = new mysqli("localhost","dwes","abc123.","empleados");
            
            // Alternativa.
            // $conex = new mysqli("localhost","dwes","abc123.");
            // $conex -> select_db("empleados");
            
            // Usando esta última, mantenemos las conexiones de las BBDD abiertas.
            // Es decir, con select_db podemos acceder a varias BBDD con una misma conexión.
            
            // Devuelve la versión de MySQL Server.
            echo $conex -> server_info;
            
            // Muestra errores producidos en la BBDD.
            echo $conex -> connect_errno." - ".$conex -> connect_error;
            
            // Para OCULTAR errores, usaremos error_reporting(). 
            error_reporting(0);            
            // Esto dará un error (no existe BBDD).
            $conex2 = new mysqli("localhost","dwes","abc123.","empleados2");
            

        ?>
    </body>
</html>
