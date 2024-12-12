<?php

require_once '../controller/conexion.php';
require_once '../model/billete.php';

class ControllerBillete {
    
    /**
     * 
     * @param type $dni
     * @param type $recorrido
     * @param type $hora
     * @param type $agencia
     * @param type $fecha
     * @return bool
     */
    public static function delete($dni,$recorrido,$hora,$agencia,$fecha) {
        try {

            $conex = new Conexion();
            // Realizamos la consulta para un billete.
            $result = $conex->prepare("DELETE FROM billete WHERE dni = ? AND recorrido = ? AND hora = ? AND agencia = ? AND fecha = ?");
            $result->bindParam(1, $dni);
            $result->bindParam(2, $recorrido);
            $result->bindParam(3, $hora);
            $result->bindParam(4, $agencia);
            $result->bindParam(5, $fecha);
            $result->execute();
            
            if ($result->rowCount()) {
                $filas = true;
            } else {
                $filas = false;
            }
            return $filas;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    /**
     * 
     * @param type $id
     * @return bool
     */
    public static function findById($datos) {
        try {

            $conex = new Conexion();
            // Realizamos la consulta para un billete.
            $result = $conex->prepare("SELECT * FROM billete WHERE dni = ? AND recorrido = ? AND hora = ? AND agencia = ? AND fecha = ?");
            $result->bindParam(1, $datos['dni']);
            $result->bindParam(2, $datos['recorrido']);
            $result->bindParam(3, $datos['hora']);
            $result->bindParam(4, $datos['agencia']);
            $result->bindParam(5, $datos['fecha']);
            $result->execute();
            if ($result->rowCount()) {
                $fila = $result->fetchObject();
                // Inicializamos un objeto Billete con los datos de cada fila de la BD.
                $billete = new Billete($fila->dni, $fila->recorrido, $fila->hora, $fila->agencia, $fila->fecha, $fila->tipo, $fila->precio, $fila->img_tarjeta);
            } else {
                $billete = false;
            }
            return $billete;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    
    public static function getAll(): mixed {
        try {

            $conex = new Conexion();
            // Realizamos la consulta para obtener los billetes.
            $result = $conex->query("SELECT * FROM billete");
            if ($result->rowCount()) {
                while ($fila = $result->fetchObject()) {
                    // Inicializamos un objeto Billete con los datos de cada fila de la BD.
                    $billete = new Billete($fila->dni, $fila->recorrido, $fila->hora, $fila->agencia, $fila->fecha, $fila->tipo, $fila->precio, $fila->img_tarjeta);
                    // Guardamos en array.
                    $billetes[] = $billete;
                }
            } else {
                $billetes = false;
            }
            return $billetes;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    
    /**
     * 
     * @param type $dni_cliente
     * @param type $agencia
     * @return mixed
     */
    public static function getBilletesActualesByCliente($dni_cliente, $agencia): mixed {
        try {
            // Fecha actual.
            $fecha_actual = date("Y-m-d");
            
            $conex = new Conexion();
            // Realizamos la consulta para obtener los billetes.
            $result = $conex->query("SELECT * FROM billete WHERE dni = '$dni_cliente' AND fecha >= '$fecha_actual' AND agencia = '$agencia'");
            if ($result->rowCount()) {
                while ($fila = $result->fetchObject()) {
                    // Inicializamos un objeto Billete con los datos de cada fila de la BD.
                    $billete = new Billete($fila->dni, $fila->recorrido, $fila->hora, $fila->agencia, $fila->fecha, $fila->tipo, $fila->precio, $fila->img_tarjeta);
                    // Guardamos en array.
                    $billetes[] = $billete;
                }
            } else {
                $billetes = false;
            }
            return $billetes;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    /**
     * 
     * @param type $recorrido
     * @param type $fecha
     * @param type $hora
     * @return mixed
     */
    public static function getBilletesByRecorridoFechaHora($recorrido,$fecha,$hora): mixed {
        try {
            
            $conex = new Conexion();
            // Realizamos la consulta para obtener los billetes.
            $result = $conex->query("SELECT * FROM billete WHERE recorrido = '$recorrido' AND fecha = '$fecha' AND hora = '$hora'");
            if ($result->rowCount()) {
                while ($fila = $result->fetchObject()) {
                    // Inicializamos un objeto Billete con los datos de cada fila de la BD.
                    $billete = new Billete($fila->dni, $fila->recorrido, $fila->hora, $fila->agencia, $fila->fecha, $fila->tipo, $fila->precio, $fila->img_tarjeta);
                    // Guardamos en array.
                    $billetes[] = $billete;
                }
            } else {
                $billetes = false;
            }
            return $billetes;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}

?>