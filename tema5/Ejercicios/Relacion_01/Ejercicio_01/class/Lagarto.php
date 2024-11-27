<?php
// Importamos la clase padre.
require_once 'Animal.php';

class Lagarto extends Animal {
    private $color_ojos; 
            
    // Constructor.
    public function __construct($nombre, $num_patas, $pelaje, $color_ojos) {
        parent::__construct($nombre, $num_patas, $pelaje);
        $this->color_ojos = $color_ojos;
    }
    
    // Métodos.
    public function sacarLengua() {
        echo $this->nombre . " ha sacado la lengua.";
    }
    
    public function dimeColorOjos() {
        echo $this->nombre . " tiene los ojos de color " . $this->color_ojos . ".";
    }

    public function emitirSonido() {
        echo $this->nombre . " ha empezado a sesear.";
    }
    
    // Métodos mágicos.
    public function __toString(): string {
        return parent::__toString() . " Soy un lagarto y tengo los ojos " . $this->color_ojos . ".";
    }
    
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }
        
}
?>