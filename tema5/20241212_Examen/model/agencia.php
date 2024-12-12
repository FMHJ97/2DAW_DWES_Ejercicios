<?php

class Agencia {

    private $nombre;
    private $telf;
    private $usuario;
    private $pass;
    
    /**
     * 
     * @param type $nombre
     * @param type $telf
     * @param type $usuario
     * @param type $pass
     */
    public function __construct($nombre, $telf, $usuario, $pass) {
        $this->nombre = $nombre;
        $this->telf = $telf;
        $this->usuario = $usuario;
        $this->pass = $pass;
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