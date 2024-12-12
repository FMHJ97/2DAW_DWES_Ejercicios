<?php

class Tren {

    private $recorrido;
    private $hora;
    private $precio_tourist;
    
    /**
     * 
     * @param type $recorrido
     * @param type $hora
     * @param type $precio_tourist
     */
    public function __construct($recorrido, $hora, $precio_tourist) {
        $this->recorrido = $recorrido;
        $this->hora = $hora;
        $this->precio_tourist = $precio_tourist;
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