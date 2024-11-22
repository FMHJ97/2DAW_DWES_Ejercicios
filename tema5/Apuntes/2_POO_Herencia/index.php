<?php

// Importamos la clase Persona.
require_once './clases/Persona.php';
// Importamos la clase Empleado.
require_once './clases/Empleado.php';

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

// Función que establece la edad de una clase Persona a 100.
// Indicamos el tipo de parámetro (Persona) que queremos que se pase.
function modificaEdad(Persona $persona) {
    $persona->edad=100;
}

// Cuando tratamos con Objetos o Clases, los operadores '==' y '==='
// devuelven los siguientes resultados boolean:
// 
// El operador '==' devuelve true cuando ambos objetos poseen los mismos atributos y valores.
// El operador '===' devuelve true cuando ambos objetos comparten la misma
// dirección de memoria (ambos punteros apuntan al mismo lugar).

$p4->nombre="Salazar";
modificaEdad($p4);

echo "<br><br>";
echo $p."<br>";
echo $p4."<br>";

if ($p == $p4) echo "<br>Son iguales";
else echo "<br>Son  distintos";

if ($p === $p4) echo "<br>Son iguales";
else echo "<br>Son  distintos";

// Ejemplo del método mágico __call().
// NO PUEDE EXISTIR UN MÉTODO LLAMADO modificar() en el código,
// puesto que llamaría a dicho método, y no al de la Clase Persona.

$p4->modificar("Paco");
echo "<br><br>".$p4."<br>";

$p4->modificar("Pepe","Pepito");
echo "<br><br>".$p4."<br>";

$p4->modificar("Julio","Campos","32");
echo "<br><br>".$p4."<br>";


echo "<br><br><============== HERENCIA ==============><br><br>";

$emp = new Empleado("Paco", "Campos", 50, 1900);

// Los métodos mágicos no se heredan, por lo que habrá que crearlos.

echo "Soy $emp->nombre y cobro $emp->salario";

?>