<!doctype html>

<html>
    <head>
        <title>Exercise 01</title>
    </head>
    <body>
        
        <?php
        
          $anio = 2012;
          
          if ($anio % 4 == 0) {
              if ($anio % 100 == 0) {
                  if ($anio % 400 == 0) {
                      echo "El año ".$anio." es un año bisiesto (tiene 366 días)";
                  } else {
                      echo "El año ".$anio." NO es un año bisiesto (tiene 365 días)";
                  }
              } else {
                  echo "El año ".$anio." es un año bisiesto (tiene 366 días)";
              }
          } else {
              echo "El año ".$anio." NO es un año bisiesto (tiene 365 días)";
          }
        
        ?>
        
    </body>
</html>
