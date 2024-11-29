<?php 

class Conexion extends mysqli {
    private $host = "localhost";
    private $user = "dwes";
    private $pwd = "abc123.";
    private $db = "mvc_empleados";
    
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct($this->host, $this->user, $this->pwd, $this->db);
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