<?php

require_once 'conexion.php';
require_once '../model/empleado.php';

class ControllerEmpleado {
    
    /**
     * 
     * @param type $id
     * @return bool
     */
    public static function findById($id) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM empleados WHERE email = '$id'");
            if ($result->num_rows) {
                $fila = $result->fetch_object();
                $empleado = new Empleado($fila->email, $fila->pass, $fila->nombre, $fila->salario, $fila->departamento);
            } else {
                $empleado = false;
            }
            $conex->close();
            return $empleado;
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
            $result = $conex->query("SELECT * FROM empleados");
            if ($result->num_rows) {
                while($fila = $result->fetch_object()) {
                    // Inicializamos un objeto Empleado con los datos de cada fila de la BD.
                    $emp = new Empleado($fila->email, $fila->pass, $fila->nombre, $fila->salario, $fila->departamento);
                    // Guardamos en array.
                    $empleados[] = $emp;
                }
            } else {
                $empleados = false;
            }
            // Cerramos la conexión.
            $conex->close();
            // Devolvemos el resultado.
            return $empleados;
        } catch (Exception $ex) {
            die("ERROR en la BD! => ".$ex->getMessage());
        }
    }
}

?>