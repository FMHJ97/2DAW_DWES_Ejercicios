<?php

    $a[8]="pepe"; # Asignamos en el índice 8 del array la cadena "pepe".
    $a[2] = "Antonio"; # Añade otro valor al array, a continuación (derecha) del anterior elemento.
    $a[] = "Juan"; # Sin establecer un índice, por defecto coge el próximo valor del mayor índice.
    $a["edad"] = 25; # Al agregar este elemento, el array es Mixto.
    $a[5] = "Rosa";
    
    /*
     * En PHP, se utilizan los índices para aportar información.
     */
    
    echo count($a); # Devuelve el número de elementos del array.
    
    // Creamos un array con índices personalizados.
    $b = array(
        0 => 7, 8 => "David", "apellidos" => "Campos"
    );
    
    // Crea un array escalar por defecto(Índices -> 0,1,2...).
    $c = array("pepe", "carlos", "jose");
    
    echo "<br>";
    print_r($b); # Imprime los elementos del array sin formato(comprobación array).
    echo "<br>";
    // Para comprobar el tipo de elementos de un array.
    var_dump($b);
    
    echo "<br><br>";
    
    // Para recorrer un array, hacemos uso del For-each.
    foreach ($a as $value) {
        echo $value."<br>";
    }
    
    echo "<br>";
    // Además mostramos los índices del array ($key).
    foreach ($a as $key => $value) {
        echo $key."-".$value."<br>";
    }
    
?>

