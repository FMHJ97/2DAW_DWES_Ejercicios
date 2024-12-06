<?php

require_once 'conexion.php';
require_once '../model/alquiler.php';

class ControllerAlquiler {

    /**
     * Devuelve un registro Alquiler según el código de un juego.
     * El juego debe seguir alquilado, es decir, fecha devolución es null.
     * @param type $cod_juego
     * @return bool
     */
    public static function getAlquilerByJuegoAlquilado($cod_juego) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM alquiler WHERE Cod_juego = '$cod_juego' AND Fecha_devol IS NULL");
            if ($result->num_rows) {
                $fila = $result->fetch_object();
                $alquiler = new Alquiler($fila->id, $fila->Cod_juego, $fila->DNI_cliente, $fila->Fecha_alquiler, $fila->Fecha_devol, $fila->Precio);
            } else {
                $alquiler = false;
            }
            $conex->close();
            return $alquiler;
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
            $result = $conex->query("SELECT * FROM alquiler");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $a = new Alquiler($fila->id, $fila->Cod_juego, $fila->DNI_cliente, $fila->Fecha_alquiler, $fila->Fecha_devol, $fila->Precio);
                    $alquiler[] = $a;
                }
            } else {
                $alquiler = false;
            }
            $conex->close();
            return $alquiler;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }
}

?>