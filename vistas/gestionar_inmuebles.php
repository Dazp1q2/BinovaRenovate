<?php
include_once '../includes/menu.php';
require_once '../config/base_de_datos.php';
require_once '../controladores/ControladorInmueble.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_inmueble = new ControladorInmueble($db);

// Obtener todos los inmuebles
$stmt = $controlador_inmueble->obtenerTodosLosInmuebles();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestionar Inmuebles</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <h1>Gestionar Inmuebles</h1>
    <a href="crear_inmueble.php" class="boton">Crear Nuevo Inmueble</a>
    <section class="inmuebles-grid">
        <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                echo "<div class='inmueble'>";
                echo "<h3>{$direccion}</h3>";
                echo "<p>{$ciudad}</p>";
                echo "<p>{$tipo_inmueble}</p>";
                echo "<p>Precio: {$precio}</p>";
                echo "<p>{$descripcion}</p>";
                echo "<a href='editar_inmueble.php?id={$id_inmueble}' class='boton'>Editar</a>";
                echo "<a href='eliminar_inmueble.php?id={$id_inmueble}' class='boton'>Eliminar</a>";
                echo "</div>";
            }
        ?>
    </section>
</body>
</html>