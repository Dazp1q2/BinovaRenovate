<?php
include_once '../includes/menu.php';
require_once '../config/base_de_datos.php';
require_once '../controladores/ControladorUsuario.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_usuario = new ControladorUsuario($db);

$id_usuario = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $cedula = $_POST['cedula'];
    $correo_electronico = $_POST['correo_electronico'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];
    $id_rol = $_POST['id_rol'];

    $datos = array(
        'id_usuario' => $id_usuario,
        'nombre' => $nombre,
        'apellidos' => $apellidos,
        'cedula' => $cedula,
        'correo_electronico' => $correo_electronico,
        'telefono' => $telefono,
        'contrasena' => $contrasena,
        'id_rol' => $id_rol
    );

    if ($controlador_usuario->actualizarUsuario($datos)) {
        header("Location: gestionar_usuarios.php");
        exit();
    } else {
        echo "Error al actualizar el usuario.";
    }
}

if (empty($id_usuario)) {
    header("Location: gestionar_usuarios.php");
    exit();
}

$usuario = $controlador_usuario->obtenerUsuarioPorId($id_usuario);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <h1>Editar Usuario</h1>
    <form id="editarUsuarioForm" action="editar_usuario.php?id=<?php echo $id_usuario; ?>" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario->nombre); ?>" required>
        <br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($usuario->apellidos); ?>" required>
        <br>
        <label for="cedula">Cédula:</label>
        <input type="text" id="cedula" name="cedula" value="<?php echo htmlspecialchars($usuario->cedula); ?>" required>
        <br>
        <label for="correo_electronico">Correo Electrónico:</label>
        <input type="email" id="correo_electronico" name="correo_electronico" value="<?php echo htmlspecialchars($usuario->correo_electronico); ?>" required>
        <br>
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($usuario->telefono); ?>" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" placeholder="Deja en blanco para mantener la contraseña actual">
        <br>
        <label for="rol">Rol:</label>
        <select id="rol" name="id_rol" required>
            <option value="1" <?php if ($usuario->id_rol == 1) echo 'selected'; ?>>Arrendador</option>
            <option value="2" <?php if ($usuario->id_rol == 2) echo 'selected'; ?>>Arrendatario</option>
            <option value="3" <?php if ($usuario->id_rol == 3) echo 'selected'; ?>>Administrador</option>
        </select>
        <br>
        <input type="submit" value="Actualizar Usuario">
    </form>
    <a href="gestionar_usuarios.php" class="boton">Volver</a>
</body>
</html>

<style>
/* estilos.css */

/* Estilos generales */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

/* Estilo del encabezado */
h1 {
    text-align: center;
    color: #333;
}

/* Estilo del formulario */
form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 0 auto;
}

/* Estilo de los labels */
label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

/* Estilo de los inputs y textarea */
input[type="text"],
input[type="email"],
input[type="password"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box; /* Para incluir el padding en el ancho total */
}

/* Estilo del botón de envío */
input[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Estilo del enlace para volver */
.boton {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 15px;
    background-color: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}

.boton:hover {
    background-color: #218838;
}

</style>