<html>
    <head>
        <title>Campos Multivaluados (BD - empleados)</title>
    </head>
    <body>
        <form action="" method="POST">
            <p>DNI: <input type="text" name="dni"></p>
            <p>Nombre: <input type="text" name="nombre"></p>
            <p>Apellidos: <input type="text" name="apellidos"></p>
            <p>Salario: <input type="number" name="salario"></p>
            <p>Usuario: <input type="text" name="usuario"></p>
            <p>Password: <input type="text" name="password"></p>
            <p>Idiomas: 
                <input type="checkbox" name="idiomas[]" value="1"><label>Español</label>
                <input type="checkbox" name="idiomas[]" value="2"><label>Inglés</label>
                <input type="checkbox" name="idiomas[]" value="4"><label>Francés</label>
                <input type="checkbox" name="idiomas[]" value="8"><label>Alemán</label>
                <input type="checkbox" name="idiomas[]" value="16"><label>Chino</label>
            </p>
            <p>Estudios:
                <select name="estudios[]" multiple=""> 
                    <option value="ESO">ESO</option>
                    <option value="Bachillerato">Bachillerato</option>
                    <option value="CFGM">CFGM</option>
                    <option value="CFGS">CFGS</option>
                </select>
            </p>
            <input type="submit" name="guardar" value="Guardar">
            <input type="submit" name="recuperar" value="Recuperar">
        </form>
    </body>
</html>

<?php
    if (isset($_POST['guardar'])) {
        try {
            $conex = new mysqli("localhost","dwes","abc123.","empleados");
            $conex->set_charset("utf8mb4");
            
            // Inicializamos la variable a 0.
            $idiomas=0;
            foreach ($_POST['idiomas'] as $value) {
                $idiomas += $value;
            }
            // Sacamos los elementos del array en un string separados por guiones.
            $estudios = implode("-", $_POST['estudios']);
            // Realizamos la consulta.
            $conex->query(
                    "INSERT INTO marketing VALUES ('$_POST[dni]','$_POST[nombre]','$_POST[apellidos]',"
                    . "$_POST[salario],'$_POST[usuario]','$_POST[password]','$idiomas','$estudios')");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        echo "<br>Registro insertado correctamente";
        $conex->close();
    }
    
    if (isset($_POST['recuperar'])) {
        try {
            $conex = new mysqli("localhost","dwes","abc123.","empleados");
            $conex->set_charset("utf8mb4");
            $result = $conex->query("SELECT * FROM marketing");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        
        if ($result->num_rows) {
            while ($fila = $result->fetch_object()) {
                echo "<p>Nombre: ".$fila->Nombre."</p>";
                echo "<p>Apellidos: ".$fila->Apellidos."</p>";
                echo "<p>Idiomas: ".$fila->idiomas."</p>";
                echo "<p>Estudios: ".$fila->estudios."</p>";
                echo "<====================================>";
            }
        }
    }
?>
