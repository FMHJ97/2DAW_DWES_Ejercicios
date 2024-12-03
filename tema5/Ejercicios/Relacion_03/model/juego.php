<?php

class Juego {
    private $codigo;
    private $nombre_juego;
    private $nombre_consola;
    private $anio;
    private $precio;
    private $alquilado;
    private $imagen;
    private $descripcion;
    
    /**
     * 
     * @param type $codigo
     * @param type $nombre_juego
     * @param type $nombre_consola
     * @param type $anio
     * @param type $precio
     * @param type $alquilado
     * @param type $imagen
     * @param type $descripcion
     */
    public function __construct($codigo="", $nombre_juego="", $nombre_consola="", $anio="", $precio="", $alquilado="", $imagen="", $descripcion="") {
        $this->codigo = $codigo;
        $this->nombre_juego = $nombre_juego;
        $this->nombre_consola = $nombre_consola;
        $this->anio = $anio;
        $this->precio = $precio;
        $this->alquilado = $alquilado;
        $this->imagen = $imagen;
        $this->descripcion = $descripcion;
    }

    /**
     * 
     * @return string
     */
    public function __toString(): string {
        return "Juego[codigo=" . $this->codigo
                . ", nombre_juego=" . $this->nombre_juego
                . ", nombre_consola=" . $this->nombre_consola
                . ", anio=" . $this->anio
                . ", precio=" . $this->precio
                . ", alquilado=" . $this->alquilado
                . ", imagen=" . $this->imagen
                . ", descripcion=" . $this->descripcion
                . "]";
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
    
    /**
     * 
     * @param string $name
     * @return mixed
     */
    public function __get(string $name): mixed {
        return $this->$name;
    }
}

?>