<?php

require_once '../controller/conexion.php';
require_once '../model/tren.php';

class ControllerTren {

    /**
     * 
     * @param type $id
     * @return bool
     */
    public static function findById($recorrido, $hora) {
        try {

            $conex = new Conexion();
            // Realizamos la consulta para un tren.
            $result = $conex->prepare("SELECT * FROM tren WHERE recorrido = ? AND hora = ?");
            $result->bindparam(1, $recorrido);
            $result->bindparam(2, $hora);
            $result->execute();
            if ($result->rowCount()) {
                $fila = $result->fetchObject();
                // Inicializamos un objeto Tren con los datos de cada fila de la BD.
                $tren = new Tren($fila->recorrido, $fila->hora, $fila->precio_tourist);
            } else {
                $tren = false;
            }
            return $tren;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    
    /**
     * 
     * @return mixed
     */
    public static function getAllHoras(): mixed {
        try {

            $conex = new Conexion();
            // Realizamos la consulta para obtener los recorridos.
            $result = $conex->query("SELECT hora FROM tren GROUP BY hora");
            if ($result->rowCount()) {
                while ($fila = $result->fetchObject()) {
                    // Guardamos en array.
                    $horas[] = $fila->hora;
                }
            } else {
                $horas = false;
            }
            return $horas;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    
    /**
     * 
     * @return mixed
     */
    public static function getAllRecorridos(): mixed {
        try {

            $conex = new Conexion();
            // Realizamos la consulta para obtener los recorridos.
            $result = $conex->query("SELECT recorrido FROM tren GROUP BY recorrido");
            if ($result->rowCount()) {
                while ($fila = $result->fetchObject()) {
                    // Guardamos en array.
                    $recorridos[] = $fila->recorrido;
                }
            } else {
                $recorridos = false;
            }
            return $recorridos;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    /**
     * 
     * @return mixed
     */
    public static function getAll(): mixed {
        try {

            $conex = new Conexion();
            // Realizamos la consulta para obtener los trenes.
            $result = $conex->query("SELECT * FROM tren");
            if ($result->rowCount()) {
                while ($fila = $result->fetchObject()) {
                    // Inicializamos un objeto Tren con los datos de cada fila de la BD.
                    $tren = new Tren($fila->recorrido, $fila->hora, $fila->precio_tourist);
                    // Guardamos en array.
                    $trenes[] = $tren;
                }
            } else {
                $trenes = false;
            }
            return $trenes;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}

?>