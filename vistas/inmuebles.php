<!DOCTYPE html>
<html>
<head>
    <title>Listado de Inmuebles</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <h1>Listado de Inmuebles</h1>
    <?php
        session_start();
        include_once '../config/base_de_datos.php';
        include_once '../controladores/ControladorInmueble.php';
        $base_de_datos = new BaseDeDatos();
        $db = $base_de_datos->getConexion();
        $controlador_inmueble = new ControladorInmueble($db);
        $stmt = $controlador_inmueble->obtenerTodosLosInmuebles();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo "<div class='inmueble'>";
            echo "<h2>{$direccion}</h2>";
            echo "<p>{$ciudad}</p>";
            echo "<p>{$tipo_inmueble}</p>";
            echo "<p>Precio: {$precio}</p>";
            echo "<p>{$descripcion}</p>";
            echo "<a href='detalle_inmueble.php?id={$id_inmueble}'>Ver Detalles</a>";
            echo "</div>";
        }
    ?>
</body>
</html>