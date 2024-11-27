<?php

// Importo las clases necesarias.
require_once 'class/Animal.php';
require_once 'class/Mamifero.php';
require_once 'class/Gato.php';
require_once 'class/Perro.php';
require_once 'class/Ave.php';
require_once 'class/Canario.php';
require_once 'class/Pinguino.php';
require_once 'class/Lagarto.php';

// Inicializo todas las clases.
$animal = new Animal("Luke", 4, "Pelo");
$mamifero = new Mamifero("Sancho", 2, "Pelo", "Hombre");
$gato = new Gato("Niche", 4, "Pelo", "Hombre", 4);
$perro = new Perro("Becky", 4, "Pelo", "Hembra", "Labrador");
$ave = new Ave("Birdy", 2, "Plumas", "Corto");
$canario = new Canario("Kunie", 2, "Plumas", "Corto", "Violeta");
$pinguino = new Pinguino("Skipper", 2, "Plumas", "Largo", "Emperador");
$lagarto = new Lagarto("Sech", 4, "Escamas", "Amarillo");

// Pruebas.


?>