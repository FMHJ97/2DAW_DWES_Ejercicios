<?php

class Alquiler {
    private $id;
    private $cod_juego;
    private $dni_cliente;
    private $fecha_alquiler;
    private $fecha_devol;
    private $precio;
    
    /**
     * 
     * @param type $id
     * @param type $cod_juego
     * @param type $dni_cliente
     * @param type $fecha_alquiler
     * @param type $fecha_devol
     * @param type $precio
     */
    public function __construct($id="", $cod_juego="", $dni_cliente="", $fecha_alquiler="", $fecha_devol="", $precio="") {
        $this->id = $id;
        $this->cod_juego = $cod_juego;
        $this->dni_cliente = $dni_cliente;
        $this->fecha_alquiler = $fecha_alquiler;
        $this->fecha_devol = $fecha_devol;
        $this->precio = $precio;
    }

    
    /**
     * 
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }
    
    /**
     * 
     * @param string $name
     * @return mixed
     */
    public function __get(string $name): mixed {
        return $this->$name;
    }
}

?>