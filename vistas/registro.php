<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
    <script src="../public/js/validaciones.js"></script>
</head>
<body>
    <h1>Registro</h1>
    <form id="registroForm" action="procesar_registro.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required>
        <br>
        <label for="cedula">Cédula:</label>
        <input type="text" id="cedula" name="cedula" required>
        <br>
        <label for="correo_electronico">Correo Electrónico:</label>
        <input type="email" id="correo_electronico" name="correo_electronico" required>
        <br>
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>
        <label for="rol">Rol:</label>
        <select id="rol" name="id_rol" required>
            <option value="1">Arrendador</option>
            <option value="2">Arrendatario</option>
            
        </select>
        <br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>