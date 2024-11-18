<?php
// Propagamos la sesión actual.
session_start();

// Si pulsamos sobre el botón Salir.
if (isset($_POST['exit']) && isset($_SESSION['credenciales'])) {
    // Cerramos la sesión actual.
    session_unset();
    session_destroy();
    setcookie("PHPSESSID", "", time()-3600, "/"); // Eliminación en el cliente.
    // Realizamos la redirección a index.
    header("Location:index.php");
    exit();
}
// Si pulsamos sobre el botón Volver.
else if (isset($_POST['back']) && isset($_SESSION['credenciales'])) {
    header("Location:inicio.php");
    exit();
}

// Posible redirección.
if (!isset($_SESSION['credenciales'])) {
    header("Location:index.php");
    exit();
} else {
    // Guardamos el usuario autenticado en variable.
    $autenticado = $_SESSION['credenciales'];
}

// Banderas de validación.
$f_name=false; $f_surname=false; $f_address=false; $f_city=false; $f_user=false;
$f_pwd=false; $f_rep_pwd=false; $f_same_pwd=false; $f_letter_color=false;
$f_bg_color=false; $f_font_family=false; $f_font_size=false;
$f_main=false; // Bandera principal.

// Si pulsamos sobre el botón Modificar.
if (isset($_POST['modify'])) {
    // Validación de campos.
    if (!empty($_POST['name'])) $f_name=true;
    if (!empty($_POST['surname'])) $f_surname=true;
    if (!empty($_POST['address'])) $f_address=true;
    if (!empty($_POST['city'])) $f_city=true;
    if (!empty($_POST['user'])) $f_user=true;
    if (!empty($_POST['pwd'])) $f_pwd=true;
    if (!empty($_POST['rep_pwd'])) $f_rep_pwd=true;
    // Comprobamos si los valores introducidos en los campos de clave son iguales.
    if (strcmp($_POST['pwd'], $_POST['rep_pwd']) === 0) $f_same_pwd=true;
    if (isset($_POST['letter_color'])) $f_letter_color=true;
    if (isset($_POST['bg_color'])) $f_bg_color=true;
    if (isset($_POST['font_family'])) $f_font_family=true;
    if (isset($_POST['font_size'])) $f_font_size=true;
    // Bandera de validación principal.
    if ($f_name && $f_surname && $f_address && $f_city && $f_pwd && $f_rep_pwd && $f_same_pwd
            && $f_letter_color && $f_bg_color && $f_font_family && $f_font_size) {
        $f_main=true;
    }
    
    // Si todos los campos están validados, procedemos a realizar la consulta a la BD.
    if ($f_main) {
        // Conexión a la BD.
        try {
            $conex = new PDO("mysql:host=localhost;dbname=tema4_logueo;charset=utf8mb4;", "dwes", "abc123.");
        } catch (PDOException $ex) {
            die($ex->errorInfo[1]." => ".$ex->errorInfo[2]);
        }
        
        // Antes que nada, ciframos la clave introducida por el usuario.
        $encript_pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
        
        // Realizamos la consulta para insertar un nuevo usuario.        
        try {
            $res = $conex->exec(
                    "UPDATE perfil_usuario SET nombre='$_POST[name]', apellidos='$_POST[surname]', direccion='$_POST[address]', localidad='$_POST[city]', "
                    . "pass='$encript_pwd', color_letra='$_POST[letter_color]', color_fondo='$_POST[bg_color]', tipo_letra='$_POST[font_family]', tam_letra='$_POST[font_size]' "
                    . "WHERE user='$autenticado->user'"
            );
            // Utilizamos exec() para INSERT, UPDPATE y DELETE.
            // Puede devolver false (ERROR en la ejecución de la consulta),
            // 0 (Consulta ejecutada pero NINGUNA FILA AFECTADA) y
            // n > 0 (Consulta ejecutada y FILAS AFECTADAS).
            if ($res > 0) {
                // Obtenemos el registro modificado mediante consulta.
                $result = $conex->query("SELECT * FROM perfil_usuario WHERE user='$_POST[user]'");
                // Guardamos la fila obtenida en la sesión.
                // Utilizamos el mismo nombre para sobrescribir el valor actual.
                if ($result->execute()) $_SESSION['credenciales'] = $result->fetchObject();
                // Nos dirigimos a inicio.
                header("Location:inicio.php");
                exit();
            }
        } catch (PDOException $ex) {
            echo $ex->errorInfo[1]." => ".$ex->errorInfo[2];
        }
    }
}
?>

