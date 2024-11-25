<?php
// Importamos la clase padre.
require_once 'Animal.php';

class Ave extends Animal {
    protected $tipo_pico; 
            
    // Constructor.
    public function __construct($nombre, $num_patas, $pelaje, $tipo_pico) {
        parent::__construct($nombre, $num_patas, $pelaje);
        $this->tipo_pico = $tipo_pico;
    }
    
    // Métodos.
    protected function volar() {
        echo $this->nombre . " ha empezado a volar.";
    }

    // Método heredado (abstracto)
    protected function emitirSonido() {
        echo $this->nombre . " emite un sonido.";
    }
    
    // Métodos mágicos.
    public function __toString(): string {
        return "Ave[nombre=" . $this->nombre
                . ", num_patas=" . $this->num_patas
                . ", tipo_pico=" . $this->tipo_pico
                . ", pelaje=" . $this->pelaje
                . "]";
    }
    
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }
        
}
?>