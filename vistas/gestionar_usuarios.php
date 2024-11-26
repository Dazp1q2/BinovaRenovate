<?php
include_once '../includes/menu.php';
require_once '../config/base_de_datos.php';
require_once '../controladores/ControladorUsuario.php';
require_once '../modelos/Rol.php'; // Incluir la clase Rol

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_usuario = new ControladorUsuario($db);

// Obtener todos los usuarios
$stmt = $controlador_usuario->obtenerTodosLosUsuarios();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestionar Usuarios</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <h1>Gestionar Usuarios</h1>
    <section class="usuarios-grid">
        <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                echo "<div class='usuario'>";
                echo "<h3>{$nombre} {$apellidos}</h3>";
                echo "<p>Cédula: {$cedula}</p>";
                echo "<p>Correo Electrónico: {$correo_electronico}</p>";
                echo "<p>Teléfono: {$telefono}</p>";
                echo "<p>Rol: ";
                $rol = new Rol($db);
                $rol->leerUnico($id_rol);
                echo $rol->nombre_rol;
                echo "</p>";
                echo "<a href='editar_usuario.php?id={$id_usuario}' class='boton'>Editar</a>";
                echo "<a href='eliminar_usuario.php?id={$id_usuario}' class='boton'>Eliminar</a>";
                echo "</div>";
            }
        ?>
    </section>
</body>
</html>