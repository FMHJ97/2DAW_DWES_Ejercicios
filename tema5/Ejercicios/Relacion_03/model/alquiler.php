<?php

class Alquiler {
    private $id;
    private $cod_juego;
    private $dni_cliente;
    private $fecha_alquiler;
    private $fecha_devol;
    
    /**
     * 
     * @param type $id
     * @param type $cod_juego
     * @param type $dni_cliente
     * @param type $fecha_alquiler
     * @param type $fecha_devol
     */
    public function __construct($id="", $cod_juego="", $dni_cliente="", $fecha_alquiler="", $fecha_devol="") {
        $this->id = $id;
        $this->cod_juego = $cod_juego;
        $this->dni_cliente = $dni_cliente;
        $this->fecha_alquiler = $fecha_alquiler;
        $this->fecha_devol = $fecha_devol;
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