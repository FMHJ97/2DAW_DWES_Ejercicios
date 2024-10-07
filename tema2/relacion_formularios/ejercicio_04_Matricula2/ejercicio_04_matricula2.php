<!doctype html>
<html>
    <head>
        <title>Ejercicio 04 - Matricula 2</title>
    </head>
    <body>
        
        <?php
        
            if (isset($_POST['next1'])) {
                ?>
                    <h1>Formulario Matrícula</h1>
                    <form action="" method="post">
                        <p>Nº Matrícula: <input type="text" name="matricula"></p>
                        <p>Curso: <input type="text" name="curso"></p>
                        <p>Precio: <input type="number" name="precio"></p>
                        <input type="submit" name="next2" value="Siguiente">
                        <!-- Datos guardados -->
                        <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
                        <input type="hidden" name="surname" value="<?php echo $_POST['surname']; ?>">
                        <input type="hidden" name="idiomas" value="<?php echo implode(", ", $_POST['idiomas']); ?>">
                    </form>
                <?php
            } elseif (isset ($_POST['next2'])) {
                ?>
                <h1>Comprobación de Datos</h1>
                <?php
                    //var_dump($_POST);
                    echo "<p>Nombre: ".$_POST['name']."</p>";
                    echo "<p>Apellidos: ".$_POST['surname']."</p>";
                    echo "<p>Idiomas: ".$_POST['idiomas']."</p>";
                    echo "Nº Matrícula: ".$_POST['matricula']."</p>";
                    echo "Curso: ".$_POST['curso']."</p>";
                    echo "Precio: ".$_POST['precio']."</p>";
            } else {
                ?>
                <h1>Formulario Datos Personales</h1>
                <form action="" method="post">
                    <p>Nombre: <input type="text" name="name"></p>
                    <p>Apellidos: <input type="text" name="surname"></p>
                    <p>Idiomas:<br>
                        <input type="checkbox" name="idiomas[]" value="Inglés"><label>Inglés</label><br>
                        <input type="checkbox" name="idiomas[]" value="Francés"><label>Francés</label><br>
                        <input type="checkbox" name="idiomas[]" value="Alemán"><label>Alemán</label>
                    </p>
                    <input type="submit" name="next1" value="Siguiente">
                </form>
                <?php
            }
        
        ?>      
    </body>
</html>
