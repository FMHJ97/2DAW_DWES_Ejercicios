<?php

class Cliente {

    private $dni;
    private $nombre;
    private $apellidos;
    private $telf;

    /**
     * 
     * @param type $dni
     * @param type $nombre
     * @param type $apellidos
     * @param type $telf
     */
    public function __construct($dni, $nombre, $apellidos, $telf) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telf = $telf;
    }

    /**
     * 
     * @param string $name
     * @return mixed
     */
    public function __get(string $name): mixed {
        return $this->$name;
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
}

?>