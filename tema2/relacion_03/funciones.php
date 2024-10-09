<?php

    /*
     * Función que genera una matriz con filas y columnas especificas,
     * con valores comprendidos entre 1 y 100.
     */
    function generarMatriz($rows, $cols) {
        // Inicializamos la matriz.
        $matriz = array();
        
        // Rellenamos la matriz de valores a través de dos bucles.
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                // Guardamos un entero generado al azar en cada celda.
                $matriz[$i][$j] = rand(1, 100);
            }
        }
        // Devolvemos la matriz generada.
        return $matriz;
    }
    
    /*
     * Función que muestra una matriz a través de una tabla HTML.
     */
    function mostrarMatriz($matriz) {
        echo "<table>";
        foreach ($matriz as $row) {
            echo "<tr>";
            foreach ($row as $col) {
                echo "<td>".$col."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    
    /*
     * Función que recorre una matriz y calcula la suma total
     * de cada fila. A continuación, muestra los resultados por
     * mensajes.
     */
    function calcularSumaFilas($matriz) {
        // Variable suma.
        $suma = 0;
        
        // Recorremos la matriz y sumamos sus valores.
        foreach ($matriz as $indR => $row) {
            foreach ($row as $col) {
                $suma += $col;
            }
            // Mostramos mensaje.
            echo "<p>La suma total de la fila ".($indR + 1)." es ".$suma."</p>";
            //Reiniciamos variable suma.
            $suma = 0;
        }
    }
    
    /*
     * Función que recorre una matriz y calcula la suma total
     * de cada columna. A continuación, muestra los resultados por
     * mensajes.
     */
    function calcularSumaColumnas($matriz) {
        // Variable suma.
        $suma = 0;
        
        // Recorremos la matriz y sumamos sus valores.
        for ($col = 0; $col < count($matriz[0]); $col++) {
            for ($row = 0; $row < count($matriz); $row++) {
                $suma += $matriz[$row][$col];
            }
            // Mostramos mensaje.
            echo "<p>La suma total de la columna ".($col + 1)." es ".$suma."</p>";
            //Reiniciamos variable suma.
            $suma = 0;
        }
    }
    
    /*
     * Función que calcula la suma total de todas las filas y
     * la suma total de todas las columnas. A continuación,
     * devuelve los resultados por mensajes.
     */
    function calcularSumaTotalFilasColumnas($matriz) {
        // Variable suma.
        $suma = 0;
        
        // Calculamos la suma total de las filas.
        for ($row = 0; $row < count($matriz); $row++) {
            for ($col = 0; $col < count($matriz[$row]); $col++) {
                $suma += $matriz[$row][$col];
            }
        }
        // Mostramos mensaje.
        echo "<p>La suma total de las filas es ".$suma."</p>";
        
        // Reiniciamos varible suma.
        $suma = 0;
        
        // Calculamos la suma total de las columnas.
        for ($col = 0; $col < count($matriz[0]); $col++) {
            for ($row = 0; $row < count($matriz); $row++) {
                $suma += $matriz[$row][$col];
            }
        }
        // Mostramos mensaje.
        echo "<p>La suma total de las columnas es ".$suma."</p>";        
    }
    
    /*
     * Función que calcula la suma de la diagonal principal de
     * una matriz y muestra un mensaje con el resultado.
     */
    function calcularDiagonalPrincipal($matriz) {
        // Variable suma.
        $suma = 0;
        
        // Recorremos la matriz.
        // Sumaremos aquellos valores donde los índices de
        // fila y columna coincidan, diagonal principal.
        for ($row = 0; $row < count($matriz); $row++) {
            for ($col = 0; $col < count($matriz[$row]); $col++) {
                if ($row === $col) $suma += $matriz[$row][$col];
            }
        }
        // Mostramos mensaje.
        echo "<p>La suma de los valores de la diagonal principal es ".$suma."</p>";        
    }
    
    /*
     * Función que muestra la matriz traspuesta a partir
     * de una matriz original en una tabla HTML.
     */
    function calcularMatrizTraspuesta($matriz) {
        // Inicializamos una matriz vacia.
        $traspuesta = array();

        // Recorremos la matriz original.
        for ($row = 0; $row < count($matriz); $row++) {
            for ($col = 0; $col < count($matriz[$row]); $col++) {
                // Asignamos los valores correspondientes a la nueva matriz.
                $traspuesta[$col][$row] = $matriz[$row][$col];
            }
        }
        
        // Mostramos la matriz traspuesta.
        echo "<h2>Matriz Traspuesta</h2>";
        mostrarMatriz($traspuesta);
    }

?>