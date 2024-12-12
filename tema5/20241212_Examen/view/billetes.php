<?php
// Importamos
require_once '../model/agencia.php';
require_once '../model/cliente.php';
require_once '../model/billete.php';
require_once '../controller/controllerTren.php';
require_once '../controller/controllerBillete.php';
require_once '../controller/controllerCliente.php';

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

// Obtenemos todos los recorridos.
$recorridos = ControllerTren::getAllRecorridos();

// Obtenemos todas las horas.
$horas = ControllerTren::getAllHoras();
?>

<html>
    <head>
        <title>Examen DWES - Trenes (Billetes)</title>
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
        <h1>Billetes reservados</h1>
        <p>Agencia: <?php echo isset($agencia) ? $agencia->nombre : ""; ?></p>
        <p>Teléfono: <?php echo isset($agencia) ? $agencia->telf : ""; ?></p>
        <a href="menu.php">Volver</a><br>
        <form action="" method="POST">
            <button type="submit" name="logout">Cerrar sesión</button>
        </form>
        <div>
            <br>
            <form action="" method="POST">
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
                <button type="submit" name="buscar">Buscar</button>
            </form>
        </div>
        <?php
        // En caso de pulsar buscar.
        if (isset($_POST['buscar'])) {
            // Obtenemos los billetes encontrados.
            $billetes = ControllerBillete::getBilletesByRecorridoFechaHora($_POST['recorrido'], $_POST['fecha'], $_POST['horas']);

            if ($billetes && $billetes != null) {
                
                // Mostramos la tabla.
                echo "<p><strong>Reservas para " . $_POST['recorrido'] . " el día " . $_POST['fecha'] . " a las " . $_POST['horas'] . ":</strong></p>";

                // Creamos la tabla.
                echo "<table>";
                echo "<thead>";
                echo "<th>DNI</th>";
                echo "<th>Nombre y apellidos</th>";
                echo "<th>Teléfono</th>";
                echo "<th>Tipo billete</th>";
                echo "<th>Precio</th>";
                echo "<th>Pago</th>";
                echo "</thead>";
                echo "<tbody>";

                if ($billetes && $billetes != null) {
                    // Insertamos los billetes obtenidos.
                    foreach ($billetes as $billete) {
                        
                        // Obtenemos al cliente correspondiente.
                        $cliente = ControllerCliente::findById($billete->dni);
                        
                        echo "<tr>";
                        echo "<td>$billete->dni</td>";
                        echo "<td>$cliente->nombre $cliente->apellidos</td>";
                        echo "<td>$cliente->telf</td>";
                        echo "<td>$billete->tipo</td>";
                        echo "<td>$billete->precio</td>";
                        echo "<td><img src='../$billete->img_tarjeta' width='100px'></td>";
                        echo "</tr>";
                    }
                }

                echo "</tbody>";
                echo "</table>";
            }
        }
        ?>
    </body>
</html>
