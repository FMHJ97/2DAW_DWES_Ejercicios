<?php

require_once '../controller/conexion.php';
require_once '../model/agencia.php';

class ControllerAgencia {

    /**
     * 
     * @param type $id
     * @return bool
     */
    public static function findById($id) {
        try {

            $conex = new Conexion();
            // Realizamos la consulta para un cliente.
            $result = $conex->prepare("SELECT * FROM agencia WHERE usuario = ?");
            $result->bindParam(1, $id);
            $result->execute();
            if ($result->rowCount()) {
                $fila = $result->fetchObject();
                // Inicializamos un objeto Agencia con los datos de cada fila de la BD.
                $agencia = new Agencia($fila->nombre, $fila->telf, $fila->usuario, $fila->pass);
            } else {
                $agencia = false;
            }
            return $agencia;
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
            // Realizamos la consulta para obtener las agencias.
            $result = $conex->query("SELECT * FROM agencia");
            if ($result->num_rows) {
                while ($fila = $result->fetchObject()) {
                    // Inicializamos un objeto Agencia con los datos de cada fila de la BD.
                    $agencia = new Agencia($fila->nombre, $fila->telf, $fila->usuario, $fila->pass);
                    // Guardamos en array.
                    $agencias[] = $agencia;
                }
            } else {
                $agencias = false;
            }
            return $agencia;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}

?>