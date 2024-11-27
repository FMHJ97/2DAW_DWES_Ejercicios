<?php
// Importamos la clase Mamifiero.
require_once 'Mamifero.php';

class Perro extends Mamifero {
    private $raza;
    
    // Constructor.
    public function __construct($nombre, $num_patas, $pelaje, $sexo, $raza) {
        parent::__construct($nombre, $num_patas, $pelaje, $sexo);
        $this->raza = $raza;
    }
    
    // Métodos.
    public function emitirSonido() {
        echo $this->nombre . " ha ladrado.";
    }
    
    public function cazarRatones() {
        $cazados = random_int(1, 10);
        echo $this->nombre . " ha cazado " . $cazados . " ratones.";
        $this->ratones_cazados += $cazados;
    }
    
    public function cavar() {
        echo $this->nombre . " ha empezado a cavar.";
    }
    
    // Métodos mágicos.
    public function __toString(): string {
        return "Hola, soy un perro de raza $this->raza. " . parent::__toString();
    }    
    
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }
}
?>