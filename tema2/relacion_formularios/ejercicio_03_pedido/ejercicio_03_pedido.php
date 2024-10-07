<html>
    <head>
        <title>Ejercicio 03 - Pedido</title>
    </head>
    <body>
        
        <?php
        
            if (isset($_POST['next1'])) {
                
                ?>
        
                <h1>Datos Pedido</h1>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <p>Dirección: <input type="text" name="address" value="<?php if (isset($_POST['cancel'])) echo $_POST['address']; ?>"></p>
                    <p>Nº de Tarjeta: <input type="text" name="numberCard" value="<?php if (isset($_POST['cancel'])) echo $_POST['numberCard']; ?>"></p>
                    <input type="submit" name="next2" value="Siguiente">
                    <!-- Datos guardados del anterior formulario -->
                    <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
                    <input type="hidden" name="surname" value="<?php echo $_POST['surname']; ?>">
                </form>

                <?php
            } else if (isset ($_POST['next2'])) {
                
                ?>
                
                <h1>Confirmación de Datos</h1>
                <?php
                    echo "<p>Nombre: ".$_POST['name']."</p>";
                    echo "<p>Apellidos: ".$_POST['surname']."</p>";
                    echo "<p>Dirección: ".$_POST['address']."</p>";
                    echo "<p>Nº de Tarjeta: ".$_POST['numberCard']."</p>";
                ?>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="submit" name="cancel" value="Cancelar">
                    <input type="submit" name="send" value="Confirmar">
                    <!-- Datos guardados del anterior formulario -->
                    <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
                    <input type="hidden" name="surname" value="<?php echo $_POST['surname']; ?>">
                    <input type="hidden" name="address" value="<?php echo $_POST['address']; ?>">
                    <input type="hidden" name="numberCard" value="<?php echo $_POST['numberCard']; ?>">
                </form>
                
                <?php
            } else {
                
                ?>
                
                <h1>Datos Personales</h1>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                    <p>Nombre: <input type="text" name="name" value="<?php if (isset($_POST['cancel'])) echo $_POST['name']; ?>"></p>
                    <p>Apellidos: <input type="text" name="surname" value="<?php if (isset($_POST['cancel'])) echo $_POST['surname']; ?>"></p>
                    <input type="submit" name="next1" value="Siguiente">
                    <!-- Datos guardados del anterior formulario -->                    
                    <input type="hidden" name="cancel" value="<?php if (isset($_POST['cancel'])) echo $_POST['cancel']; ?>">
                    <input type="hidden" name="address" value="<?php if (isset($_POST['cancel'])) echo $_POST['address']; ?>">
                    <input type="hidden" name="numberCard" value="<?php if (isset($_POST['cancel'])) echo $_POST['numberCard']; ?>">
                </form>
                
                <?php
            }
        
        ?>
        
    </body>
</html>


