<html>
    <head>
        <title>Formulario - BD Objetos_bd</title>
    </head>
    <body>
        <h1>Formulario - BD Objetos_bd</h1>
        <form action="" method="POST">
            <p>Código: <input type="text" name="codigo"></p>
            <p>Nombre: <input type="text" name="nombre"></p>
            <p>Precio: <input type="text" name="precio"></p>
            <button type="submit" name="insertar">Insertar</button>
            <button type="submit" name="mostrar">Mostrar</button>
            <button type="submit" name="buscar">Buscar</button>
        </form>
    </body>
</html>

<?php

require_once '../controller/controllerProducto.php';
require_once '../model/producto.php';

if (isset($_POST['buscar'])) {
    if ($producto = ControllerProducto::buscarProducto($_POST['codigo'])) echo $producto;
    else echo "No existe un producto con dicho código en la BD!";
}

if (isset($_POST['mostrar'])) {
    if ($productos = ControllerProducto::recuperarTodos()) {
        foreach ($productos as $producto) {
            echo $producto."<br>";
        }
    } else {
        echo "No hay productos en la BD!";
    }
}

if (isset($_POST['insertar'])) {
    $producto = new Producto($_POST['codigo'], $_POST['nombre'], $_POST['precio']);
    if (ControllerProducto::insertar($producto)) echo "Registro insertado!";
}

?>