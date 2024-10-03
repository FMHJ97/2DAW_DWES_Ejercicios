<html>
    <head>
        <title>Ejercicio 01 - Datos Personales</title>
    </head>
    <body>
        
        <?php
            // Validation flags.
            $f_name = false; $f_surname = false; $f_sex = false; $f_age = false;
            $f_status = false; $_hobby = false; $_studies = false; $main_flag = false;
            
            // Data validation.
            if (isset($_POST['enviar'])) {
                
                if (!empty($_POST['name'])) $f_name = true;
                if (!empty($_POST['surname'])) $f_surname = true;
                if (isset($_POST['sex'])) $f_sex = true;
                if (($_POST['age']) >= 18) $f_age = true;
                if (isset($_POST['status'])) $f_status = true;
                if (isset($_POST['hobby'])) $_hobby = true;
                if (isset($_POST['studies'])) $_studies = true;
                
                if ($f_name && $f_surname && $f_sex && $f_age && $f_status && $_hobby && $_studies) {
                    $main_flag = true;
                }
            }
            
            // Form submited and all data validated, process data.
            if (isset($_POST['enviar']) && $main_flag) {
                echo "Nombre y apellidos: ".$_POST['name']." ".$_POST['surname']."<br>";
                echo "Sexo: ".$_POST['sex']."<br>";
                echo "Edad: ".$_POST['age']." años<br>";
                echo "Estado civil: ".$_POST['status']."<br>";
                echo "Aficiones: ";
                foreach ($_POST['hobby'] as $value) {
                    echo $value." ";
                }
                echo "<br>Estudios: ";
                foreach ($_POST['studies'] as $value) {
                    echo $value." ";
                }  
            } else {
                ?>
        
                <h1>Formulario Datos Personales</h1>

                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <p>Nombre: <input type="text" name="name"></p>
                    <p>Apellidos: <input type="text" name="surname"></p>
                    <p>Sexo: <input type="radio" name="sex" value="hombre"><label>Hombre</label>
                        <input type="radio" name="sex" value="mujer"><label>Mujer</label>
                    </p>
                    <p>Edad: <input type="number" name="age"></p>
                    <!-- Selección simple -->
                    <p>Estado civil:
                        <select name="status">
                            <option value="blank">Seleccione un estado</option>
                            <option value="soltero">Soltero</option>
                            <option value="casado">Casado</option>
                            <option value="divorciado">Divorciado</option>
                            <option value="pareja">Pareja de hecho</option>
                        </select>
                    </p>
                    <p>Aficiones:
                        <input type="checkbox" name="hobby[]" value="cine"><label>Cine</label>
                        <input type="checkbox" name="hobby[]" value="lectura"><label>Lectura</label>
                        <input type="checkbox" name="hobby[]" value="tv"><label>TV</label>
                        <input type="checkbox" name="hobby[]" value="deporte"><label>Deporte</label>
                        <input type="checkbox" name="hobby[]" value="musica"><label>Música</label>
                    </p>
                    <!-- Selección múltiple -->
                    <p>Estudios:
                        <select name="studies[]" multiple>
                            <option value="eso">ESO</option>
                            <option value="bachi">Bachillerato</option>
                            <option value="cfgm">CFGM</option>
                            <option value="cfgs">CFGS</option>
                            <option value="univ">Universidad</option>
                        </select>
                    </p>
                    <input type="submit" name="enviar" value="Enviar">
                </form>  
                
                <?php
            }
        ?>

    </body>
</html>

