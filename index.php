<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CALIFICACIONES</title>
</head>
<body>

    <h2>Iniciar Sesión</h2>

    <form action="procesamiento_login.php" method="post">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>

        <br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <br>

        <input type="submit" value="Iniciar Sesión">
    </form>

</body>
</html>
