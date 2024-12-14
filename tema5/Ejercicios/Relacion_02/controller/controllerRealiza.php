<?php

require_once '../controller/conexion.php';
require_once '../model/realiza.php';

class ControllerRealiza {
    
    /**
     * 
     * @param String $email
     * @param int $id_tarea
     * @param int $horas
     * @return bool
     */
    public static function updateRealiza(String $email, int $id_tarea, int $horas): bool {
        try {
            $conex = new Conexion();
            $sql = "UPDATE realiza SET horas = ? WHERE email = ? AND id_tarea = ?";
            $stmt = $conex->prepare($sql);

            $stmt->bind_param("isi", $horas, $email, $id_tarea);
            $stmt->execute();

            $stmt->close();
            $conex->close();

            return true;
        } catch (Exception $ex) {
            die("Error al insertar participantes en la tabla realiza: " . $ex->getMessage());
        }
    }

    /**
     * 
     * @param int $id_tarea
     * @param array $participantes
     * @param int $horas
     * @return bool
     */
    public static function insertRealiza(int $id_tarea, array $participantes, int $horas = 0): bool {
        try {
            $conex = new Conexion();
            $sql = "INSERT INTO realiza (email, id_tarea, horas) VALUES (?, ?, ?)";
            $stmt = $conex->prepare($sql);

            // Se recorre cada participante para insertarlo en la tabla
            foreach ($participantes as $email) {
                $stmt->bind_param("sii", $email, $id_tarea, $horas);
                $stmt->execute();
            }

            $stmt->close();
            $conex->close();

            return true;
        } catch (Exception $ex) {
            die("Error al insertar participantes en la tabla realiza: " . $ex->getMessage());
        }
    }

    /**
     * 
     * @param type $id
     * @return bool
     */
    public static function findById($id_empleado, $id_tarea): mixed {
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
            die("ERROR en la BD! => " . $ex->getMessage());
        }
    }
    
    /**
     * 
     * @param type $id_empleado
     * @return mixed
     */
    public static function getAllByEmpleado($id_empleado): mixed {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM realiza WHERE email = '$id_empleado'");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
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
            $result = $conex->query("SELECT * FROM realiza");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
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
            die("ERROR en la BD! => " . $ex->getMessage());
        }
    }
}

?>