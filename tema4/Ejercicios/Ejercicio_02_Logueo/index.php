<?php
// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID'])) session_start ();

// Si existe una sesión Credenciales, redirigimos a inicio.php
if (isset($_SESSION['credenciales'])) {
    header("Location:inicio.php");
    exit();
}

// Creamos una cookie para los intentos.
if (!isset($_COOKIE['intentos'])) setcookie("intentos", "3");

// Si el valor de la cookie Intentos es igual a 0, redirigimos.
if (isset($_COOKIE['intentos']) && $_COOKIE['intentos'] == 0) {
    // Realizamos una redirección.
    header("Location:intentos.php");
    exit();
}

// Banderas de validación.
$f_user=false; $f_pwd=false; $f_main=false;
// Bandera error credenciales.
$errorLogin=false;

// Si pulsamos sobre el botón Entrar.
if (isset($_POST['login'])) {
    // Validación de campos.
    if (!empty($_POST['user'])) $f_user=true;
    if (!empty($_POST['pwd'])) $f_pwd=true;
    if ($f_user && $f_pwd) $f_main=true;
    
    // Si todas las validaciones están correctas, procedemos a consultar.
    if ($f_main) {
        // Conexión a la BD.
        try {
            $conex = new PDO("mysql:host=localhost;dbname=tema4_logueo;charset=utf8mb4;", "dwes", "abc123.");
        } catch (PDOException $ex) {
            die($ex->errorInfo[1]." => ".$ex->errorInfo[2]);
        }

        // Realizamos consulta para comprobar credenciales.
        try {
            $stmt = $conex->prepare("SELECT * FROM perfil_usuario WHERE user=?");
            $stmt->bindParam(1, $_POST['user']);
            if ($stmt->execute()) {
                // Obtenemos el registro como un objeto.
                $registro = $stmt->fetchObject();
                // Comprobamos si las claves coinciden. Para ello,
                // desencriptamos la clave del registro.
                if (password_verify($_POST['pwd'], $registro->pass)) {
                    /* Ajustamos la configuración de PHP para definir el tiempo máximo de vida de los
                     * datos de la sesión en el servidor.
                     * 
                     * gc_maxlifetime (garbage collection max lifetime) indica cuánto tiempo (en segundos)
                     * deben mantenerse las sesiones inactivas antes de ser eliminadas.
                     */
                    ini_set("session.gc_maxlifetime", 1800);
                    // Establece un tiempo de expiración de 1800 segundos para la cookie de sesión.
                    session_set_cookie_params(1800);                    
                    // Creamos una sesión para conservar los datos necesarios.
                    session_start();
                    // En caso de autenticación, guardamos toda la información
                    // del registro (datos del usuario) en la sesión actual.
                    $_SESSION['credenciales'] = $registro;
                    // Eliminamos la cookie de intentos.
                    setcookie("intentos","",time()-3600);
                    // Realizamos una redirección.
                    header("Location:inicio.php");
                    exit();
                } else {
                    $errorLogin = true;
                }
            } else {
                $errorLogin = true;
            }
            // Mensaje de error de credenciales y comprobación de intentos.
            if ($errorLogin) {
                // Mensaje de error.
                $msg = "<br><br><span style='color:red'>USUARIO O CLAVE INCORRECTA!</span>";
                // Restamos un intento a la cookie Intentos.
                $valor_actual = $_COOKIE['intentos'] - 1;
                // Comprobamos el número de intentos.
                if ($valor_actual <= 0) {
                    setcookie("intentos", "0", time()+30);
                    // Realizamos una redirección.
                    header("Location:intentos.php");
                    exit();
                } else {
                    setcookie("intentos", $valor_actual);
                    // Mensaje de intentos.
                    $msg_intentos = "<span style='font-weight:bold'>Te quedan $valor_actual intentos!</span>";
                }
            }
        } catch (PDOException $ex) {
            echo $ex->errorInfo[1]." => ".$ex->errorInfo[2];
        }        
    }
}
?>

<html>
    <head>
        <title>Ejercicio 02: Logueo - Index</title>
    </head>
    <body>
        <h1>Iniciar Sesión</h1>
        <!-- Mostramos el mensaje de intentos -->
        <?php if (isset($_POST['login']) && isset($msg_intentos)) echo $msg_intentos; ?>
        <form action="" method="POST">
            <p>Usuario: <input type="text" name="user" value="<?php if ($f_user) echo $_POST['user']; ?>">
            <!-- Error -->
            <?php if (isset($_POST['login']) && !$f_user) echo "<span style='color:red'>El usuario no puede estar vacío!</span>"; ?>
            </p>
            <p>Clave: <input type="password" name="pwd" value="<?php if ($f_pwd) echo $_POST['pwd']; ?>">
            <!-- Error -->
            <?php if (isset($_POST['login']) && !$f_pwd) echo "<span style='color:red'>La clave no puede estar vacía!</span>"; ?>            
            </p>
            <input type="submit" name="login" value="Entrar">
        </form>
        <a href="registro.php"><input type="button" value="Registro"></a>
        <!-- Mostramos el mensaje de error -->
        <?php if (isset($_POST['login']) && isset($msg)) echo $msg; ?>
    </body>
</html>
