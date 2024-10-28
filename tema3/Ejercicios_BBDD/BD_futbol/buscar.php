<html>
    <head>
        <title>BD futbol - Buscar Jugadores</title>
    </head>
    <style>
        table, th, td {
            border-collapse: collapse;
            border: 1px solid black;
        }
        th, td {
            padding: 0.5em;
            text-align: center;
        }
        th {
            background-color: lightblue;
        }
    </style>    
    <body>
        <?php
        // Importamos las funciones necesarias.
        require_once 'funciones.php';
        // Redirección(?).
        redirectIfIdMissing();
        
        // Validation flags.
        $f_dni=false; $f_posicion=false; $f_equipo=false;
        
        if (isset($_POST['search'])) {
            // Comprobamos la opción elegida en el selector.
            switch ($_POST['option']) {
                case "dni":
                    if (isDniValid($_POST['info'])) $f_dni=true;
                    break;
                case "posicion":
                    if (preg_match('/^[a-zA-Z]+$/', $_POST['info'])) $f_posicion=true;
                    break;
                case "equipo":
                    if (preg_match('/^([a-zA-Z]+\s?)+$/', $_POST['info'])) $f_equipo=true;                
                    break;                    
            }
        }        
        ?>        
        
        <h1>Buscar jugadores</h1>
        <form action="" method="POST">
            <p>Buscar por: 
                <select name="option">
                    <option value="dni" <?php if (isset($_POST['search']) && $_POST['option']=="dni") echo "selected";?>>DNI</option>
                    <option value="posicion" <?php if (isset($_POST['search']) && $_POST['option']=="posicion") echo "selected";?>>Posición</option>
                    <option value="equipo" <?php if (isset($_POST['search']) && $_POST['option']=="equipo") echo "selected";?>>Equipo</option>
                </select>
            </p>
            <p>Valor a buscar:
                <input type="text" name="info" 
                       value="<?php if (isset($_POST['search']) && ($f_dni || $f_posicion || $f_equipo)) echo $_POST['info']; ?>">
                <!--Show error-->
                <?php
                if (isset($_POST['search'])) {
                    switch ($_POST['option']) {
                        case "dni":
                            if (!$f_dni) echo "<span style='color:red'>Debe tener 8 números y una letra al final.</span>";
                            break;
                        case "posicion":
                            if (!$f_posicion) echo "<span style='color:red'>Introduzca un nombre de posición válido.</span>";
                            break;
                        case "equipo":
                            if (!$f_equipo) echo "<span style='color:red'>Introduzca un nombre de equipo válido.</span>";
                            break;
                    }
                }
                ?>
            </p>
            <input type="submit" name="search" value="Buscar">
            <a href="index.php"><input type="button" name="inicio" value="Inicio"></a>
        </form>
        
        <?php
        // Si hemos pulsado Buscar y el valor a buscar cumple con el
        // FORMATO adecuado de la opción elegida, procedemos a realizar
        // la consulta.
        if (isset($_POST['search']) && ($f_dni || $f_posicion || $f_equipo)) {
            // Creamos la conexión a la BD.
            $conex = getConnection("futbol");

            try {
                // Realizamos la consulta a la BD.
                $query = "SELECT * FROM jugador WHERE ";
                // Según la opción elegida, se utilizará una condición.
                // Buscaremos subcadenas para el Equipo y Posición, que permitirán
                // obtener coincidencias sin necesidad de que el valor ingresado sea exacto.               
                if ($f_dni) {
                    $query .= "DNI = ?";
                    $searchParam = $_POST['info'];
                }
                else if ($f_posicion) {
                    $query .= "Posicion LIKE ?";
                    // Con los comodines, establecemos el inicio-fin de la subcadena.
                    $searchParam = "%".$_POST['info']."%";
                }
                else if ($f_equipo) {
                    $query .= "Equipo LIKE ?";
                    // Con los comodines, establecemos el inicio-fin de la subcadena.
                    $searchParam = "%".$_POST['info']."%";
                }
                
                // Creamos una consulta preparada.
                $stmt = $conex->prepare($query);
                // Agregamos el parámetro del campo de texto.
                $stmt->bind_param('s', $searchParam);

                // Ejecutamos la consulta.
                // En caso de realizarla, procedemos a obtener los resultados.
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    // Comprobamos si hemos obtenido resultados desde la BD.
                    if ($result->num_rows) {
                        showDataJugadorTable($result);
                    } else {
                        echo "<p><span style='font-weight:bold'>NO SE HAN ENCONTRADO JUGADORES CON LOS REQUISITOS INTRODUCIDOS EN LA BD!</span></p>";
                    }                    
                }
                // Cerramos la conexión.
                $conex->close();
            } catch (Exception $ex) {
                die ("Error en la consulta: ".$ex->getMessage());
            }
        }
        ?>
    </body>
</html>
