<?php
// Importamos la clase Mamifiero.
require_once './Mamifero.php';

class Gato extends Mamifero {
    private $ratones_cazados;
    
    // Constructor.
    public function __construct($nombre, $num_patas, $pelaje, $sexo, $ratones_cazados=0) {
        parent::__construct($nombre, $num_patas, $pelaje, $sexo);
        $this->ratones_cazados = $ratones_cazados;
    }
    
    // Métodos.
    public function emitirSonido() {
        echo $this->nombre . " ha maullado.";
    }
    
    public function cazarRatones() {
        $cazados = random_int(1, 10);
        echo $this->nombre . " ha cazado " . $cazados . " ratones.";
        $this->ratones_cazados += $cazados;
    }
    
    public function trepar() {
        echo $this->nombre . " ha empezado a trepar.";
    }
    
    // Métodos mágicos.
    public function __toString(): string {
        return "Hola, soy un gato. " . parent::__toString() . " He cazado $this->ratones_cazados ratones.";
    }
    
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }
}
?>