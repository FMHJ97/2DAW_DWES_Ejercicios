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
 * Comprueba si el parámetro contiene 3 números seguidos por
 * 3 letras mayúsculas.
 * @param type $matricula
 * @return type
 */
function isMatriculaValid($matricula) {
    return preg_match('/^[0-9]{3}[A-Z]{3}$/', $matricula);
}

/**
 * Comprueba si el parámetro introducido está compuesto por letras
 * y posibles espacios en blanco entre ellas.
 * @param type $marca
 * @return type
 */
function isTextValid($text) {
    return preg_match('/^[a-zA-Z]+\s?[a-zA-Z]+?$/', $text);
}

/**
 * Comprueba si el parámetro es un número positivo.
 * @param type $plazas
 * @return type
 */
function isNumValid($num) {
    return preg_match('/^\d+$/', $num);
}

/**
 * Comprueba si el parámetro tiene un formato Date y
 * es una fecha válida.
 * @param type $fecha
 * @return type
 */
function isFechaValid($fecha) {
    $arrayFecha = explode('-', $fecha);
    return preg_match('/^\d{4}[-]\d{2}-\d{2}$/', $fecha)
            && checkdate($arrayFecha[1], $arrayFecha[2], $arrayFecha[0]);
}

/**
 * Comprueba si plazasLibres es un número positivo y
 * su valor es menor o igual a las plazas de un autobús específico.
 * @param type $plazasLibres
 * @param type $plazasAutobus
 * @return type
 */
function isPlazasLibresValid($plazasLibres,$plazasAutobus) {
    return isNumValid($plazasLibres) && ($plazasAutobus >= $plazasLibres);
}

?>