<html>
    <head>
        <title>Principal</title>
    </head>
    <body>

        <?php
            include_once 'cabecera.php';
        ?>
        
        <p>Aquí estaría la Web</p>
        
        <?php
            require_once 'funciones.php';
            $sal = 1000;
            $com = 100;
            $ret = 2;
            echo "El salario bruto es ".salario_bruto($sal, $ret, $com)."<br>";
            echo "El salario es ".$sal."<br>";
            echo "La retención es ".$ret."<br>";
            
            echo "<br>El salario bruto es ".salario_bruto2($ret, $com)."<br>";
            // Dado que hemos usado _once, no vuelve mostrar el contenido
            // de nuevo.
            include_once 'cabecera.php';
            
            echo "<br>El salario bruto es ".salario_bruto3($sal, $ret, $com)."<br>";
            echo "El salario es ".$sal."<br>";
            echo "La retención es ".$ret;
        ?>
    </body>
</html>
