<?php

    function salario_bruto($salario, $retenciones, $comision) {
        $salario += $comision;
        $retenciones = $salario * ($retenciones / 100);
        return $salarioBruto = $salario - $retenciones;
    }
    
    # En las funciones con parámetros por defecto, debemos situar dichos
    # parámetros SIEMPRE AL FINAL.
    function salario_bruto2($retenciones, $comision, $salario = 2000) {
        $salario += $comision;
        $retenciones = $salario * ($retenciones / 100);
        return $salarioBruto = $salario - $retenciones;
    }
    
    /*
     * Para pasar los parámetros por referencia(se utilizan las direcciones de
     * memoria y NO copias de las variables), utilizamos el signo '&' delante
     * de los parámetros.
     */
    function salario_bruto3(&$salario, &$retenciones, &$comision) {
        $salario += $comision;
        $retenciones = $salario * ($retenciones / 100);
        return $salarioBruto = $salario - $retenciones;
    }

?>