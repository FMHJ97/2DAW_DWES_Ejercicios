<?php

require_once 'conexion.php';
require_once '../model/alquiler.php';

class ControllerAlquiler {
    
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