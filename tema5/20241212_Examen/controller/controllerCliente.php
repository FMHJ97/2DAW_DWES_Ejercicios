<?php

require_once '../controller/conexion.php';
require_once '../model/cliente.php';

class ControllerCliente {
    
    /**
     * 
     * @param Cliente $cliente
     * @return bool
     */
    public static function insert(Cliente $cliente) {
        try {

            $conex = new Conexion();
            // Realizamos la consulta para un cliente.
            $result = $conex->prepare("INSERT INTO cliente VALUES (?,?,?,?)");
            $result->bindParam(1, $cliente->dni);
            $result->bindParam(2, $cliente->nombre);
            $result->bindParam(3, $cliente->apellidos);
            $result->bindParam(4, $cliente->telf);
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
    public static function findById($id) {
        try {

            $conex = new Conexion();
            // Realizamos la consulta para un cliente.
            $result = $conex->prepare("SELECT * FROM cliente WHERE dni = ?");
            $result->bindparam(1, $id);
            $result->execute();
            if ($result->rowCount()) {
                $fila = $result->fetchObject();
                // Inicializamos un objeto Cliente con los datos de cada fila de la BD.
                $cliente = new Cliente($fila->dni, $fila->nombre, $fila->apellidos, $fila->telf);
            } else {
                $cliente = false;
            }
            return $cliente;
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
            // Realizamos la consulta para obtener los clientes.
            $result = $conex->query("SELECT * FROM cliente");
            if ($result->rowCount()) {
                while ($fila = $result->fetchObject()) {
                    // Inicializamos un objeto Cliente con los datos de cada fila de la BD.
                    $cliente = new Cliente($fila->dni, $fila->nombre, $fila->apellidos, $fila->telf);
                    // Guardamos en array.
                    $clientes[] = $cliente;
                }
            } else {
                $clientes = false;
            }
            return $clientes;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}

?>