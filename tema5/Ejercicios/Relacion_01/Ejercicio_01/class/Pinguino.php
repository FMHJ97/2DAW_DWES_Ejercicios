<?php
// Importamos la clase Ave.
require_once './Ave.php';

class Pinguino extends Ave {
    private $especie;
    
    // Constructor.
    public function __construct($nombre, $num_patas, $pelaje, $tipo_pico, $especie) {
        parent::__construct($nombre, $num_patas, $pelaje, $tipo_pico);
        $this->especie = $especie;
    }
    
    // Métodos.
    public function emitirSonido() {
        echo $this->nombre . " ha barritado / ululado.";
    }
    
    public function bucear() {
        echo $this->nombre . " se ha lanzado a bucear.";
    }
    
    // Métodos mágicos.
    public function __toString(): string {
        return "Hola, soy un pingüino $this->especie. " . parent::__toString();
    }
    
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }
}
?>