<?php

//    try {
//        $conex = new mysqli("localhost","dwes","abc123.","dwes");
//        $conex->set_charset("utf8mb4");
//        
//        // Mandamos al Servidor de BBDD que se analice esta instrucción.
//        $stmt = $conex->prepare("INSERT INTO tienda VALUES (4,'Sucursal3','159753842')");
//        
//        // Ordenamos ejecutar la instrucción.
//        if ($stmt->execute()) echo "Registro insertado<br>";
//        
//        // A continuación, realizamos una preparación con parámetros.
//        $stmt2 = $conex->prepare("INSERT INTO tienda VALUES (?,?,?)");
//        
//        // Parámetros a asignar.
//        $cod=5; $nombre="Sucursal5"; $telef="123654789";
//        
//        // En el tipo de los parámetros, debemos asignarles las siguientes opciones:
//        // - i = Número Entero
//        // - d = Número Real
//        // - s = Cadena de Texto
//        // - b = Contenido en formato binario(BLOB)
//        $stmt2->bind_param("iss", $cod,$nombre,$telef);
//        
//        // Ordenamos ejecutar la instrucción.
//        if ($stmt2->execute()) echo "Registro insertado<br>";
//        
//    } catch (Exception $ex) {
//        die($ex->getMessage());
//    }

    // CONSULTAS PREPARADAS QUE DEVUELVEN RESULTADOS

    try {
        $conex = new mysqli("localhost","dwes","abc123.","dwes");
        $conex->set_charset("utf8mb4");
        
        $stmt = $conex->prepare("SELECT * FROM tienda WHERE cod > ?");
        $cod=2;
        
        $stmt->bind_param("i", $cod);
        
        $stmt->execute();
        
        // Primera opción para trabajar con consultas que devuelve resutados.
        
        // Los valores que se obtienen, se guardan en las variables asignadas.
        $stmt->bind_result($codigo, $tienda, $telefono);
        
        while ($stmt->fetch()) {
            echo "Código: ".$codigo."<br>";
            echo "Tienda: ".$tienda."<br>";
            echo "Telefono: ".$telefono."<br>";
            echo "<br>";
        }
        
        echo "======================<br>";
        
        $stmt->execute();
        
        // Segunda opción para trabajar con consultas que devuelve resutados.        
        
        $result = $stmt->get_result();
        
        while ($fila = $result->fetch_object()) {
            echo "Código: ".$fila->cod."<br>";
            echo "Tienda: ".$fila->nombre."<br>";
            echo "Telefono: ".$fila->tlf."<br>";
            echo "<br>";            
        }
        
    } catch (Exception $ex) {
        die($ex->getMessage());
    }

?>