<html>
    <head>
        <title>Ejercicio 2: Logueo - Modificar</title>
        <?php
        if (isset($_SESSION['credenciales'])) {
            echo "<style>";
            echo "body {";
            echo "color: $autenticado->color_letra;";
            echo "background-color: $autenticado->color_fondo;";
            echo "font-family: $autenticado->tipo_letra;";
            echo "font-size: $autenticado->tam_letra;";
            echo "}";
            echo "span {color:red;}";
            echo "</style>";
        }
        ?>
    </head>
    <body>
        <h1>Modificar</h1>
        <h2>Hola, <?php if (isset($_SESSION['credenciales'])) echo $autenticado->nombre." ".$autenticado->apellidos; ?>!</h2>
        <!-- Mostramos mensaje -->
        <?php if (isset($_POST['modify']) && isset($msg)) echo $msg; ?>
        <form action="" method="POST">
            <p>Nombre: <input type="text" name="name" 
                              value="<?php if ($f_name) echo $_POST['name'];
                              else if (isset ($autenticado)) echo $autenticado->nombre; ?>">
            <!-- Error -->
            <?php if (isset($_POST['modify']) && !$f_name) echo "<span>El campo Nombre no puede estar vacío!</span>"; ?>
            </p>
            <p>Apellidos: <input type="text" name="surname" 
                                 value="<?php if ($f_surname) echo $_POST['surname'];
                                 else if (isset ($autenticado)) echo $autenticado->apellidos; ?>">
            <!-- Error -->
            <?php if (isset($_POST['modify']) && !$f_surname) echo "<span>El campo Apellidos no puede estar vacío!</span>"; ?>            
            </p>
            <p>Dirección: <input type="text" name="address" 
                                 value="<?php if ($f_address) echo $_POST['address'];
                                 else if (isset ($autenticado)) echo $autenticado->direccion; ?>">
            <!-- Error -->
            <?php if (isset($_POST['modify']) && !$f_address) echo "<span>El campo Dirección no puede estar vacío!</span>"; ?>            
            </p>
            <p>Localidad: <input type="text" name="city" 
                                 value="<?php if ($f_city) echo $_POST['city'];
                                 else if (isset ($autenticado)) echo $autenticado->localidad; ?>">
            <!-- Error -->
            <?php if (isset($_POST['modify']) && !$f_city) echo "<span>El campo Localidad no puede estar vacío!</span>"; ?>                        
            </p>
            <p>Usuario: <input type="text" name="user" readonly="" 
                               value="<?php if ($f_user) echo $_POST['user'];
                               else if (isset ($autenticado)) echo $autenticado->user; ?>"></p>
            <p>Clave: <input type="password" name="pwd">
            <!-- Error -->
            <?php if (isset($_POST['modify']) && !$f_pwd) echo "<span>El campo Clave no puede estar vacío!</span>"; ?>                        
            </p>
            <p>Repetir clave: <input type="password" name="rep_pwd">
            <!-- Error -->
            <?php
            if (isset($_POST['modify']) && !$f_rep_pwd) echo "<span>El campo Repetir clave no puede estar vacío!</span>";
            else if (isset($_POST['modify']) && !$f_same_pwd) echo "<span>Las claves introducidas NO coinciden!</span>";
            ?>                        
            </p>
            <!-- Color Letra Selector -->
            <p>Color de letra:
                <select name="letter_color">
                    <option value="white" <?php if ($f_letter_color && $_POST['letter_color'] == "white") echo "selected";
                    else if (isset ($autenticado) && $autenticado->color_letra == "white") echo "selected"; ?>
                            >White</option>
                    <option value="black" <?php if ($f_letter_color && $_POST['letter_color'] == "black") echo "selected";
                    else if (isset ($autenticado) && $autenticado->color_letra == "black") echo "selected"; ?>
                            >Black</option>
                    <option value="blue" <?php if ($f_letter_color && $_POST['letter_color'] == "blue") echo "selected";
                    else if (isset ($autenticado) && $autenticado->color_letra == "blue") echo "selected"; ?>
                            >Blue</option>
                    <option value="red" <?php if ($f_letter_color && $_POST['letter_color'] == "red") echo "selected";
                    else if (isset ($autenticado) && $autenticado->color_letra == "red") echo "selected"; ?>
                            >Red</option>
                </select>
            <!-- Error -->
            <?php if (isset($_POST['modify']) && !$f_letter_color) echo "<span>Seleccione un color de letra!</span>"; ?>
            </p>
            <!-- Color Fondo Selector -->
            <p>Color de fondo:
                <select name="bg_color">
                    <option value="black" <?php if ($f_bg_color && $_POST['bg_color'] == "black") echo "selected";
                    else if (isset ($autenticado) && $autenticado->color_fondo == "black") echo "selected"; ?>
                            >Black</option>
                    <option value="white" <?php if ($f_bg_color && $_POST['bg_color'] == "white") echo "selected";
                    else if (isset ($autenticado) && $autenticado->color_fondo == "white") echo "selected"; ?>
                            >White</option>
                    <option value="yellow" <?php if ($f_bg_color && $_POST['bg_color'] == "yellow") echo "selected";
                    else if (isset ($autenticado) && $autenticado->color_fondo == "yellow") echo "selected"; ?>
                            >Yellow</option>
                    <option value="green" <?php if ($f_bg_color && $_POST['bg_color'] === "green") echo "selected";
                    else if (isset ($autenticado) && $autenticado->color_fondo == "green") echo "selected"; ?>
                            >Green</option>
                </select>
            <!-- Error -->
            <?php if (isset($_POST['modify']) && !$f_bg_color) echo "<span>Seleccione un color de fondo!</span>"; ?>                
            </p>
            <!-- Tipo Letra Selector -->
            <p>Tipo de letra:
                <select name="font_family">
                    <option value="Times New Roman" <?php if ($f_font_family && $_POST['font_family'] == "Times New Roman") echo "selected";
                    else if (isset ($autenticado) && $autenticado->tipo_letra == "Times New Roman") echo "selected"; ?>
                            >Times New Roman</option>
                    <option value="Verdana" <?php if ($f_font_family && $_POST['font_family'] == "Verdana") echo "selected";
                    else if (isset ($autenticado) && $autenticado->tipo_letra == "Verdana") echo "selected"; ?>
                            >Verdana</option>
                    <option value="Roboto" <?php if ($f_font_family && $_POST['font_family'] == "Roboto") echo "selected";
                    else if (isset ($autenticado) && $autenticado->tipo_letra == "Roboto") echo "selected"; ?>
                            >Roboto</option>
                    <option value="Arial" <?php if ($f_font_family && $_POST['font_family'] == "Arial") echo "selected";
                    else if (isset ($autenticado) && $autenticado->tipo_letra == "Arial") echo "selected"; ?>
                            >Arial</option>
                </select>
            <!-- Error -->
            <?php if (isset($_POST['modify']) && !$f_font_family) echo "<span>Seleccione un tipo de letra!</span>"; ?>                
            </p>
            <!-- Tamaño Letra Selector -->
            <p>Tamaño de letra:
                <select name="font_size">
                    <option value="16" <?php if ($f_font_size && $_POST['font_size'] == 16) echo "selected";
                    else if (isset ($autenticado) && $autenticado->tam_letra == 16) echo "selected"; ?>
                            >16px</option>
                    <option value="20" <?php if ($f_font_size && $_POST['font_size'] == 20) echo "selected";
                    else if (isset ($autenticado) && $autenticado->tam_letra == 20) echo "selected"; ?>
                            >20px</option>
                    <option value="22" <?php if ($f_font_size && $_POST['font_size'] == 22) echo "selected";
                    else if (isset ($autenticado) && $autenticado->tam_letra == 22) echo "selected"; ?>
                            >22px</option>
                    <option value="24" <?php if ($f_font_size && $_POST['font_size'] == 24) echo "selected";
                    else if (isset ($autenticado) && $autenticado->tam_letra == 24) echo "selected"; ?>
                            >24px</option>
                </select>
            <!-- Error -->
            <?php if (isset($_POST['modify']) && !$f_font_size) echo "<span>Seleccione un tamaño de letra!</span>"; ?>                                
            </p>
            <input type="submit" name="modify" value="Modificar">
            <input type="submit" name="back" value="Volver">
            <input type="submit" name="exit" value="Salir">
        </form>
    </body>
</html>
