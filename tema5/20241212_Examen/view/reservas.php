<?php
// Importamos
require_once '../model/agencia.php';
require_once '../model/billete.php';
require_once '../model/tren.php';
require_once '../controller/controllerCliente.php';
require_once '../controller/controllerBillete.php';
require_once '../controller/controllerTren.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID']))
    session_start();

// Si existe sesión de la Agencia, obtenemos los datos correspondientes.
if (isset($_SESSION['logueado'])) {
    $agencia = $_SESSION['logueado'];
} else {
    header("Location:index.php");
    exit();
}

if (isset($agencia) && isset($_POST['logout'])) {
    // Cerramos la sesión actual.
    session_unset();
    session_destroy();
    setcookie("PHPSESSID", "", time() - 3600, "/"); // Eliminación en el cliente.
    // Volvemos a cargar la página.
    header("Location:index.php");
    exit();
}

if (isset($_POST['buscar'])) {
    // Si los campos de texto NO ESTÁN vacíos.
    if (!empty($_POST['dni'])) {
        // Bandera para mostrar el resto del formulario.
        $mostrar_form = true;

        // Realizamos la consulta.
        $cliente = ControllerCliente::findById($_POST['dni']);
        // Comprobamos si existe.
        if ($cliente && $cliente != null) {
            //Bandera.
            $mostrar_tabla = true;
        } else {
            // Mensaje de error.
            $msg2 = "<span style='color:red'>No se encuentra el cliente con DNI(), debe añadir sus datos!</span>";
        }
    } else {
        // Mensaje de error.
        $msg1 = "<span style='color:red'>Introduzca un DNI válido!</span>";
    }
}

// Si pulsamos sobre Anular en un registro.
if (isset($_POST['anular'])) {

    // Procedemos a eliminar el registro.
    if (ControllerBillete::delete($_POST['dni'], $_POST['recorrido'], $_POST['hora'], $_POST['agencia'], $_POST['fecha'])) {
        // Mostramos mensaje de éxito.
        $msg_exito = "<span style='color:green'>Reserva anulada!</span>";
    }
}

