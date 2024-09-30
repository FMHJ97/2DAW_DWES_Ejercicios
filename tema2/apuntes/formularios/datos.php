<html>
    <head>
        <title>Formulario - Apuntes 01</title>
    </head>
    <body>
        <h1>Méthod POST</h1>
        <!-- En action, procesa.php
        Si action está en blanco, solicitud a si mismo.
        Si action es el nombre del fichero actual, solicitud a si mismo.
        Si action es <\?php echo $_SERVER['PHP_SELF']; ?>, -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            Nombre: <input type="text" name="nombre"><br>
            Apellido: <input type="text" name="apellido"><br>
            Modulos: <br>
            <!-- Cuando creemos un checkbox, el atributo name debe ser un array,
            dado que los checkbox permiten la multi-selección.-->
            <input type="checkbox" name="modulos[]" value="DWES">Desarrollo Web Entorno Servidor</input><br>
            <input type="checkbox" name="modulos[]" value="DWEC">Desarrollo Web Entorno Cliente</input><br>
            <input type="checkbox" name="modulos[]" value="HLC">Horas de Libre Configuración</input><br>
            <br><input type="submit" name="enviar" value="Enviar">
        </form>
        
        <!-- Para enviar datos a través de un enlace.
        Se enviará por GET (defecto)-->
        <a href="procesa.php?nombre=pepe&apellido=garcia">Ir a procesa</a>
        
        
        
<!--        <h1>Méthod GET</h1>        
        <form action="procesa.php" method="get">  
            Nombre: <input type="text" name="nombre"><br>
            Apellido: <input type="text" name="apellido"><br>
            <input type="submit" name="enviar" value="Enviar">
        </form>        -->
    </body>
</html>
