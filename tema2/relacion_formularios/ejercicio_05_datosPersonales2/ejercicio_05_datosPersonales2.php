<html>
    <head>
        <title>Ejercicio 05 - Datos Personales 2</title>
    </head>
    <body>
        
        <?php
            // Validation flags.
            $f_name = false; $f_surname = false; $f_sex = false; $f_age = false;
            $f_status = false; $f_hobby = false; $f_study = false;
            $first_flag = false; $second_flag = false;
            // Bandera que nos permite permanecer en el segundo formulario.
            // Se usará cuando existan errores en dicho formulario.
            $remain_flag = false;
            
            // First Form - Validation Data.
            if (isset($_POST['next1'])) {
                if (!empty($_POST['name'])) $f_name = true;
                if (!empty($_POST['surname'])) $f_surname = true;
                if (isset($_POST['hobby'])) $f_hobby = true;
                if (isset($_POST['study'])) $f_study = true;
                // Main flag.
                if ($f_name && $f_surname && $f_hobby && $f_study) $first_flag = true;
            }
            
            // Second Form - Validation Data.
            if (isset($_POST['next2'])) {
                if (isset($_POST['sex'])) $f_sex = true;
                if (($_POST['age']) >= 18) $f_age = true;
                if (isset($_POST['status']) && $_POST['status'] != "blank") $f_status = true;
                // Main flag.
                if ($f_sex && $f_age && $f_status) $second_flag = true;
                else $remain_flag = true;
            }            

            // Formulario 2ª parte
            if (isset($_POST['next1']) && $first_flag || $remain_flag) {
                ?>
                <h1>Formulario Datos Personales (2ª Parte)</h1>
                <form action="" method="post">
                    <p>Sexo: 
                        <input type="radio" name="sex" value="Hombre" <?php if (isset($_POST['sex']) && $_POST['sex'] == 'Hombre') echo 'checked'; ?>><label>Hombre</label>
                        <input type="radio" name="sex" value="Mujer" <?php if (isset($_POST['sex']) && $_POST['sex'] == 'Mujer') echo 'checked'; ?>><label>Mujer</label>
                    <!-- Show error -->
                    <?php if (isset($_POST['next2']) && !$f_sex) echo "<span style='color:red'>Seleccione un sexo</span>"; ?>                                                 
                    </p>
                    <p>Edad: <input type="number" name="age" value="<?php echo isset($_POST['age']) ? $_POST['age'] : ''; ?>">
                    <!-- Show error -->
                    <?php if (isset($_POST['next2']) && !$f_age) echo "<span style='color:red'>Edad debe ser mayor o igual que 18</span>"; ?>                                             
                    </p>
                    <p>Estado Civil: 
                        <select name="status">
                            <option value="blank" disabled <?php if (!isset($_POST['status'])) echo 'selected'; ?>>Seleccione un estado civil</option>
                            <option value="Soltero" <?php if (isset($_POST['status']) && $_POST['status'] == 'Soltero') echo 'selected'; ?>>Soltero</option>
                            <option value="Casado" <?php if (isset($_POST['status']) && $_POST['status'] == 'Casado') echo 'selected'; ?>>Casado</option>
                            <option value="Divorciado" <?php if (isset($_POST['status']) && $_POST['status'] == 'Divorciado') echo 'selected'; ?>>Divorciado</option>
                            <option value="Pareja de hecho" <?php if (isset($_POST['status']) && $_POST['status'] == 'Pareja de hecho') echo 'selected'; ?>>Pareja de hecho</option>
                        </select>
                    <!-- Show error -->
                    <?php if (isset($_POST['next2']) && !$f_status) echo "<span style='color:red'>Seleccione un estado civil</span>"; ?>                                                
                    </p>
                    <input type="submit" name="next2" value="Siguiente">                    
                    
                    <!-- Mantén los valores del primer formulario con campos ocultos -->
                    <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
                    <input type="hidden" name="surname" value="<?php echo $_POST['surname']; ?>">

                    <!-- Mantén arrays de hobbies y estudios -->
                    <?php foreach ($_POST['hobby'] as $hobby) { ?>
                        <input type="hidden" name="hobby[]" value="<?php echo $hobby; ?>">
                    <?php } ?>

                    <?php foreach ($_POST['study'] as $study) { ?>
                        <input type="hidden" name="study[]" value="<?php echo $study; ?>">
                    <?php } ?>
                </form>                
                <?php
            } elseif (isset ($_POST['next2']) && $second_flag) {
                echo "<h1>Comprobación de Datos</h1>";
                echo "<p>Nombre: ".$_POST['name']."</p>";
                echo "<p>Apellidos: ".$_POST['surname']."</p>";
                echo "<p>Aficiones: ".implode(', ', $_POST['hobby'])."</p>";
                echo "<p>Estudios: ".implode(', ', $_POST['study'])."</p>";
                echo "<p>Sexo: ".$_POST['sex']."</p>";
                echo "<p>Edad: ".$_POST['age']."</p>";
                echo "<p>Estado Civil: ".$_POST['status']."</p>";
                echo "<a href='ejercicio_05_datosPersonales2.php'>Nuevo Formulario</a>";
            } else {
                ?>
                <h1>Formulario Datos Personales (1ª Parte)</h1>
                <form action="" method="post">
                    <p>Nombre: <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
                    <!-- Show error -->
                    <?php if (isset($_POST['next1']) && !$f_name) echo "<span style='color:red'>Nombre no puede estar vacío</span>"; ?>
                    </p>
                    <p>Apellidos: <input type="text" name="surname" value="<?php echo isset($_POST['surname']) ? $_POST['surname'] : ''; ?>">
                    <!-- Show error -->
                    <?php if (isset($_POST['next1']) && !$f_surname) echo "<span style='color:red'>Apellidos no puede estar vacío</span>"; ?>                    
                    </p>
                    <p>Aficiones: 
                        <input type="checkbox" name="hobby[]" value="Cine" <?php if (isset($_POST['hobby']) && in_array('Cine', $_POST['hobby'])) echo 'checked'; ?>><label>Cine</label>
                        <input type="checkbox" name="hobby[]" value="Lectura" <?php if (isset($_POST['hobby']) && in_array('Lectura', $_POST['hobby'])) echo 'checked'; ?>><label>Lectura</label>
                        <input type="checkbox" name="hobby[]" value="TV" <?php if (isset($_POST['hobby']) && in_array('TV', $_POST['hobby'])) echo 'checked'; ?>><label>TV</label>
                        <input type="checkbox" name="hobby[]" value="Deporte" <?php if (isset($_POST['hobby']) && in_array('Deporte', $_POST['hobby'])) echo 'checked'; ?>><label>Deporte</label>
                        <input type="checkbox" name="hobby[]" value="Música" <?php if (isset($_POST['hobby']) && in_array('Música', $_POST['hobby'])) echo 'checked'; ?>><label>Música</label>
                    <!-- Show error -->
                    <?php if (isset($_POST['next1']) && !$f_hobby) echo "<span style='color:red'>Seleccione como mínimo una afición</span>"; ?>                        
                    </p>
                    <p>Estudios: 
                        <select name="study[]" multiple>
                            <option value="ESO" <?php if (isset($_POST['study']) && in_array('ESO', $_POST['study'])) echo 'selected'; ?>>ESO</option>
                            <option value="Bachillerato" <?php if (isset($_POST['study']) && in_array('Bachillerato', $_POST['study'])) echo 'selected'; ?>>Bachillerato</option>
                            <option value="CFGM" <?php if (isset($_POST['study']) && in_array('CFGM', $_POST['study'])) echo 'selected'; ?>>CFGM</option>
                            <option value="CFGS" <?php if (isset($_POST['study']) && in_array('CFGS', $_POST['study'])) echo 'selected'; ?>>CFGS</option>
                            <option value="Universidad" <?php if (isset($_POST['study']) && in_array('Universidad', $_POST['study'])) echo 'selected'; ?>>Universidad</option>
                        </select>
                    <!-- Show error -->
                    <?php if (isset($_POST['next1']) && !$f_study) echo "<span style='color:red'>Seleccione como mínimo un curso</span>"; ?>                        
                    <p>
                    <input type="submit" name="next1" value="Siguiente">
                </form>
                <?php
            }
        ?>
        
    </body>
</html>
