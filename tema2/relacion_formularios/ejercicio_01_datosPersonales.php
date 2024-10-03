<html>
    <head>
        <title>Ejercicio 01 - Datos Personales</title>
    </head>
    <body>
        
        <?php
            // Validation flags.
            $f_name = false; $f_surname = false; $f_sex = false; $f_age = false;
            $f_status = false; $f_hobby = false; $f_studies = false; $main_flag = false;
            
            // Data validation.
            if (isset($_POST['send'])) {
                
                if (!empty($_POST['name'])) $f_name = true;
                if (!empty($_POST['surname'])) $f_surname = true;
                if (isset($_POST['sex'])) $f_sex = true;
                if (($_POST['age']) >= 18) $f_age = true;
                if (isset($_POST['status']) && $_POST['status'] != "blank") $f_status = true;
                if (isset($_POST['hobby'])) $f_hobby = true;
                if (isset($_POST['studies'])) $f_studies = true;
                
                if ($f_name && $f_surname && $f_sex && $f_age && $f_status && $f_hobby && $f_studies) {
                    $main_flag = true;
                }
            }
            
            // If Form submited and all data validated, process data.
            if (isset($_POST['send']) && $main_flag) {
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
                echo "<br><a href='ejercicio_01_datosPersonales.php'>Realizar otro formulario</a>";
            // Show Form with errors while keeping the validated data.
            // At the start, the form will be launched empty.
            } else {
                ?>
        
                <h1>Formulario Datos Personales</h1>

                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <p>Nombre: <input type="text" name="name"
                                      value="<?php if ($f_name) echo $_POST['name']; ?>">
                        <!-- Show Error -->
                        <?php if (isset($_POST['send']) && !$f_name) echo "<span style='color:red'>Nombre no puede estar vacío</span>"; ?>
                    </p>
                    
                    <p>Apellidos: <input type="text" name="surname"
                                         value="<?php if ($f_surname) echo $_POST['surname']; ?>">
                        <!-- Show Error -->
                        <?php if (isset($_POST['send']) && !$f_surname) echo "<span style='color:red'>Apellidos no puede estar vacío</span>"; ?>
                    </p>
                    
                    <p>Sexo:
                        <input type="radio" name="sex" value="hombre"
                            <?php if ($f_sex && $_POST['sex'] === "hombre") echo "checked"; ?>><label>Hombre</label>
                        <input type="radio" name="sex" value="mujer"
                            <?php if ($f_sex && $_POST['sex'] === "mujer") echo "checked"; ?>><label>Mujer</label>
                        <!-- Show Error -->
                        <?php if (isset($_POST['send']) && !$f_sex) echo "<span style='color:red'>Sexo no puede estar vacío</span>"; ?>
                    </p>
                    
                    <p>Edad: <input type="number" name="age"
                                    value="<?php if ($f_age) echo $_POST['age']; ?>">
                        <!-- Show Error -->
                        <?php if (isset($_POST['send']) && !$f_age) echo "<span style='color:red'>Edad debe ser mayor o igual que 18</span>"; ?>
                    </p>
                    
                    <!-- Selección simple -->
                    <p>Estado civil:
                        <select name="status">
                            <option value="blank" disabled selected>Seleccione un estado</option>
                            <option value="soltero"
                                    <?php if ($f_status && $_POST['status'] === "soltero") echo "selected"; ?>>Soltero</option>
                            <option value="casado"
                                    <?php if ($f_status && $_POST['status'] === "casado") echo "selected"; ?>>Casado</option>
                            <option value="divorciado"
                                    <?php if ($f_status && $_POST['status'] === "divorciado") echo "selected"; ?>>Divorciado</option>
                            <option value="pareja"
                                    <?php if ($f_status && $_POST['status'] === "pareja") echo "selected"; ?>>Pareja de hecho</option>
                        </select>
                        <!-- Show Error -->
                        <?php if (isset($_POST['send']) && !$f_status) echo "<span style='color:red'>Debe seleccionar un estado civil</span>"; ?>
                    </p>
                    
                    <p>Aficiones:
                        <input type="checkbox" name="hobby[]" value="cine"
                               <?php if ($f_hobby && in_array("cine", $_POST['hobby'])) echo "checked"; ?>><label>Cine</label>
                        <input type="checkbox" name="hobby[]" value="lectura"
                               <?php if ($f_hobby && in_array("lectura", $_POST['hobby'])) echo "checked"; ?>><label>Lectura</label>
                        <input type="checkbox" name="hobby[]" value="tv"
                               <?php if ($f_hobby && in_array("tv", $_POST['hobby'])) echo "checked"; ?>><label>TV</label>
                        <input type="checkbox" name="hobby[]" value="deporte"
                               <?php if ($f_hobby && in_array("deporte", $_POST['hobby'])) echo "checked"; ?>><label>Deporte</label>
                        <input type="checkbox" name="hobby[]" value="musica"
                               <?php if ($f_hobby && in_array("musica", $_POST['hobby'])) echo "checked"; ?>><label>Música</label>
                        <!-- Show Error -->
                        <?php if (isset($_POST['send']) && !$f_hobby) echo "<span style='color:red'>Seleccione una afición (min. 1)</span>"; ?>
                    </p>
                    
                    <!-- Selección múltiple -->
                    <p>Estudios:
                        <select name="studies[]" multiple>
                            <option value="eso"
                                    <?php if ($f_studies && in_array("eso", $_POST['studies'])) echo "selected"; ?>>ESO</option>
                            <option value="bachillerato"
                                    <?php if ($f_studies && in_array("bachillerato", $_POST['studies'])) echo "selected"; ?>>Bachillerato</option>
                            <option value="cfgm"
                                    <?php if ($f_studies && in_array("cfgm", $_POST['studies'])) echo "selected"; ?>>CFGM</option>
                            <option value="cfgs"
                                    <?php if ($f_studies && in_array("cfgs", $_POST['studies'])) echo "selected"; ?>>CFGS</option>
                            <option value="universidad"
                                    <?php if ($f_studies && in_array("universidad", $_POST['studies'])) echo "selected"; ?>>Universidad</option>
                        </select>
                        <!-- Show Error -->
                        <?php if (isset($_POST['send']) && !$f_studies) echo "<span style='color:red'>Seleccione unos estudios (min. 1)</span>"; ?>
                    </p>
                    <input type="submit" name="send" value="Enviar">
                </form>  
                
                <?php
            }
        ?>

    </body>
</html>

