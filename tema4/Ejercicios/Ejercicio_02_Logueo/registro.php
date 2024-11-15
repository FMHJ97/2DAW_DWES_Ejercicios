<?php
// Banderas de validación.
$f_name=false; $f_surname=false; $f_address=false; $f_city=false; $f_user=false;
$f_pwd=false; $f_rep_pwd=false; $f_same_pwd=false; $f_letter_color=false;
$f_bg_color=false; $f_font_family=false; $f_font_size=false;
$f_main=false; // Bandera principal.

// Si pulsamos sobre el botón Registrar.
if (isset($_POST['register'])) {
    // Validación de campos.
    if (!empty($_POST['name'])) $f_name=true;
    if (!empty($_POST['surname'])) $f_surname=true;
    if (!empty($_POST['address'])) $f_address=true;
    if (!empty($_POST['city'])) $f_city=true;
    if (!empty($_POST['user'])) $f_user=true;
    if (!empty($_POST['pwd'])) $f_pwd=true;
    if (!empty($_POST['rep_pwd'])) $f_rep_pwd=true;
    // Comprobamos si los valores introducidos en los campos de clave son iguales.
    if (strcmp($_POST['pwd'], $_POST['rep_pwd']) == 0) $f_same_pwd=true;
    if (isset($_POST['letter_color'])) $f_letter_color=true;
    if (isset($_POST['bg_color'])) $f_bg_color=true;
    if (isset($_POST['font_family'])) $f_font_family=true;
    if (isset($_POST['font_size'])) $f_font_size=true;
    // Bandera de validación principal.
    if ($f_name && $f_surname && $f_address && $f_city && $f_user && $f_pwd && $f_rep_pwd && $f_same_pwd
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
        
        // Realizamos la consulta para insertar a un nuevo usuario.
        try {
            
        } catch (PDOException $ex) {
            echo $ex->errorInfo[1]." => ".$ex->errorInfo[2];
        }
    }
}
?>

<html>
    <head>
        <title>Ejercicio 2: Logueo - Registro</title>
        <style>
            span {color: red};
        </style>
    </head>
    <body>
        <h1>Registro</h1>
        <form action="" method="POST">
            <p>Nombre: <input type="text" name="name" value="<?php if ($f_name) echo $_POST['name']; ?>">
            <!-- Error -->
            <?php if (isset($_POST['register']) && !$f_name) echo "<span>El nombre no puede estar vacío!</span>"; ?>
            </p>
            <p>Apellidos: <input type="text" name="surname" value="<?php if ($f_surname) echo $_POST['surname']; ?>"></p>
            <p>Dirección: <input type="text" name="address" value="<?php if ($f_address) echo $_POST['address']; ?>"></p>
            <p>Localidad: <input type="text" name="city" value="<?php if ($f_city) echo $_POST['city']; ?>"></p>
            <p>Usuario: <input type="text" name="user" value="<?php if ($f_user) echo $_POST['user']; ?>"></p>
            <p>Clave: <input type="password" name="pwd"></p>
            <p>Repetir clave: <input type="password" name="rep_pwd"></p>
            <!-- Color Letra Selector -->
            <p>Color de letra:
                <select name="letter_color">
                    <option value="white" <?php if ($f_letter_color && $_POST['letter_color']=="white") echo "selected"; ?>>White</option>
                    <option value="black" <?php if ($f_letter_color && $_POST['letter_color']=="black") echo "selected"; ?>>Black</option>
                    <option value="blue" <?php if ($f_letter_color && $_POST['letter_color']=="blue") echo "selected"; ?>>Blue</option>
                    <option value="red" <?php if ($f_letter_color && $_POST['letter_color']=="red") echo "selected"; ?>>Red</option>
                </select>
            </p>
            <!-- Color Fondo Selector -->
            <p>Color de fondo:
                <select name="bg_color">
                    <option value="black" <?php if ($f_bg_color && $_POST['bg_color']=="black") echo "selected"; ?>>Black</option>
                    <option value="white" <?php if ($f_bg_color && $_POST['bg_color']=="white") echo "selected"; ?>>White</option>
                    <option value="yellow" <?php if ($f_bg_color && $_POST['bg_color']=="yellow") echo "selected"; ?>>Yellow</option>
                    <option value="green" <?php if ($f_bg_color && $_POST['bg_color']=="green") echo "selected"; ?>>Green</option>
                </select>
            </p>
            <!-- Tipo Letra Selector -->
            <p>Tipo de letra:
                <select name="font_family">
                    <option value="Times New Roman" <?php if ($f_font_family && $_POST['font_family']=="Times New Roman") echo "selected"; ?>>Times New Roman</option>
                    <option value="Verdana" <?php if ($f_font_family && $_POST['font_family']=="Verdana") echo "selected"; ?>>Verdana</option>
                    <option value="Roboto" <?php if ($f_font_family && $_POST['font_family']=="Roboto") echo "selected"; ?>>Roboto</option>
                    <option value="Maven Pro" <?php if ($f_font_family && $_POST['font_family']=="Maven Pro") echo "selected"; ?>>Maven Pro</option>
                </select>
            </p>
            <!-- Tamaño Letra Selector -->
            <p>Tamaño de letra:
                <select name="font_size">
                    <option value="16" <?php if ($f_font_size && $_POST['font_size']=="16") echo "selected"; ?>>16px</option>
                    <option value="20" <?php if ($f_font_size && $_POST['font_size']=="16") echo "selected"; ?>>20px</option>
                    <option value="22" <?php if ($f_font_size && $_POST['font_size']=="16") echo "selected"; ?>>22px</option>
                    <option value="24" <?php if ($f_font_size && $_POST['font_size']=="16") echo "selected"; ?>>24px</option>
                </select>
            </p>
            <input type="submit" name="register" value="Registrar">
        </form>
        <a href="index.php"><input type="button" value="Cancelar"></a>        
    </body>
</html>
