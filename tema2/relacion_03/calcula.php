<html>
    <head>
        <title>Relación 3 - Operaciones con Matrices</title>
        <style>
            table, td {
                border-collapse: collapse;
                border: 2px solid black;
            }
            td {
                font-size: 2em;
                padding: 1em;
            }
            p {
                font-size: 1.5em;
            }
        </style>
    </head>
    <body>
        <?php

            // Comprobamos si procedemos de la página 'index.php'.
            // En caso contrario, nos redirigirá a dicha página.
            if (isset($_REQUEST['id'])) {
        
                // Acceso a las funciones del fichero "funciones.php".
                require_once 'funciones.php';

                // Variable para la opción elegida en 'index.php'.
                $option = intval($_REQUEST['id']);

                // Validation flags.
                $f_rows = false; $f_columns = false;
                $f_square = false;  # Bandera destinada a opción 4 ($option).

                // Data Validation.
                if (isset($_POST['send'])) {
                    // Para este caso, podemos utilizar simplemente is_numeric().
                    // La función is_int() no recoge valores con comillas.
                    if (!empty($_POST['rows']) && is_numeric($_POST['rows']) && $_POST['rows'] > 0) $f_rows = true;
                    if (!empty($_POST['columns']) && is_int((int)$_POST['columns']) && $_POST['columns'] > 0) $f_columns = true;
                    // Bandera que comprueba si la matriz es cuadrada (suma diagonal principal).
                    if ($f_rows && $f_columns && ($_POST['rows'] === $_POST['columns']) && $option == 4) $f_square = true;
                }

                if (isset($_POST['send']) && $f_rows && $f_columns) {
                    // Generamos y mostramos la matriz generada.
                    echo "<h1>Matriz Generada</h1>";
                    $matriz = generarMatriz($_POST['rows'], $_POST['columns']);
                    mostrarMatriz($matriz);

                    // Según la opción elegida en el menú principal($option).
                    switch ($option) {
                        case 1:
                            // Calcular la suma de las filas
                            calcularSumaFilas($matriz);
                            echo "<a href='index.php'>Volver a Inicio</a>";
                            break;
                        case 2:
                            // Calcular la suma de las columnas
                            calcularSumaColumnas($matriz);
                            echo "<a href='index.php'>Volver a Inicio</a>";
                            break;
                        case 3:
                            // Calcular la suma de las filas y las columnas
                            calcularSumaTotalFilasColumnas($matriz);
                            echo "<a href='index.php'>Volver a Inicio</a>";
                            break;
                        case 4:
                            // Suma de la diagonal principal
                            if ($f_square) {
                                calcularDiagonalPrincipal($matriz);
                                echo "<a href='index.php'>Volver a Inicio</a>";
                            } else {
                                echo "<p><span style='color: red'>ERROR</span>. La matriz debe ser cuadrada para poder calcular su diagonal principal</p>";
                                // Pasamos por GET el valor 4 ($option) para volver a introducir datos.
                                echo "<a id=\"4\" href='calcula.php?id=4'>Volver a atrás</a>";
                            }
                            break;
                        case 5:
                            // Calcular matriz traspuesta
                            calcularMatrizTraspuesta($matriz);
                            echo "<br><a href='index.php'>Volver a Inicio</a>";
                            break;                    
                    }

                } else {

                    ?>
                    <h1>Matriz a generar</h1>
                    <form action="" method="post">
                        <p>Filas: <input type="number" name="rows" value="<?php if ($f_rows) echo $_POST['rows']; ?>">
                        <!-- Show Error -->
                        <?php if(isset($_POST['send']) && !$f_rows) echo "<span style='color: red'>Introduzca un valor válido para las filas</span>"; ?>
                        </p>
                        <p>Columnas: <input type="number" name="columns" value="<?php if ($f_columns) echo $_POST['columns']; ?>">
                        <!-- Show Error -->
                        <?php if(isset($_POST['send']) && !$f_columns) echo "<span style='color: red'>Introduzca un valor válido para las columnas</span>"; ?>                    
                        </p>
                        <input type="submit" name="send" value="Enviar">
                    </form>        
                    <?php
                }
            
            } else {
                // En caso de que el usuario intente entrar en esta página directamente,
                // lo redirigiremos a la página deseada con la siguiente función.
                header("Location:index.php");
            }
        ?>
        
    </body>
</html>
