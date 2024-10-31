<?php

/**
 * 
 * @param type $database
 * @return type
 */
function getConnectionPDO($database) {
    try {
        $conex = new PDO('mysql:host=localhost;dbname='.$database.';charset=utf8mb4;','dwes','abc123.');
        return $conex;
    } catch (PDOException $ex) {
        die ("ERROR. NO SE HA PODIDO ACCEDER A LA BD!");
    }
}

/**
 * 
 */
function redirectMenu() {
    if (!isset($_REQUEST['index'])) {
        header("Location: index.html");
        exit();
    }
}

/**
 * 
 * @param type $matricula
 * @return type
 */
function isMatriculaValid($matricula) {
    return preg_match('/^[0-9]{3}[A-Z]{3}$/', $matricula);
}

?>