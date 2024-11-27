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
                    <li><a href="registro.php">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
}

.menu {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #2c3e50;
    padding: 15px 50px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.logo a {
    color: #fff;
    text-decoration: none;
    font-size: 24px;
    font-weight: bold;
    transition: color 0.3s ease;
}

.logo a:hover {
    color: #3498db;
}

nav ul {
    display: flex;
    list-style: none;
    align-items: center;
}

nav > ul > li {
    position: relative;
    margin-left: 20px;
}

nav ul li a {
    text-decoration: none;
    color: #ecf0f1;
    font-weight: 500;
    padding: 10px 15px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

nav ul li a:hover {
    background-color: #3498db;
    color: white;
}

/* Submenú de Administrador */
nav ul ul {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #34495e;
    min-width: 200px;
    border-radius: 0 0 5px 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    z-index: 1000;
}

nav ul li:hover > ul {
    display: block;
}

nav ul ul li {
    width: 100%;
    float: none;
    position: relative;
}

nav ul ul li a {
    padding: 10px 15px;
    color: #ecf0f1;
    display: block;
}

nav ul ul li a:hover {
    background-color: #2980b9;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .menu {
        flex-direction: column;
        padding: 15px;
    }

    nav ul {
        flex-direction: column;
        width: 100%;
        text-align: center;
    }

    nav > ul > li {
        margin: 10px 0;
        width: 100%;
    }

    nav ul ul {
        position: static;
        display: none;
        background-color: #2c3e50;
    }

    nav ul li:hover > ul {
        display: block;
    }
}

/* Estilos para diferentes roles de usuario */
nav ul li a[href*="dashboard_admin"] {
    color: #e74c3c;
    font-weight: bold;
}

nav ul li a[href*="mis_inmuebles"],
nav ul li a[href*="crear_inmueble"] {
    color: #2ecc71;
}

nav ul li a[href*="mis_reservas"] {
    color: #f39c12;
}

/* Botón de Cerrar Sesión */
nav ul li a[href="logout.php"] {
    background-color: #e74c3c;
    color: white;
}

nav ul li a[href="logout.php"]:hover {
    background-color: #c0392b;
}

</style>