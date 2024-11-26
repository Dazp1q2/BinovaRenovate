<?php
session_start();
include_once '../config/base_de_datos.php';
include_once '../controladores/ControladorUsuario.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_usuario = new ControladorUsuario($db);

$correo_electronico = $_POST['correo_electronico'];
$contrasena = $_POST['contrasena'];

$query = "SELECT * FROM usuarios WHERE correo_electronico = ?";
$stmt = $db->prepare($query);
$stmt->bindParam(1, $correo_electronico);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['apellidos'] = $usuario['apellidos'];
    $_SESSION['id_rol'] = $usuario['id_rol'];

    // Redirigir según el rol
    switch ($usuario['id_rol']) {
        case 1: // Administrador (si tienes un rol de administrador)
            header("Location: admin_dashboard.php");
            break;
        case 2: // Arrendador
            header("Location: perfil_usuario.php");
            break;
        case 3: // Arrendatario
            header("Location: perfil_usuario.php");
            break;
        default:
            header("Location: login.php");
            break;
    }
    exit();
} else {
    $_SESSION['error_login'] = "Correo electrónico o contraseña incorrectos.";
    header("Location: login.php");
    exit();
}
?>