if (isset($_POST['reservar'])) {

    // Creamos objeto Cliente.
    $c = new Cliente($_POST['dni'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono']);

    // Realizamos inserción.
    ControllerCliente::insert($c);

    // Comprobaciones.
    if (!empty($_FILES['image']) && $_FILES['image']['size'] > 0) {

        $dni = $_POST['dni'];

        if (is_uploaded_file($_FILES['imagen']['tmp_name'])
                && $_FILES['imagen']['type'] !== ".jpg") {
            // Nombre del fichero.
            $fichero = time() . "_" . $_FILES['imagen'][$dni];
            // Si queremos guardar la ruta completa del fichero en la BD.
            $ruta = "tarjetas/" . $fichero;
        }
    }
}

// Obtenemos todos los recorridos.
$recorridos = ControllerTren::getAllRecorridos();

// Obtenemos todas las horas.
$horas = ControllerTren::getAllHoras();
?>

<html>
    <head>
        <title>Examen DWES - Trenes (Reservas)</title>
        <style>
            table {
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <h1>Reservas</h1>
        <p>Agencia: <?php echo isset($agencia) ? $agencia->nombre : ""; ?></p>
        <p>Teléfono: <?php echo isset($agencia) ? $agencia->telf : ""; ?></p>
        <a href="menu.php">Volver</a><br>
        <form action="" method="POST">
            <button type="submit" name="logout">Cerrar sesión</button>
        </form>
        <div>
            <br>
            <form action="" method="POST">
                <label for="dni">DNI cliente:</label>
                <input type="text" name="dni" id="dni">
                <button type="submit" name="buscar">Buscar</button>
            </form>

            <?php
            // Mostramos el mensaje de error.
            if (isset($_POST['buscar']) && isset($msg1))
                echo $msg1;

            // Mostramos el mensaje de éxito (anulación).
            if (isset($_POST['anular']) && isset($msg_exito))
                echo $msg_exito;
            ?>
        </div>

        <?php
        // Mostramos la tabla con las reservas del cliente.
        if (isset($_POST['buscar']) && isset($mostrar_tabla)) {

            // Bandera para mostrar los datos del cliente.
            $datos_cliente = true;

            echo "<p><strong>El cliente $cliente->nombre $cliente->apellidos tienes las siguientes reservas:</strong></p>";

            // Obtenemos todas los billetes del cliente.
            $billetes = ControllerBillete::getBilletesActualesByCliente($cliente->dni, $agencia->nombre);

            // Creamos la tabla.
            echo "<table>";
            echo "<thead>";
            echo "<th>Recorrido</th>";
            echo "<th>Fecha</th>";
            echo "<th>Hora</th>";
            echo "<th>Tipo billete</th>";
            echo "<th>Precio</th>";
            echo "<th></th>";
            echo "</thead>";
            echo "<tbody>";

            if ($billetes && $billetes != null) {
                // Insertamos los billetes obtenidos.
                foreach ($billetes as $billete) {
                    echo "<tr>";
                    echo "<td>$billete->recorrido</td>";
                    echo "<td>$billete->fecha</td>";
                    echo "<td>$billete->hora</td>";
                    echo "<td>$billete->tipo</td>";
                    echo "<td>$billete->precio</td>";
                    echo "<td>";
                    echo "<form action='' method='POST'>";
                    echo "<input type='hidden' name='dni' value='$billete->dni'>";
                    echo "<input type='hidden' name='recorrido' value='$billete->recorrido'>";
                    echo "<input type='hidden' name='hora' value='$billete->hora'>";
                    echo "<input type='hidden' name='agencia' value='$billete->agencia'>";
                    echo "<input type='hidden' name='fecha' value='$billete->fecha'>";
                    echo "<button type='submit' name='anular'>Anular</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            }

            echo "</tbody>";
            echo "</table>";
        }

        if (isset($_POST['buscar']) && isset($mostrar_form)) {

            // Mostramos mensaje en caso de no encontrar cliente.
            if (isset($msg2))
                echo $msg2;
            // mostramos formulario.
            ?>
            <h2>Datos Personales</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="dni">DNI:</label>
                <input type="text" name="dni" id="dni" <?php if (isset($mostrar_tabla)) echo "readonly=''"; ?> value="<?php echo isset($datos_cliente) ? $cliente->dni : ""; ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required="" value="<?php echo isset($datos_cliente) ? $cliente->nombre : ""; ?>">
                <br>
                <label for="telef">Teléfono:</label>
                <input type="text" name="telefono" id="telef" required="" value="<?php echo isset($datos_cliente) ? $cliente->telf : ""; ?>">
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" required="" value="<?php echo isset($datos_cliente) ? $cliente->apellidos : ""; ?>">

                <h2>Reserva</h2>
                <label for="recorrido">Recorrido:</label>
                <select id="recorrido" name="recorrido">
                    <?php
                    // Agregamos los recorridos al select.
                    foreach ($recorridos as $reco) {
                        echo "<option value='$reco'>$reco</option>";
                    }
                    ?>
                </select>
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="fecha">
                <label for="horas">Horas:</label>
                <select id="horas" name="horas">
                    <?php
                    // Agregamos las horas al select.
                    foreach ($horas as $hora) {
                        echo "<option value='$hora'>$hora</option>";
                    }
                    ?>
                </select>
                <br>
                <label for="imagen">Tarjeta de crédito:</label>
                <input type="file" name="imagen" id="imagen"">
                <br>
                <label for="billete">Tipo de billete:</label>
                <select id="billete" name="billete">
                    <option value="Tourist Class">Tourist Class</option>
                    <option value="Premium Class">Premium Class</option>
                    <option value="Business Class">Business Class</option>
                    <option value="First Class">First Class</option>
                </select>
                <br>
                <button type="submit" name="reservar">Reservar</button>
            </form>
            <?php
        }
        ?>
    </body>
</html>
