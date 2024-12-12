<?php

class Empleado {
    public $email;
    public $pass;
    private $nombre;
    private $salario;
    private $departamento;
    
    /**
     * Constructor.
     * @param type $email
     * @param type $pass
     * @param type $nombre
     * @param type $salario
     * @param type $departamento
     */
    public function __construct($email="",$pass="",$nombre="",$salario="",$departamento="") {
        $this->email = $email;
        $this->pass = $pass;
        $this->nombre = $nombre;
        $this->salario = $salario;
        $this->departamento = $departamento;
    }
    
    /**
     * 
     * @return string
     */
    public function __toString(): string {
        return "Empleado[email=" . $this->email
                . ", pass=" . $this->pass
                . ", nombre=" . $this->nombre
                . ", salario=" . $this->salario
                . ", departamento=" . $this->departamento
                . "]";
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