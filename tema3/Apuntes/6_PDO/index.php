<?php

try {
    // Array con las opciones deseadas que se agregará a la creación de la conexión PDO.
    /*
    $opciones=array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
        PDO::ATTR_CASE => PDO::CASE_LOWER, // Fuerza el uso de minúsculas.
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::[modo]); // Indicamos cómo sacar las filas obtenidas.
    */
     
    // Conexión mediante PDO.
    $conex = new PDO('mysql:host=localhost;dbname=dwes;charset=utf8mb4','dwes','abc123.');
    
    // Comenzamos una transacción. Al hacerlo, autocommit está desactivado.
    // Si realizamos un commit o rollback, autocommit vuelve a activarse.
    $conex->beginTransaction();
    
    // Consulta que devuelve el número de filas afectadas.
    // Devuelve n filas, 0 filas o false(no se ha realizado la consulta).
    $reg = $conex->exec("UPDATE stock SET unidades=100 WHERE producto='3DSNG'");
    
    // Confirmamos los cambios.
    $conex->commit();
    
    if ($reg) {
        echo "Registro actualizado.";
    } elseif ($reg === 0) {
        echo "No se ha realizado la actualización porque no se encuentra el producto.";
    } else {
        echo "ERROR al realizar la actualización.";
    }
    
} catch (PDOException $ex) {
    // Revertimos los cambios.
    $conex->rollBack();
    echo $ex->getMessage();
}

// EJEMPLO CONSULTA
try {
    // Devuelve un PDOstatement.
    $result = $conex->query("SELECT * FROM producto");
    echo "<br><b>Número de registros devueltos:</b> ".$result->rowCount()."<br><br>";
    // Recorremos los posibles resultados devueltos.
//    while ($fila = $result->fetch()) {
//        echo "Nombre: ".$fila['nombre_corto']."<br>";
//    }

    // Recorremos los posibles resultados devueltos.
    // Indicamos el modo de Fetch. En este caso, devolverá objetos.
//    while ($fila = $result->fetch(PDO::FETCH_OBJ)) {
//        echo "Nombre: ".$fila->nombre_corto."<br>";
//    }
    
    // Otra alternativa es utilizar fetchObject().
    // Método directo (no especificamos el modo).
    while ($fila = $result->fetchObject()) {
        echo "Nombre: ".$fila->nombre_corto."<br>";
    }
    echo "<br>";
    
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

// PDO no tiene una función para cerrar la conexión como en mysqli.
// Para cerrarla, usaremos unset(). Aunque por defecto, se cerrará al terminar
// el script.

// EJEMPLO CONSULTAS PREPARADAS
$menor = 100;
$mayor = 200;

try {
//    $result = $conex->prepare("SELECT * FROM producto WHERE PVP>? AND PVP<?");
//    $result->bindParam(1, $menor);
//    $result->bindParam(2, $mayor);
//    $result->execute();
//    echo "Filas devueltas: ".$result->rowCount()."<br>";
//    // Para mostrar los productos.
//    while ($fila = $result->fetchObject()) {
//        echo "Nombre: ".$fila->nombre_corto."<br>";
//    }
    
    // Otra forma de realizar consultas preparadas.
    // Reemplazamos las interrogaciones por nombres (atributos). Deben comenzar por :
    $result = $conex->prepare("SELECT * FROM producto WHERE PVP>:pvp1 AND PVP<:pvp2");
//    $result->bindParam(":pvp1", $menor);
//    $result->bindParam(":pvp2", $mayor);
//    $result->execute();
//    echo "Filas devueltas: ".$result->rowCount()."<br>";
//    // Para mostrar los productos.
//    while ($fila = $result->fetchObject()) {
//        echo "Nombre: ".$fila->nombre_corto."<br>";
//    }
    
    // Podemos ahorrarnos utilizar el método bind_param() para asignar
    // los parámetros. Para ello, en execute() pasamos un array con los parámetros y su index.
    $result->execute(array(":pvp1"=>$menor,":pvp2"=>$mayor));
    echo "Filas devueltas: ".$result->rowCount()."<br>";
    // Para mostrar los productos.
    while ($fila = $result->fetchObject()) {
        echo "Nombre: ".$fila->nombre_corto."<br>";
    }    
    
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

?>