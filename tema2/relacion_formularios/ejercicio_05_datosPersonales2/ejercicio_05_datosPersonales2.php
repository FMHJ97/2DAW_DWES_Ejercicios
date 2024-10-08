<html>
    <head>
        <title>Ejercicio 05 - Datos Personales 2</title>
    </head>
    <body>
        
        <?php
        
            if (isset($_POST['next1'])) {
                ?>
                <h1>Formulario Datos Personales (2ª Parte)</h1>
                <form action="" method="post">
                    <p>Sexo: 
                        <input type="radio" name="sex" value="Hombre"><label>Hombre</label>
                        <input type="radio" name="sex" value="Mujer"><label>Mujer</label>
                    </p>
                    <p>Edad: <input type="number" name="age"></p>
                    <p>Estado Civil: 
                        <select name="status">
                            <option value="blank" selected disabled>Seleccione un estado civil</option>
                            <option value="Soltero">Soltero</option>
                            <option value="Casado">Casado</option>
                            <option value="Divorciado">Divorciado</option>
                            <option value="Pareja de hecho">Pareja de hecho</option>
                        </select>
                    </p>
                    <input type="submit" name="next2" value="Siguiente">                    
                    <!-- Arrastramos los valores del formulario anterior. -->
                    <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
                    <input type="hidden" name="surname" value="<?php echo $_POST['surname']; ?>">
                    <input type="hidden" name="hobby" value="<?php echo implode(', ', $_POST['hobby']); ?>">
                    <input type="hidden" name="study" value="<?php echo implode(', ', $_POST['study']); ?>">
                </form>                
                <?php
            } elseif (isset ($_POST['next2'])) {
                echo "<h1>Comprobación de Datos</h1>";
                echo "<p>Nombre: ".$_POST['name']."</p>";
                echo "<p>Apellidos: ".$_POST['surname']."</p>";
                echo "<p>Aficiones: ".$_POST['hobby']."</p>";
                echo "<p>Estudios: ".$_POST['study']."</p>";
                echo "<p>Sexo: ".$_POST['sex']."</p>";
                echo "<p>Edad: ".$_POST['age']."</p>";
                echo "<p>Estado Civil: ".$_POST['status']."</p>";
            } else {
                ?>
                <h1>Formulario Datos Personales (1ª Parte)</h1>
                <form action="" method="post">
                    <p>Nombre: <input type="text" name="name"></p>
                    <p>Apellidos: <input type="text" name="surname"></p>
                    <p>Aficiones: 
                        <input type="checkbox" name="hobby[]" value="Cine"><label>Cine</label>
                        <input type="checkbox" name="hobby[]" value="Lectura"><label>Lectura</label>
                        <input type="checkbox" name="hobby[]" value="TV"><label>TV</label>
                        <input type="checkbox" name="hobby[]" value="Deporte"><label>Deporte</label>
                        <input type="checkbox" name="hobby[]" value="Música"><label>Música</label>
                    </p>
                    <p>Estudios: 
                        <select name="study[]" multiple>
                            <option value="blank" selected disabled>Seleccione una opción</option>
                            <option value="ESO">ESO</option>
                            <option value="Bachillerato">Bachillerato</option>
                            <option value="CFGM">CFGM</option>
                            <option value="CFGS">CFGS</option>
                            <option value="Universidad">Universidad</option>
                        </select>
                    <p>
                    <input type="submit" name="next1" value="Siguiente">
                </form>
                <?php
            }
        ?>
        
    </body>
</html>
