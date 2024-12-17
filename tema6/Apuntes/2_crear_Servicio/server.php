<?php

// Este fichero será el Servicio.
// Vamos a utilizar la BD trenes.sql
// Vamos a devolver los datos de la tabla tren.
// Si no indicamos nada, devolverá TODO.
// Si establecemos un dato (precio, por ejemplo), devolveremos los datos correspondientes.

try {
    // Establecemos conexión.
    $conex = new PDO("mysql:host=localhost;dbname=trenes;charset=utf8mb4", "dwes", "abc123.");

    // Realizamos la consulta correspondiente.
    if (isset($_GET['precio'])) {
        $result = $conex->query("SELECT * FROM tren WHERE precio_tourist >= $_GET[precio]");

        // Si introducimos en la URL el dato hora.
        if (isset($_GET['hora'])) {
            $result = $conex->query("SELECT * FROM tren WHERE precio_tourist >= $_GET[precio] AND hora = '$_GET[hora]'");
        }
    } else {
        $result = $conex->query("SELECT * FROM tren");
    }

    // Guardamos los resultados.
    $i = 0;
    while ($row = $result->fetchObject()) {
        $datos[$i]['recorrido'] = $row->recorrido;
        $datos[$i]['hora'] = $row->hora;
        $datos[$i]['precio'] = $row->precio_tourist;
        $i++;
    }

    // Debemos codificar la siguiente información en formato JSON para su envío.
    echo json_encode($datos);

    // Al igual que hemos hecho en la API del tiempo, modificando la URL
    // (http://localhost/2DAW_DWES_Ejercicios/tema6/2_crear_Servicio/server.php)
    // podemos filtrar diferentes resultados o información (?precio=28, por ejemplo).
} catch (PDOException $ex) {
    die($ex->getMessage());
}
?>