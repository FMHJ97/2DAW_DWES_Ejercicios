<?php 

class Conexion extends PDO {
    private $dsn = "mysql:host=localhost;dbname=trenes;charset=utf8mb4";
    private $user = "dwes";
    private $pwd = "abc123.";
    
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct($this->dsn, $this->user, $this->pwd);
    }
    
    // <============ Métodos Mágicos ============>
    
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