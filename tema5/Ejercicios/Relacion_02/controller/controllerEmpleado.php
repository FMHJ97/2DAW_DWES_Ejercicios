<?php

require_once 'conexion.php';
require_once '../model/empleado.php';

class ControllerEmpleado {
    public static function verifyEmpleado($id, $pass): mixed {
        // Convertimos la clave introducida a md5.
        $encript = md5($pass);
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("SELECT * FROM empleados WHERE email = ? AND pass = ?");
            $stmt->bind_param('ss', $id, $encript);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $fila = $result->fetch_object();
                $empleado = new Empleado($fila->email, $fila->pass, $fila->nombre, $fila->salario, $fila->departamento);
            } else {
                $empleado = false;
            }
            $conex->close();
            return $empleado;
        } catch (Exception $ex) {
            die("ERROR en la BD! => " . $ex->getMessage());
        }
    }

    /**
     * 
     * @param type $id
     * @return mixed
     */
    public static function findById($id): mixed {
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("SELECT * FROM empleados WHERE email = ?");
            $stmt->bind_param('s', $id); // 's' indica tipo string
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows) {
                $fila = $result->fetch_object();
                $empleado = new Empleado($fila->email, $fila->pass, $fila->nombre, $fila->salario, $fila->departamento);
            } else {
                $empleado = false;
            }
            $stmt->close();
            $conex->close();
            return $empleado;
        } catch (Exception $ex) {
            die("ERROR en la BD! => " . $ex->getMessage());
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
                while ($fila = $result->fetch_object()) {
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
            die("ERROR en la BD! => " . $ex->getMessage());
        }
    }
}

?>