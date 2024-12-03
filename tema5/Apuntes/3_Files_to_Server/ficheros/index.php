<html>
    <head>
        <title>Formulario - BD Objetos_bd</title>
    </head>
    <body>
        <h1>Formulario - BD Objetos_bd ($_FILES)</h1>
        <!-- Cada vez que un formulario suba algún fichero, debemos insertar un nuevo atributo
        en el <form>. El atributo es enctype='multipart/form-data'. Si no se especifica, no
        podrá subir ficheros. -->
        <form action="" method="POST" enctype="multipart/form-data">
            <p>Código: <input type="text" name="codigo"></p>
            <p>Nombre: <input type="text" name="nombre"></p>
            <p>Precio: <input type="text" name="precio"></p>
            <p>Imagen: <input type="file" name="imagen"></p>
            <button type="submit" name="insertar">Insertar</button>
            <button type="submit" name="mostrar">Mostrar</button>
        </form>
    </body>
</html>

<?php
if (isset($_POST['mostrar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "objetos_bd");
        $result = $conex->query("SELECT * FROM producto");
        if ($result->num_rows) {
            while ($fila = $result->fetch_object()) {
                echo "Código: ".$fila->codigo."<br>";
                echo "Nombre: ".$fila->nombre."<br>";
                echo "Precio: ".$fila->precio."<br>";
                echo "<img src='".$fila->imagen."' width='300' height='300'><br><br>";
            }
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

if (isset($_POST['insertar'])) {
    echo "Nombre: " . $_FILES['imagen']['name'] . "<br>";
    echo "Nombre temporal: " . $_FILES['imagen']['tmp_name'] . "<br>";
    echo "Tamaño: " . $_FILES['imagen']['size'] . "<br>";
    echo "Tipo: " . $_FILES['imagen']['type'] . "<br>";
    echo "Error: " . $_FILES['imagen']['error'] . "<br>";

    // Si el fichero se ha subido correctamente al servidor, nombre temporal.
    if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
        // Vamos a utilizar la fecha de subida del fichero para diferenciar entre fichero iguales.
        // Para ello, utilizamos la función time(). Si colocamos el tiempo concatenado al final
        // del nombre, sobreescribe la extesión, por lo que lo agregamos delante.
        $fich = time() . "_" . $_FILES['imagen']['name'];
        // Si queremos guardar la ruta completa del fichero en la BD.
        $ruta = "img/" . $fich;
        // Cambiamos la ubicación del fichero subido, de esta manera
        // no perderemos el fichero (puesto que es temporal; desaparece tras acabar script).
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
        // Guardamos el fichero en la base de datos.
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "objetos_bd");
            $conex->query("INSERT INTO producto VALUES ('$_POST[codigo]', '$_POST[nombre]', $_POST[precio], '$ruta')");
            $conex->close();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
?>