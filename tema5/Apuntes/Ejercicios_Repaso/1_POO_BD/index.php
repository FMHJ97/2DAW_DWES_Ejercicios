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
        </form>
    </body>
</html>

<?php
// Importamos la clase Producto.
require_once './Producto.php';

//$p1 = new Producto("camisa01", "Camisa manga larga", 25);
//echo $p1."<br>";
//
//$p2 = new Producto();
//$p2->nuevoProducto("pantalon01", "Pantalón vaquero", 30);
//echo $p2."<br>";

if (isset($_POST['insertar'])) {
    // Vamos a crear un producto con los datos del formulario.
    $p = new Producto($_POST['codigo'], $_POST['nombre'], $_POST['precio']);
    // Insertamos el producto en la BD. Devolverá un int.
    if ($p->insertarProducto()) {
        echo "Se ha insertado el producto correctamente!";
    } else {
        echo "NO se ha insertado el producto!<br>";
    }
}

?>