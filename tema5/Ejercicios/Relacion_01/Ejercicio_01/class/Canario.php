<?php
// Importamos la clase Ave.
require_once './Ave.php';

class Canario extends Ave {
    private $color;
    
    // Constructor.
    public function __construct($nombre, $num_patas, $pelaje, $tipo_pico, $color) {
        parent::__construct($nombre, $num_patas, $pelaje, $tipo_pico);
        $this->color = $color;
    }
    
    // Métodos.
    public function emitirSonido() {
        echo $this->nombre . " ha cantado.";
    }
    
    public function comer() {
        echo $this->nombre . " ha empezado a comer.";
    }
    
    // Métodos mágicos.
    public function __toString(): string {
        return "Hola, soy un canario. " . parent::__toString() . " El color de mis plumas es $this->color.";
    }
    
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }
}
?>