<html>
    <head>
        <title>Formulario Completo Matricula</title>
    </head>
    <body>
        
        <?php
        
            if (isset($_POST['next1'])) {
                
                ?>
                
                    <h1>Formulario Matricula</h1>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <p>Nº matrícula: <input type="text" name="matricula"></p>
                        <p>Curso:
                            <select name="curso">
                                <option value="blank" disabled selected>Seleccione un curso</option>
                                <option value="1º ESO">1º ESO</option>
                                <option value="2º ESO">2º ESO</option>
                                <option value="3º ESO">3º ESO</option>
                                <option value="4º ESO">4º ESO</option>
                            </select>
                        </p>
                        <p>Precio: <input type="number" name="precio"> €</p>

                        <!-- Para poder conservar los datos del formulario personal.php,
                        debemos pasar dichos valores a través de un elemento oculto (hidden).
                        Estos elementos no aparecen en el formulario.-->
                        <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
                        <input type="hidden" name="surname" value="<?php echo $_POST['surname']; ?>">

                        <input type="submit" name="next2" value="Siguiente">
                    </form>
        
                <?php
            }
        
            else if (isset($_POST['next2'])) {
                
                ?>
                <h1>Confirmación de Matrícula</h1>
                <?php
                    echo "<p>Nombre: ".$_POST['name']."</p>";
                    echo "<p>Apellidos: ".$_POST['surname']."</p>";
                    echo "<p>Nº matricula: ".$_POST['matricula']."</p>";
                    echo "<p>Curso: ".$_POST['curso']."</p>";
                    echo "<p>Precio: ".$_POST['precio']."</p>";
                    echo "<a href = 'todoEnUno.php'>Volver a Inicio</a>";
            } else {
                
                ?>
                
                <h1>Formulario Personal</h1>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <p>Nombre: <input type="text" name="name"></p>
                    <p>Apellidos: <input type="text" name="surname"></p>
                    <input type="submit" name="next1" value="Siguiente">
                </form>
                
                <?php
            }
            
        ?>

    </body>
</html>