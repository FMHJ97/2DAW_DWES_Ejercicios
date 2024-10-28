<?php

/**
 * Función que devuelve una conexión mysqli a una BD.
 * @param string $database Nombre BD.
 * @return mysqli Conexión BD.
 */
function getConnection($database) {
    try {
        $conex = new mysqli("localhost","dwes","abc123.",$database);
        $conex->set_charset("utf8mb4");
        return $conex;
    } catch (Exception $ex) {
        die("ERROR. NO SE HA PODIDO CONECTAR A LA BD.");
    }
}

/**
 * Redirige al usuario al index.php si falta
 * el parámetro 'id' en la URL.
 */
function redirectIfIdMissing() {
    if (!isset($_REQUEST['id'])) {
        header("Location: index.php");
        exit();
    }
}

/**
 * Función que genera una tabla con los datos
 * de la tabla jugador en la BD futbol.
 * @param mysqli_result $result
 */
function showDataJugadorTable($result) {
    echo "<table><tr>";
    echo "<th>DNI</th><th>Nombre</th><th>Dorsal</th><th>Posición</th><th>Equipo</th><th>Goles</th></tr>";
    // Para ello, extraemos cada fila como un objeto.
    while ($row = $result->fetch_object()) {
        echo "<tr><td>".$row->DNI."</td><td>".$row->Nombre."</td><td>".$row->Dorsal."</td><td>"
                .$row->Posicion."</td><td>".$row->Equipo."</td><td>".$row->Goles."</td></tr>";
    }
    echo "</table>";
}

/**
 * 
 * @param type $dni
 * @return type
 */
function isDniValid($dni) {
    return preg_match("/^\d{8}[a-zA-Z]$/", $dni);
}

?>