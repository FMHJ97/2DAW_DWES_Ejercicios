<?php

class Persona {
    public $nombre;
    public $apellidos;
    public $edad;
    // Propiedad estática que pertenece a la clase, no a la instancia de la clase.
    // Para llamar a dicha propiedad, hacemos uso de self.
    public static $num_person=0;
    
    // Constructor de la clase.
    // Solo puede existir un constructor por clase.
    // Sin embargo, podemos hacer uso de parámetros para sobrecargar (override) la función.
    // De esta manera, tenemos varias opciones de inicialización.
    public function __construct($nombre="", $apell="", $edad="") {
        $this->nombre=$nombre;
        $this->apellidos=$apell;
        $this->edad=$edad;
        // Llamamos a la propiedad estática.
        self::$num_person++;
    }
    
    // Deconstructor de la clase.
    // Al destruir una instancia de la clase.
    public function __destruct() {
        self::$num_person--;
    }
    
    /**
     * 
     * @param type $valor
     */
    public function sumaEdad($valor) {
        $this->edad += $valor;
    }
    
    /**
     * 
     */
    public static function eliminarPerson() {
        self::$num_person--;
    }
    
    /**
     * Función que devuelve el valor del atributo privado estático $num_person;
     * @return type Valor $num_person.
     */
    public static function getNumPerson() {
        return self::$num_person;
    }
    
    /**
     * 
     * @return void
     */
    public function __clone(): void {
        self::$num_person++;
        $this->edad = 0;
    }
    
    /**
     * Método mágico que devuelve un String con los valores de la clase.
     * @return string Cadena de texto.
     */
    public function __toString(): string {
        return "Hola, me llamo $this->nombre $this->apellidos."
            . " Tengo $this->edad años.";
    }
    
    /**
     * Método mágico que devuelve el valor de un atributo.
     * @param string $name Nombre de la propiedad.
     * @return mixed Valor de la propiedad o atributo.
     */
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    /**
     * Método mágico que asigna un nuevo valor a un atributo o propiedad.
     * @param string $name Nombre de la propiedad.
     * @param mixed $value Nuevo valor de la propiedad.
     * @return void
     */
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }


    // Funciones Getter & Setters //
    
    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function setEdad($edad): void {
        $this->edad = $edad;
    }


}

?>