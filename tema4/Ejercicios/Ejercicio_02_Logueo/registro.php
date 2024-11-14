<html>
    <head>
        <title>Ejercicio 2: Logueo - Registro</title>
    </head>
    <body>
        <h1>Registro</h1>
        <form action="" method="POST">
            <p>Nombre: <input type="text" name="name"></p>
            <p>Apellidos: <input type="text" name="surname"></p>
            <p>Dirección: <input type="text" name="address"></p>
            <p>Localidad: <input type="text" name="city"></p>
            <p>Usuario: <input type="text" name="user"></p>
            <p>Clave: <input type="password" name="pwd"></p>
            <p>Repetir clave: <input type="password" name="rep_pwd"></p>
            <!-- Color Letra Selector -->
            <p>Color de letra:
                <select name="letter_color">
                    <option value="white">White</option>
                    <option value="black">Black</option>
                    <option value="blue">Blue</option>
                    <option value="red">Red</option>
                </select>
            </p>
            <!-- Color Fondo Selector -->
            <p>Color de fondo:
                <select name="bg_color">
                    <option value="black">Black</option>
                    <option value="white">White</option>
                    <option value="yellow">Yellow</option>
                    <option value="green">Green</option>
                </select>
            </p>
            <!-- Tipo Letra Selector -->
            <p>Tipo de letra:
                <select name="font_family">
                    <option value="Times New Roman">Times New Roman</option>
                    <option value="Verdana">Verdana</option>
                    <option value="Roboto">Roboto</option>
                    <option value="Maven Pro">Maven Pro</option>
                </select>
            </p>
            <!-- Tamaño Letra Selector -->
            <p>Tamaño de letra:
                <select name="font_size">
                    <option value="16">16px</option>
                    <option value="20">20px</option>
                    <option value="22">22px</option>
                    <option value="24">24px</option>
                </select>
            </p>
            <input type="submit" name="register" value="Registrar">
        </form>
        <a href="index.php"><input type="button" value="Cancelar"></a>        
    </body>
</html>
