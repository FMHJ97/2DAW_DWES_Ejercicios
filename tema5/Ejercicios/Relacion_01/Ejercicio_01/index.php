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
$animal = new Animal("Luke", 4, "pelo");
$mamifero = new Mamifero("Sancho", 2, "pelo", "hombre");
$gato = new Gato("Niche", 4, "pelo", "hombre", 4);
$perro = new Perro("Becky", 4, "pelo", "hembra", "Labrador");
$ave = new Ave("Birdy", 2, "plumas", "corto");
$canario = new Canario("Kunie", 2, "plumas", "corto", "violeta");
$pinguino = new Pinguino("Skipper", 2, "plumas", "largo", "Emperador");
$lagarto = new Lagarto("Sech", 4, "escamas", "amarillo");

// Pruebas.
echo "<==================== Animal ====================><br><br>";
echo $animal."<br>";
echo $animal->emitirSonido()."<br>";

echo "<br><br><==================== Mamifero ====================><br><br>";
echo $mamifero."<br>";
echo $mamifero->emitirSonido()."<br>";
echo $mamifero->correr()."<br>";

echo "<br><br><==================== Gato ====================><br><br>";
echo $gato."<br>";
echo $gato->emitirSonido()."<br>";
echo $gato->correr()."<br>";
echo $gato->trepar()."<br>";
echo $gato->cazarRatones()."<br>";
echo $gato."<br>";

echo "<br><br><==================== Perro ====================><br><br>";
echo $perro."<br>";
echo $perro->emitirSonido()."<br>";
echo $perro->correr()."<br>";
echo $perro->cavar()."<br>";

echo "<br><br><==================== Ave ====================><br><br>";
echo $ave."<br>";
echo $ave->emitirSonido()."<br>";
echo $ave->volar()."<br>";

echo "<br><br><==================== Canario ====================><br><br>";
echo $canario."<br>";
echo $canario->emitirSonido()."<br>";
echo $canario->volar()."<br>";
echo $canario->comer()."<br>";

echo "<br><br><==================== Pingüino ====================><br><br>";
echo $pinguino."<br>";
echo $pinguino->emitirSonido()."<br>";
echo $pinguino->volar()."<br>";
echo $pinguino->bucear()."<br>";

echo "<br><br><==================== Lagarto ====================><br><br>";
echo $lagarto."<br>";
echo $lagarto->emitirSonido()."<br>";
echo $lagarto->sacarLengua()."<br>";
echo $lagarto->dimeColorOjos()."<br>";

?>