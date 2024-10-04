<html>
    <head>
        <title>Formulario Confirma</title>
    </head>
    <body>
        
        <h1>Confirmación de Matrícula</h1>
        <?php
            echo "<p>Nombre: ".$_POST['name']."</p>";
            echo "<p>Apellidos: ".$_POST['surname']."</p>";
            echo "<p>Nº matricula: ".$_POST['matricula']."</p>";
            echo "<p>Curso: ".$_POST['curso']."</p>";
            echo "<p>Precio: ".$_POST['precio']."</p>";
        ?>
        
    </body>
</html>
