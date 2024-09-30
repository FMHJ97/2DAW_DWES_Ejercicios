<?php

//    echo $_POST['nombre']." - ".$_POST['apellido'];
//    echo "<br>";
//    echo $_POST['modulos'][0];
    
//    echo $_GET['nombre']." - ".$_GET['apellido'];
    
    # Muestra los valores independientemente del método.
    echo $_REQUEST['nombre']." - ".$_REQUEST['apellido']."<br>";
    
    # Si seleccionamos varios checkbox, debemos recorrer el array.
    foreach ($_POST['modulos'] as $value) {
        echo $value."<br>";
    }    

?>