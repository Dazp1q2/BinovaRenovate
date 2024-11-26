<?php
include_once '../includes/verificar_sesion.php';
require_once '../config/base_de_datos.php';
require_once '../controladores/ControladorUsuario.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_usuario = new ControladorUsuario($db);

$id_usuario = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id_usuario)) {
    header("Location: gestionar_usuarios.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($controlador_usuario->eliminarUsuario($id_usuario)) {
        header("Location: gestionar_usuarios.php");
        exit();
    } else {
        echo "Error al eliminar el usuario.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <h1>Eliminar Usuario</h1>
    <p>¿Estás seguro de que deseas eliminar este usuario?</p>
    <form id="eliminarUsuarioForm" action="eliminar_usuario.php?id=<?php echo $id_usuario; ?>" method="post">
        <input type="submit" value="Eliminar Usuario" class="boton">
    </form>
    <a href="gestionar_usuarios.php" class="boton">Volver</a>
</body>
</html>