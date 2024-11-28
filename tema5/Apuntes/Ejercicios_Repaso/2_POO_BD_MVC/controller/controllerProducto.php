<?php

require_once 'conexion.php';
require_once '../model/producto.php';

class ControllerProducto {

    /**
     * Método de clase que devuelve un producto de la BD.
     * @param type $id
     * @return mixed Producto - False
     */
    public static function buscarProducto($id): mixed {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM producto WHERE codigo = '$id'");
            if ($result->num_rows) {
                $fila = $result->fetch_object();
                $producto = new Producto($fila->codigo, $fila->nombre, $fila->precio);
            } else {
                $producto = false;
            }
            return $producto;
        } catch (Exception $ex) {
            die("ERROR EN LA BD! " . $ex->getMessage());
        }
    }

    /**
     * Método de clase que obtendrá todos los posibles productos de la BD.
     * @return mixed Array de Productos - False
     */
    public static function recuperarTodos(): mixed {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM producto");
            // Comprobamos el número de filas devueltas.
            if ($result->num_rows) {
                // En lugar de guardar los registros en formato Objeto,
                // vamos a guardar un objeto Producto con los datos obtenidos.
                // Con 'new self' hacemos referencia a 'new Producto', cuando
                // estamos en la clase Producto.
                $p = new Producto();
                while ($fila = $result->fetch_object()) {
                    // Sobre la misma dirección de memoria, sobrescribimos los
                    // datos del objeto.
                    $p->nuevoProducto($fila->codigo, $fila->nombre, $fila->precio);
                    // Clonamos el objeto (nuevo puntero) para evitar compartir
                    // la misma dirección de memoria.
                    $productos[] = clone($p);
                }
            } else {
                $productos = false;
            }
            // Cerramos la conexión.
            $conex->close();
            // Es aconsejable tener un return como máximo.
            return $productos;
        } catch (Exception $ex) {
            die("ERROR EN LA BD! " . $ex->getMessage());
        }
    }

    /**
     * Método para insertar un objeto Producto en la BD.
     * @param Producto $p
     * @return void
     */
    public static function insertar(Producto $p): mixed {
        try {
            $conex = new Conexion();
            $conex->query("INSERT INTO producto VALUES ('$p->codigo','$p->nombre',$p->precio)");
            $filas = $conex->affected_rows;
            $conex->close();
            return $filas;
        } catch (Exception $ex) {
            die("ERROR EN LA BD! => " . $ex->getMessage());
        }
    }
}

?>