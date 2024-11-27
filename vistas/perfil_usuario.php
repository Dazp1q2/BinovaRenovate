<?php
include_once '../includes/menu.php';
require_once '../config/base_de_datos.php';
require_once '../controladores/ControladorUsuario.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_usuario = new ControladorUsuario($db);

$usuario = $controlador_usuario->obtenerUsuarioPorId($_SESSION['id_usuario']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <div class="usuario">
        <h2><?php echo htmlspecialchars($usuario->nombre . ' ' . $usuario->apellidos); ?></h2>
        <p>Cédula: <?php echo htmlspecialchars($usuario->cedula); ?></p>
        <p>Correo Electrónico: <?php echo htmlspecialchars($usuario->correo_electronico); ?></p>
        <p>Teléfono: <?php echo htmlspecialchars($usuario->telefono); ?></p>
        <p>Rol: <?php echo htmlspecialchars($usuario->nombre_rol); ?></p>
        <a href="logout.php" class="boton">Cerrar Sesión</a>
    </div>
</body>
</html>

<style>

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    padding: 20px;
}

.usuario {
    background-color: white;
    width: 100%;
    max-width: 500px;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease;
}

.usuario:hover {
    transform: scale(1.02);
}

.usuario h2 {
    color: #2c3e50;
    border-bottom: 3px solid #3498db;
    padding-bottom: 10px;
    margin-bottom: 20px;
    font-size: 24px;
}

.usuario p {
    margin: 15px 0;
    color: #34495e;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #ecf0f1;
    border-radius: 5px;
}

.usuario p::before {
    content: attr(data-label);
    font-weight: bold;
    color: #2c3e50;
    margin-right: 10px;
}

.boton {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 25px;
    background-color: #e74c3c;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.boton:hover {
    background-color: #c0392b;
    transform: translateY(-3px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

/* Estilos para información específica */
.usuario p:nth-child(odd) {
    background-color: #f7f9f9;
}

/* Efecto para diferentes roles */
.usuario p:last-of-type {
    background-color: #3498db;
    color: white;
    font-weight: bold;
}

/* Responsive Design */
@media screen and (max-width: 600px) {
    .usuario {
        width: 90%;
        padding: 20px;
    }

    .usuario h2 {
        font-size: 20px;
    }

    .usuario p {
        flex-direction: column;
        align-items: flex-start;
    }
}

/* Animaciones */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.usuario {
    animation: fadeIn 0.6s ease-out;
}

</style>