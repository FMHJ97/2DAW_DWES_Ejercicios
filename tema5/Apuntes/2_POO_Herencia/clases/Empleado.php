<?php

require_once 'Persona.php';

class Empleado extends Persona {
    private $salario;
    
    /**
     * Constructor
     * @param type $nombre
     * @param type $apell
     * @param type $edad
     * @param type $salario
     */
    public function __construct($nombre="Pepe", $apell="Pepito", $edad=43, $salario=1000) {
        parent::__construct($nombre, $apell, $edad);
        $this->salario = $salario;
    }
    
    /**
     * Método mágico que devuelve el valor de un atributo.
     * @param string $name Nombre de la propiedad.
     * @return mixed Valor de la propiedad o atributo.
     */
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    /**
     * Método mágico que asigna un nuevo valor a un atributo o propiedad.
     * @param string $name Nombre de la propiedad.
     * @param mixed $value Nuevo valor de la propiedad.
     * @return void
     */
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }    
}

?>