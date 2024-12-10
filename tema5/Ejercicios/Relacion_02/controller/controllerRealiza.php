<?php

require_once 'conexion.php';
require_once '../model/realiza.php';

class ControllerRealiza {
    
    /**
     * 
     * @param type $id
     * @return bool
     */
    public static function findById($id_empleado,$id_tarea): mixed {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM realiza WHERE email = '$id_empleado' && id_tarea = '$id_tarea'");
            if ($result->num_rows) {
                $fila = $result->fetch_object();
                $realiza = new Realiza($fila->email, $fila->id_tarea, $fila->horas);
            } else {
                $realiza = false;
            }
            $conex->close();
            return $realiza;
        } catch (Exception $ex) {
            die("ERROR en la BD! => ".$ex->getMessage());
        }
    }
    
    /**
     * 
     * @return mixed
     */
    public static function getAll(): mixed {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM realiza");
            if ($result->num_rows) {
                while($fila = $result->fetch_object()) {
                    $rea = new Realiza($fila->email, $fila->id_tarea, $fila->horas);
                    // Guardamos en array.
                    $realiza[] = $rea;
                }
            } else {
                $realiza = false;
            }
            // Cerramos la conexión.
            $conex->close();
            // Devolvemos el resultado.
            return $realiza;
        } catch (Exception $ex) {
            die("ERROR en la BD! => ".$ex->getMessage());
        }
    }
}

?>