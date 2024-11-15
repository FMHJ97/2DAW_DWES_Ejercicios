<?php
// Banderas de validación.
$f_name=false; $f_surname=false; $f_address=false; $f_city=false; $f_user=false;
$f_pwd=false; $f_rep_pwd=false; $f_same_pwd=false; $f_letter_color=false;
$f_bg_color=false; $f_font_family=false; $f_font_size=false;
$f_main=false; // Bandera principal.

// Si pulsamos sobre el botón Cancelar.
if (isset($_POST['cancel'])) {
    header("Location:index.php");
    exit();
}

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
        
        // Antes que nada, ciframos la clave introducida por el usuario.
        $encript_pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
        
        // Realizamos la consulta para insertar un nuevo usuario.        
        try {
            $res = $conex->exec(
                    "INSERT INTO perfil_usuario VALUES('$_POST[name]','$_POST[surname]','$_POST[address]','$_POST[city]',"
                    . "'$_POST[user]','$encript_pwd','$_POST[letter_color]','$_POST[bg_color]','$_POST[font_family]','$_POST[font_size]')"
                    );
            // Utilizamos exec() para INSERT, UPDPATE y DELETE.
            // Puede devolver false (ERROR en la ejecución de la consulta),
            // 0 (Consulta ejecutada pero NINGUNA FILA AFECTADA) y
            // n > 0 (Consulta ejecutada y FILAS AFECTADAS).
            if ($res > 0) {
                // Asignamos un tiempo de vida a la sesión.
                ini_set("session.gc_maxlifetime", 1800);
                session_set_cookie_params(1800);
                // Creamos una sesión que contendrá al nuevo usuario.
                session_start();
                // Obtenemos el registro insertado mediante consulta;
                $result = $conex->query("SELECT * FROM perfil_usuario WHERE user='$_POST[user]'");
                // Guardamos la fila obtenida en la sesión.
                // Utilizamos el mismo nombre que utilizamos en los otros ficheros.
                if ($result->execute()) $_SESSION['credenciales'] = $result->fetchObject();
                // Nos dirigimos a inicio.
                header("Location:inicio.php");
                exit();
            }
        } catch (PDOException $ex) {
            // En caso de insertar una primary key (user) existente, mostramos mensaje.
            if ($ex->errorInfo[1] === 1062) $msg = "<span>USUARIO EXISTENTE EN LA BD!</span>";
            else echo $ex->errorInfo[1]." => ".$ex->errorInfo[2];
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
        <!-- Mostramos mensaje si user introducido está en BD. -->
        <?php if (isset($_POST['register']) && isset($msg)) echo $msg; ?>
        <form action="" method="POST">
            <p>Nombre: <input type="text" name="name" value="<?php if ($f_name) echo $_POST['name']; ?>">
            <!-- Error -->
            <?php if (isset($_POST['register']) && !$f_name) echo "<span>El campo Nombre no puede estar vacío!</span>"; ?>
            </p>
            <p>Apellidos: <input type="text" name="surname" value="<?php if ($f_surname) echo $_POST['surname']; ?>">
            <!-- Error -->
            <?php if (isset($_POST['register']) && !$f_surname) echo "<span>El campo Apellidos no puede estar vacío!</span>"; ?>            
            </p>
            <p>Dirección: <input type="text" name="address" value="<?php if ($f_address) echo $_POST['address']; ?>">
            <!-- Error -->
            <?php if (isset($_POST['register']) && !$f_address) echo "<span>El campo Dirección no puede estar vacío!</span>"; ?>            
            </p>
            <p>Localidad: <input type="text" name="city" value="<?php if ($f_city) echo $_POST['city']; ?>">
            <!-- Error -->
            <?php if (isset($_POST['register']) && !$f_city) echo "<span>El campo Localidad no puede estar vacío!</span>"; ?>                        
            </p>
            <p>Usuario: <input type="text" name="user" value="<?php if ($f_user) echo $_POST['user']; ?>">
            <!-- Error -->
            <?php if (isset($_POST['register']) && !$f_user) echo "<span>El campo Usuario no puede estar vacío!</span>"; ?>                        
            </p>
            <p>Clave: <input type="password" name="pwd">
            <!-- Error -->
            <?php if (isset($_POST['register']) && !$f_pwd) echo "<span>El campo Clave no puede estar vacío!</span>"; ?>                        
            </p>
            <p>Repetir clave: <input type="password" name="rep_pwd">
            <!-- Error -->
            <?php
            if (isset($_POST['register']) && !$f_rep_pwd) echo "<span>El campo Repetir clave no puede estar vacío!</span>";
            else if (isset($_POST['register']) && !$f_same_pwd) echo "<span>Las claves introducidas NO coinciden!</span>";
            ?>                        
            </p>
            <!-- Color Letra Selector -->
            <p>Color de letra:
                <select name="letter_color">
                    <option value="white" <?php if ($f_letter_color && $_POST['letter_color']==="white") echo "selected"; ?>>White</option>
                    <option value="black" <?php if ($f_letter_color && $_POST['letter_color']==="black") echo "selected"; ?>>Black</option>
                    <option value="blue" <?php if ($f_letter_color && $_POST['letter_color']==="blue") echo "selected"; ?>>Blue</option>
                    <option value="red" <?php if ($f_letter_color && $_POST['letter_color']==="red") echo "selected"; ?>>Red</option>
                </select>
            <!-- Error -->
            <?php if (isset($_POST['register']) && !$f_letter_color) echo "<span>Seleccione un color de letra!</span>"; ?>
            </p>
            <!-- Color Fondo Selector -->
            <p>Color de fondo:
                <select name="bg_color">
                    <option value="black" <?php if ($f_bg_color && $_POST['bg_color']==="black") echo "selected"; ?>>Black</option>
                    <option value="white" <?php if ($f_bg_color && $_POST['bg_color']==="white") echo "selected"; ?>>White</option>
                    <option value="yellow" <?php if ($f_bg_color && $_POST['bg_color']==="yellow") echo "selected"; ?>>Yellow</option>
                    <option value="green" <?php if ($f_bg_color && $_POST['bg_color']==="green") echo "selected"; ?>>Green</option>
                </select>
            <!-- Error -->
            <?php if (isset($_POST['register']) && !$f_bg_color) echo "<span>Seleccione un color de fondo!</span>"; ?>                
            </p>
            <!-- Tipo Letra Selector -->
            <p>Tipo de letra:
                <select name="font_family">
                    <option value="Times New Roman" <?php if ($f_font_family && $_POST['font_family']==="Times New Roman") echo "selected"; ?>>Times New Roman</option>
                    <option value="Verdana" <?php if ($f_font_family && $_POST['font_family']==="Verdana") echo "selected"; ?>>Verdana</option>
                    <option value="Roboto" <?php if ($f_font_family && $_POST['font_family']==="Roboto") echo "selected"; ?>>Roboto</option>
                    <option value="Maven Pro" <?php if ($f_font_family && $_POST['font_family']==="Maven Pro") echo "selected"; ?>>Maven Pro</option>
                </select>
            <!-- Error -->
            <?php if (isset($_POST['register']) && !$f_font_family) echo "<span>Seleccione un tipo de letra!</span>"; ?>                
            </p>
            <!-- Tamaño Letra Selector -->
            <p>Tamaño de letra:
                <select name="font_size">
                    <option value="16" <?php if ($f_font_size && $_POST['font_size']=="16") echo "selected"; ?>>16px</option>
                    <option value="20" <?php if ($f_font_size && $_POST['font_size']=="20") echo "selected"; ?>>20px</option>
                    <option value="22" <?php if ($f_font_size && $_POST['font_size']=="22") echo "selected"; ?>>22px</option>
                    <option value="24" <?php if ($f_font_size && $_POST['font_size']=="24") echo "selected"; ?>>24px</option>
                </select>
            <!-- Error -->
            <?php if (isset($_POST['register']) && !$f_font_size) echo "<span>Seleccione un tamaño de letra!</span>"; ?>                                
            </p>
            <input type="submit" name="register" value="Registrar">
            <input type="submit" name="cancel" value="Cancelar">
        </form>
    </body>
</html>
