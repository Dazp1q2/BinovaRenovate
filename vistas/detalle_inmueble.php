<!DOCTYPE html>
<html>
<head>
    <title>Detalle del Inmueble</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <h1>Detalle del Inmueble</h1>
    <?php
        session_start();
        include_once '../config/base_de_datos.php';
        include_once '../controladores/ControladorInmueble.php';
        $base_de_datos = new BaseDeDatos();
        $db = $base_de_datos->getConexion();
        $controlador_inmueble = new ControladorInmueble($db);
        $inmueble = $controlador_inmueble->obtenerInmueblePorId($_GET['id']);
        echo "<div class='inmueble'>";
        echo "<h2>{$inmueble->direccion}</h2>";
        echo "<p>{$inmueble->ciudad}</p>";
        echo "<p>{$inmueble->tipo_inmueble}</p>";
        echo "<p>Precio: {$inmueble->precio}</p>";
        echo "<p>{$inmueble->descripcion}</p>";
        echo "<p>{$inmueble->seguridad}</p>";
        echo "<p>{$inmueble->estado}</p>";
        echo "</div>";
    ?>
</body>
</html>