<?php
// Importamos la clase padre.
require_once 'Animal.php';

class Mamifero extends Animal {
    public $sexo; 
            
    // Constructor.
    public function __construct($nombre, $num_patas, $pelaje, $sexo) {
        parent::__construct($nombre, $num_patas, $pelaje);
        $this->sexo = $sexo;
    }
    
    // Métodos.
    public function correr() {
        echo $this->nombre . " ha empezado a correr.";
    }

    public function emitirSonido() {
        echo $this->nombre . " emite un sonido.";
    }
    
    // Métodos mágicos.
    public function __toString(): string {
        return parent::__toString() . " Mi sexo es $this->sexo.";
    }
    
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }
        
}
?>