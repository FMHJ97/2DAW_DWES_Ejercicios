<?php

    try {
        $conex = new mysqli("localhost","dwes","abc123.","empleados");
        $conex->set_charset("utf8mb4");

        $result = $conex->query("SELECT * FROM marketing");
        
        if ($result->num_rows) {
            // Saca todos los registros en una matriz.
            // Por defecto, devuelve una matriz escalar.
            // 
            // fetch_all(MYSQLI_ASSOC) = Matriz asociativa.
            // fetch_all(MYSQLI_NUM) = Matriz Escalar.
            // fetch_all(MYSQLI_BOTH) = Matriz Mixta(Matriz duplicada -> ASSOC / NUM).
            // var_dump($result->fetch_all());
            
            // Fetch_array()
            // Saca el primer registro en un array. En la próxima extracción,
            // recogerá la siguiente fila. Es decir, el puntero se mueve en cada fetch.
            // Una vez que el puntero llegue a la última fila, tendremos que posicionar
            // el puntero manualmente con seek_data(posición fila) para volver a recorrer
            // las filas.
            // 
            // Por defecto, devuelve un array mixto. Es decir, la información estará
            // duplicada (podemos acceder por índices escalares o asociativos).
            // Al igual que fetch_all(), podemos indicar qué tipo de array devuelve.
            
            // Fetch_object()
            // Selecciona una fila y la guarda como un objeto.
            // Las propiedades del objeto serán las columnas de la fila.
            $fila = $result->fetch_object();
            echo $fila->Nombre;
        }
        else {
            echo "No hay ningún registro en la BD";
        }
    } catch (Exception $ex) {

    }

?>