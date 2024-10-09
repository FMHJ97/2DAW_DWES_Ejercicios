<html>
    <head>
        <title>Relación 3 - Operaciones con Matrices</title>
    </head>
    <body>
        <?php
            // Variable con la opción elegida.
            $option = intval($_REQUEST['id']);
        
            // Validation flags.
            $f_row = false; $f_column = false;
            $f_square = false; 
            
            // Data Validation.
            if (isset($_POST['send'])) {
                // Para este caso, podemos utilizar simplemente is_numeric().
                // La función is_int() no recoge valores con comillas.
                if (!empty($_POST['row']) && is_numeric($_POST['row']) && $_POST['row'] > 0) $f_row = true;
                if (!empty($_POST['column']) && is_int((int)$_POST['column']) && $_POST['column'] > 0) $f_column = true;
                if ($f_row && $f_column && ($_POST['row'] === $_POST['column']) && $option == 4) $f_square = true;
            }
            
            if (isset($_POST['send']) && $f_row && $f_column) {
                
                // Según la opción elegida en el menú principal($option).
                switch ($option) {
                    case 1:
                        // Calcular la suma de las filas
                        break;
                    case 2:
                        // Calcular la suma de las filas
                        break;
                    case 3:
                        // Calcular la suma de las filas
                        break;
                    case 4:
                        // Calcular la suma de las filas
                        break;
                    case 5:
                        // Calcular la suma de las filas
                        break;                    
                }
                
            } else {
                
                ?>
                <h1>Matriz a generar</h1>
                <form action="" method="post">
                    <p>Filas: <input type="number" name="row" value="<?php if ($f_row) echo $_POST['row']; ?>">
                    <!-- Show Error -->
                    <?php if(isset($_POST['send']) && !$f_row) echo "<span style='color: red'>Introduzca un valor válido para las filas</span>"; ?>
                    </p>
                    <p>Columnas: <input type="number" name="column" value="<?php if ($f_column) echo $_POST['column']; ?>">
                    <!-- Show Error -->
                    <?php if(isset($_POST['send']) && !$f_column) echo "<span style='color: red'>Introduzca un valor válido para las columnas</span>"; ?>                    
                    </p>
                    <input type="submit" name="send" value="Enviar">
                </form>        
                <?php
            }
        ?>
        
    </body>
</html>
