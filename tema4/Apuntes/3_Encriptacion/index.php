<?php
// Creamos una cadena de texto.
$cadena = "Mi cadena";
$cadena2 = "Mi cadena";
// Usaremos la encriptación MD5.
// SIEMPRE usa el mismo método de encriptación.
// Es decir, es fácil comparar dos cadenas encriptadas en MD5.
echo "<h2>Encriptación MD5</h2>";
echo md5($cadena);
echo "<br>";
echo md5($cadena2);
echo "<br><br>";
// A continuación, vamos a usar otro método de encriptación
// password_hash(). Es más seguro que MD5 porque siempre genera
// una cadena encriptada diferente.
echo "<h2>Encriptación Password_hash</h2>";
$encript = password_hash($cadena, PASSWORD_DEFAULT);
echo $encript;
echo "<br>";
$encript2 = password_hash($cadena2, PASSWORD_DEFAULT);
echo $encript2;
echo "<br><br>";

// En este caso, no podemos comparar las cadenas a diferencia
// que utilizando MD5. Para comparar las cadenas encriptadas
// podemos utilizar la función password_verify()
if (password_verify($cadena, $encript)) echo "Clave correcta!";
else echo "Clave incorrecta!";
?>