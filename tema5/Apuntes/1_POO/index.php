<?php

// Importamos la clase Persona.
require_once './clases/Persona.php';

// Inicializamos una clase Persona.
$p = new Persona("Salazar", "Cortés", 32);

// Cambiamos la edad de la clase.
$p->setEdad(42);

// Mostramos la edad.
// echo $p->getEdad();
// echo $p->nombre." ".$p->apellidos." ".$p->edad; //Haciendo uso del método mágico __get();

// Utilizamos el método mágico __toString().
echo $p."<br><br>";

// Para llamar al atributo estático privado, debemos tener un método estático.
// Si fuera público, simplemente escribimos $p::num_person;
echo "Número de personas: ".Persona::getNumPerson()."<br>";

// Vamos a crear otra Persona.
$p2 = new Persona();
echo "Número de personas: ".Persona::getNumPerson()."<br>";

// Vamos a crear otra Persona.
$p3 = new Persona();
echo "Número de personas: ".Persona::getNumPerson()."<br>";

// Vamos a eliminar una Persona.
Persona::eliminarPerson();
echo "Número de personas: ".Persona::getNumPerson()."<br>";

modificaEdad($p);
echo $p."<br><br>";


// Devuelve un valor JSON del parámetro introducido.
$p_encode = json_encode($p);
// En nuestro caso, solo se codifican los atributos.
// Si los atributos son privados y/o estáticos, no serán codificados.
// Para ello, habrá que establecerlos como públicos.
var_dump($p_encode);
echo "<br>";
var_dump($p);

$p_encode = json_encode($p);
$p_decode = json_decode($p_encode);
echo "<br>";
var_dump($p_decode);


// Para duplicar un objeto, usamos el método clone().
$p4 = clone($p);

$p4->nombre="Maria";

echo "<br><br>";
echo $p."<br>";
echo $p4."<br>";

// Indicamos el tipo de parámetro que queremos que se pase.
function modificaEdad(Persona $persona) {
    $persona->edad=100;
}

?>