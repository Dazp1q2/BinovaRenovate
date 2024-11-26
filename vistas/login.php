<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
    <script src="../public/js/validaciones.js"></script>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <?php
    if (isset($_SESSION['error_login'])) {
        echo "<div class='error'>" . $_SESSION['error_login'] . "</div>";
        unset($_SESSION['error_login']);
    }
    ?>
    <form id="loginForm" action="procesar_login.php" method="post">
        <label for="correo_electronico">Correo Electrónico:</label>
        <input type="email" id="correo_electronico" name="correo_electronico" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>
        <input type="submit" value="Iniciar Sesión">
    </form>
    <a href="registro.php">Registrarse</a>
</body>
</html>