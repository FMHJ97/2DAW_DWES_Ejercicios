<?php

class Cliente {
    private $dni;
    private $nombre;
    private $apellidos;
    private $direccion;
    private $localidad;
    private $clave;
    private $tipo;
    
    /**
     * 
     * @param type $dni
     * @param type $nombre
     * @param type $apellidos
     * @param type $direccion
     * @param type $localidad
     * @param type $clave
     * @param type $tipo
     */
    public function __construct($dni="",$nombre="",$apellidos="",$direccion="",$localidad="",$clave="",$tipo="") {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->direccion = $direccion;
        $this->localidad = $localidad;
        $this->clave = $clave;
        $this->tipo = $tipo;
    }
    
    /**
     * 
     * @return string
     */
    public function __toString(): string {
        return "Cliente[dni=" . $this->dni
                . ", nombre=" . $this->nombre
                . ", apellidos=" . $this->apellidos
                . ", direccion=" . $this->direccion
                . ", localidad=" . $this->localidad
                . ", clave=" . $this->clave
                . ", tipo=" . $this->tipo
                . "]";
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