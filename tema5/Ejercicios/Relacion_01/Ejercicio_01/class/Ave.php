<?php
// Importamos la clase padre.
require_once 'Animal.php';

class Ave extends Animal {
    public $tipo_pico; 
            
    // Constructor.
    public function __construct($nombre, $num_patas, $pelaje, $tipo_pico) {
        parent::__construct($nombre, $num_patas, $pelaje);
        $this->tipo_pico = $tipo_pico;
    }
    
    // Métodos.
    public function volar() {
        echo $this->nombre . " ha empezado a volar.";
    }

    public function emitirSonido() {
        echo $this->nombre . " emite un sonido.";
    }
    
    // Métodos mágicos.
    public function __toString(): string {
        return parent::__toString() . " Mi pico es $this->tipo_pico.";
    }
    
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }
        
}
?>