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

?>