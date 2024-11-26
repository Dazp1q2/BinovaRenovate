<?php
include_once '../includes/menu.php';
require_once '../config/base_de_datos.php';
require_once '../controladores/ControladorInmueble.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_inmueble = new ControladorInmueble($db);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sitio de Arrendamientos</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <?php include_once '../includes/menu.php'; ?>

    <section class="buscador">
        <h2>Búsqueda de Propiedades</h2>
        <form id="buscadorForm" action="buscar_inmuebles.php" method="get">
            <input type="text" id="busqueda" name="busqueda" placeholder="Buscar propiedades...">
            <input type="submit" value="Buscar">
        </form>
    </section>

    <section class="propiedades">
        <h2>Propiedades Destacadas</h2>
        <div class="inmuebles-grid">
            <?php
                $stmt = $controlador_inmueble->obtenerTodosLosInmuebles();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    echo "<div class='inmueble'>";
                    echo "<h3>{$direccion}</h3>";
                    echo "<p>{$ciudad}</p>";
                    echo "<p>{$tipo_inmueble}</p>";
                    echo "<p>Precio: {$precio}</p>";
                    echo "<p>{$descripcion}</p>";
                    echo "<a href='detalle_inmueble.php?id={$id_inmueble}'>Ver Detalles</a>";
                    echo "</div>";
                }
            ?>
        </div>
    </section>

    <section class="informacion">
        <h2>Información sobre Nosotros</h2>
        <p>Bienvenido a BinovaRenovate, tu portal de arrendamientos en línea. Ofrecemos una amplia variedad de propiedades para arrendar, desde departamentos y casas hasta oficinas y espacios comerciales. Contáctanos para más información o para programar una visita.</p>
    </section>
</body>
</html>