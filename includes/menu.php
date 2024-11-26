<?php
session_start();
include_once '../config/base_de_datos.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();

$rol_usuario = '';
if (isset($_SESSION['id_usuario'])) {
    require_once '../controladores/ControladorUsuario.php';
    $controlador_usuario = new ControladorUsuario($db);
    $usuario = $controlador_usuario->obtenerUsuarioPorId($_SESSION['id_usuario']);
    $rol_usuario = $usuario->id_rol;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Menú Dinámico</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <header class="menu">
        <div class="logo">
            <a href="index.php">BinovaRenovate</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <?php if (isset($_SESSION['id_usuario'])): ?>
                    <li><a href="perfil_usuario.php">Mi Perfil</a></li>
                    <?php if ($rol_usuario == 3): // Administrador ?>
                        <li><a href="dashboard_admin.php">Dashboard Admin</a></li>
                        <ul>
                            <li><a href="gestionar_inmuebles.php">Gestionar Inmuebles</a></li>
                            <li><a href="gestionar_usuarios.php">Gestionar Usuarios</a></li>
                        </ul>
                    <?php elseif ($rol_usuario == 1): // Arrendador ?>
                        <li><a href="mis_inmuebles.php">Mis Inmuebles</a></li>
                        <li><a href="crear_inmueble.php">Crear Inmueble</a></li>
                    <?php elseif ($rol_usuario == 2): // Arrendatario ?>
                        <li><a href="mis_reservas.php">Mis Reservas</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="login.php">Iniciar Sesión</a></li>
                    <li><a href="registro_usuario.php">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>