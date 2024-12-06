<?php

require_once 'conexion.php';
require_once '../model/juego.php';

class ControllerJuego {

    /**
     * 
     * @param type $id
     * @return bool
     */
    public static function getJuegoById($id) {
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("SELECT * FROM juegos WHERE Codigo = ?");
            $stmt->bind_param('s', $id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $fila = $result->fetch_object();
                $juego = new Juego($fila->Codigo, $fila->Nombre_juego, $fila->Nombre_consola, $fila->Anno, $fila->Precio, $fila->Alguilado, $fila->Imagen, $fila->descripcion);
            } else {
                $juego = false;
            }
            $stmt->close();
            $conex->close();
            return $juego;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }

    /**
     * 
     * @return mixed
     */
    public static function getAll(): mixed {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM juegos");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $juego = new Juego($fila->Codigo, $fila->Nombre_juego, $fila->Nombre_consola, $fila->Anno, $fila->Precio, $fila->Alguilado, $fila->Imagen, $fila->descripcion);
                    $juegos[] = $juego;
                }
            } else {
                $juegos = false;
            }
            $conex->close();
            return $juegos;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }
}

?>