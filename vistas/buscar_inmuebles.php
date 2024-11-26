<?php
require_once '../config/base_de_datos.php';
require_once '../controladores/ControladorInmueble.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_inmueble = new ControladorInmueble($db);

$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

if (!empty($busqueda)) {
    $stmt = $controlador_inmueble->buscarInmuebles($busqueda);
} else {
    $stmt = $controlador_inmueble->obtenerTodosLosInmuebles();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Buscar Propiedades</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <?php include_once '../includes/menu.php'; ?>

    <section class="buscador">
        <h2>Búsqueda de Propiedades</h2>
        <form id="buscadorForm" action="buscar_inmuebles.php" method="get">
            <input type="text" id="busqueda" name="busqueda" placeholder="Buscar propiedades..." value="<?php echo htmlspecialchars($busqueda); ?>">
            <input type="submit" value="Buscar">
        </form>
    </section>

    <section class="propiedades">
        <h2>Propiedades Encontradas</h2>
        <div class="inmuebles-grid">
            <?php
                if ($stmt->rowCount() > 0) {
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
                } else {
                    echo "<p>No se encontraron propiedades que coincidan con la búsqueda.</p>";
                }
            ?>
        </div>
    </section>
</body>
</html>