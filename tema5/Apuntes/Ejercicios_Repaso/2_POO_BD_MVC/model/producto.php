<?php

class Producto {
    private $codigo;
    private $nombre;
    private $precio;

    /**
     * Constructor.
     * @param type $cod
     * @param type $nom
     * @param type $pre
     */
    public function __construct($cod = "", $nom = "", $pre = "") {
        $this->codigo = $cod;
        $this->nombre = $nom;
        $this->precio = $pre;
    }

    // <============ Métodos ============>
    
    /**
     * 
     * @param type $cod
     * @param type $nom
     * @param type $pre
     */
    public function nuevoProducto($cod, $nom, $pre) {
        $this->codigo = $cod;
        $this->nombre = $nom;
        $this->precio = $pre;
    }

    // <============ Métodos Mágicos ============>

    /**
     * 
     * @return string
     */
    public function __toString(): string {
        return "Código: " . $this->codigo . " - Nombre: " . $this->nombre . " - Precio: " . $this->precio;
    }

    /**
     * 
     * @param string $name
     * @return mixed
     */
    public function __get(string $name): mixed {
        return $this->$name;
    }

    /**
     * 
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }
}

?>