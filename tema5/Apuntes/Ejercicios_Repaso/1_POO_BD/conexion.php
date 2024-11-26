<?php 
// Ejemplo 1
class Conexion extends mysqli {
    private $host = "localhost";
    private $user = "dwes";
    private $pwd = "abc123.";
    private $db = "objetos_bd";
    
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct($this->host, $this->user, $this->pwd, $this->db);
    }
    
    // Métodos mágicos.
    
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