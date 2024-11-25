<?php 

abstract class Animal {
    // Propiedades.
    protected $nombre;
    protected $num_patas;
    protected $pelaje;
    
    // Constructor.
    public function __construct($nombre, $num_patas, $pelaje) {
        $this->nombre = $nombre;
        $this->num_patas = $num_patas;
        $this->pelaje = $pelaje;
    }
    
    // Métodos.
    abstract public function emitirSonido();
    
    // Métodos mágicos.
    public function __toString(): string {
        return "Mi nombre es $this->nombre. Tengo $this->num_patas patas "
            . "y mi pelaje está compuesto por $this->pelaje.";
    }
    
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }
}

?>