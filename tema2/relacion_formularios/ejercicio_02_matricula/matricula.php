<html>
    <head>
        <title>Formulario Matricula</title>
    </head>
    <body>
        
        <h1>Formulario Matricula</h1>
        <form action="confirma.php" method="post">
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
            
            <input type="submit" name="send" value="Enviar">
        </form>
        
    </body>
</html>
