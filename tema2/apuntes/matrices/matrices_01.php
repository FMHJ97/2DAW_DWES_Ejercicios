<?php

    echo "<h1>Matrices</h1>";
    
    $matriz[][]="pepe";
    echo $matriz[0][0];
    echo "<br>";
    
    # Sin establecer un índice, por defecto coge el próximo valor ESCALAR del posible mayor índice.
    $matriz[5][]="antonio";
    echo $matriz[5][0];
    echo "<br>";
    
    $matriz[][]="juan";
    echo $matriz[6][0];
    echo "<br>";
    
    $matriz[0]["apellido"]="López";
    echo $matriz[0]["apellido"];
    echo "<br>";
    
    $matriz[6]["edad"]=34;
    echo $matriz[6]["edad"];
    echo "<br>";
    
    # Sin establecer un índice, por defecto coge el próximo valor ESCALAR del posible mayor índice.
    $matriz[6][]="María";
    echo $matriz[6][1];
    echo "<br>";
    
    /*
     * Para recorrer una matriz, haremos uso del bucle For-Each.
     * El primer bucle recorre TODA la fila. El bucle interior
     * recorre dicha fila o array, mostrando los elementos del mismo.
     */
    foreach ($matriz as $fila) {
        foreach ($fila as $col) {
            echo $col." - ";
        }
        echo "<br>";
    }
    
    echo "<br><br>";
    
    /*
     * Mostramos los índices y valores.
     */
    foreach ($matriz as $ind_f => $fila) {
        echo "{".$ind_f."}<br>";
        foreach ($fila as $ind_c => $col) {
            echo "[".$ind_c."] : ".$col." _ ";
        }
        echo "<br>";
    }
    
    echo "<br><br>";
    
    # Contamos el número de filas de una matriz.
    echo "Filas: ".count($matriz)."<br>";
    # Para contar el número de columnas, debemos indicar la fila.
    echo "Columnas: ".count($matriz[6])."<br>";
    
    /* 
     * Si queremos conocer el número total de elementos de la matriz,
     * introducimos como parámetro opcional 1. Esto hará que cuente
     * de manera recursiva (filas y columnas).
     */
    echo "Número de Elementos: ".count($matriz, 1)."<br>";
    
    echo "<br><br>";

    $matriz2=array(
        0=>array("codigo"=>1,"nombre"=>"Pepe","salario"=>2000),
        1=>array("codigo"=>2,"nombre"=>"Sara","salario"=>2200),
        2=>array("codigo"=>3,"nombre"=>"Jose","salario"=>2400)
    );
    
    foreach ($matriz2 as $indF => $fila) {
        echo "{".$indF."}<br>";
        foreach ($fila as $indC => $col) {
            echo "[".$indC."] : ".$col." _ ";
        }
        echo "<br>";
    }
    
    echo "<br><br>";
    
    echo "Filas: ".count($matriz2)."<br>";
    echo "Columnas: ".count($matriz2[1])."<br>";
    echo "Número de Elementos: ".count($matriz2, 1)."<br>";

?>

