<?php

require_once 'conexion.php';
require_once '../model/cliente.php';

class ControllerCliente {
    
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