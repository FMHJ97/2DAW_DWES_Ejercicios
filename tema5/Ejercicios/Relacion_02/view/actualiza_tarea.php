<?php
require_once '../controller/conexion.php';
require_once '../controller/controllerEmpleado.php';
require_once '../controller/controllerTarea.php';
require_once '../controller/controllerRealiza.php';
require_once '../model/empleado.php';
require_once '../model/tarea.php';
require_once '../model/realiza.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID']))
    session_start();

// Si no existe sesión, redirigir a Index
if (!isset($_SESSION['logueado'])) {
    header("Location:index.php");
    exit();
} else {
    $autenticado = $_SESSION['logueado'];
    // Cargamos todas las tareas realizadas por el empleado logueado.
    $tareas = ControllerRealiza::getAllByEmpleado($autenticado->email);
}

// Si pulsamos sobre Actualizar.
if (isset($_POST['update'])) {
    if (!empty($_POST['horas'])) {
        // Realizamos la actualización.
        if (ControllerRealiza::updateRealiza($autenticado->email, $_POST['id_tarea'], $_POST['horas'])) {
            // Volvemos a cargar.
            header("Location:actualiza_tarea.php");
            exit();
        }
    }
}
?>

<html>
    <head>
        <title>Actualizar tarea (MVC - Empleados)</title>
        <style>
            table {
                border-collapse: collapse;
            }
            th,td {
                border: 1px solid black;
                padding: 0.5em;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1>Actualizar tarea</h1>
        <p>Bienvenido, <?php echo isset($autenticado)?$autenticado->nombre:""; ?></p>
        <a href="inicio.php"><button>Volver</button></a>
        <table>
            <thead>
            <th>Nombre Tarea</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Horas</th>
            <th>Acción</th>
        </thead>
        <tbody>
            <?php
            // Insertamos los posibles registros en la tabla.
            foreach ($tareas as $tarea) {
                // Obtenemos los datos de la tarea realizada.
                $t = ControllerTarea::findById($tarea->id_tarea);
                // Insertamos los datos.
                echo "<tr>";
                echo "<td>$t->nombre</td>";
                echo "<td>$t->fecha_inicio</td>";
                echo "<td>$t->fecha_fin</td>";
                echo "<form action='' method='POST'>";
                echo "<td><input type='text' name='horas' value='$tarea->horas'></td>";
                echo "<td><button type='submit' name='update'>Actualizar</button></td>";
                echo "<input type='hidden' name='id_tarea' value='$tarea->id_tarea'>";
                echo "</form>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
