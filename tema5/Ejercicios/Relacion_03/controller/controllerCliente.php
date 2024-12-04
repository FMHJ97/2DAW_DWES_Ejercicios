<?php

require_once 'conexion.php';
require_once '../model/cliente.php';

class ControllerCliente {
    
    /**
     * 
     * @param type $id
     * @return mixed
     */
    public static function getClienteById($id): mixed {
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("SELECT * FROM cliente WHERE DNI = ?");
            $stmt->bind_param(1, $id);
            if($stmt->execute()) {
                $fila = $stmt->fetch();
                $cliente = new Cliente($fila->DNI, $fila->Nombre, $fila->Apellidos, $fila->Direccion, $fila->Localidad, $fila->Clave, $fila->Tipo);
            } else {
                $cliente = false;
            }
            $stmt->close();
            $conex->close();
            return $cliente;
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
            $result = $conex->query("SELECT * FROM cliente");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $cliente = new Cliente($fila->DNI, $fila->Nombre, $fila->Apellidos, $fila->Direccion, $fila->Localidad, $fila->Clave, $fila->Tipo);
                    $clientes[] = $cliente;
                }
            } else {
                $clientes = false;
            }
            $conex->close();
            return $clientes;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }
    
}

?>