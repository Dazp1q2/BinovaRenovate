<?php
include_once '../includes/menu.php';
require_once '../config/base_de_datos.php';
require_once '../controladores/ControladorInmueble.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_inmueble = new ControladorInmueble($db);

// Configuración de paginación
$registros_por_pagina = 6;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $registros_por_pagina;

// Búsqueda y filtros
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
$tipo_inmueble = isset($_GET['tipo_inmueble']) ? $_GET['tipo_inmueble'] : '';
$ciudad = isset($_GET['ciudad']) ? $_GET['ciudad'] : '';
$precio_min = isset($_GET['precio_min']) ? $_GET['precio_min'] : '';
$precio_max = isset($_GET['precio_max']) ? $_GET['precio_max'] : '';

// Obtener inmuebles con filtros
$inmuebles = $controlador_inmueble->obtenerInmueblesConFiltros($busqueda, $tipo_inmueble, $ciudad, $precio_min, $precio_max, $offset, $registros_por_pagina);

// Contar total de inmuebles con filtros para paginación
$total_registros = $controlador_inmueble->contarInmueblesConFiltros($busqueda, $tipo_inmueble, $ciudad, $precio_min, $precio_max);
$total_paginas = ceil($total_registros / $registros_por_pagina);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Todas las Propiedades</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <?php include_once '../includes/menu.php'; ?>

    <section class="buscador">
        <h2>Búsqueda de Propiedades</h2>
        <form id="buscadorForm" action="propiedades.php" method="get">
            <input type="text" id="busqueda" name="busqueda" placeholder="Buscar propiedades..." value="<?php echo htmlspecialchars($busqueda); ?>">
            <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad" value="<?php echo htmlspecialchars($ciudad); ?>">
            <select id="tipo_inmueble" name="tipo_inmueble">
                <option value="">Tipo de Inmueble</option>
                <option value="Departamento" <?php if ($tipo_inmueble == 'Departamento') echo 'selected'; ?>>Departamento</option>
                <option value="Casa" <?php if ($tipo_inmueble == 'Casa') echo 'selected'; ?>>Casa</option>
                <option value="Oficina" <?php if ($tipo_inmueble == 'Oficina') echo 'selected'; ?>>Oficina</option>
                <option value="Comercial" <?php if ($tipo_inmueble == 'Comercial') echo 'selected'; ?>>Comercial</option>
            </select>
            <input type="number" id="precio_min" name="precio_min" placeholder="Precio Mínimo" value="<?php echo htmlspecialchars($precio_min); ?>">
            <input type="number" id="precio_max" name="precio_max" placeholder="Precio Máximo" value="<?php echo htmlspecialchars($precio_max); ?>">
            <input type="submit" value="Buscar">
        </form>
    </section>

    <section class="propiedades">
        <h2>Todas las Propiedades</h2>
        <div class="inmuebles-grid">
            <?php
                while ($row = $inmuebles->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    echo "<div class='inmueble'>";
                    if (!empty($imagen_vista_previa)) {
                        echo "<img src='../uploads/{$imagen_vista_previa}' alt='Vista previa de {$direccion}' class='vista-previa'>";
                    } else {
                        echo "<img src='../public/images/default-image.jpg' alt='Vista previa no disponible' class='vista-previa'>";
                    }
                    echo "<h3>" . htmlspecialchars($direccion) . "</h3>";
                    echo "<p>" . htmlspecialchars($ciudad) . "</p>";
                    echo "<p>" . htmlspecialchars($tipo_inmueble) . "</p>";
                    echo "<p>Precio: $" . htmlspecialchars(number_format($precio, 2, '.', '')) . "</p>";
                    echo "<p>" . htmlspecialchars($descripcion) . "</p>";
                    echo "<a href='detalle_inmueble.php?id=" . htmlspecialchars($id_inmueble) . "' class='boton'>Ver Detalles</a>";
                    echo "</div>";
                }
            ?>
        </div>

        <!-- Paginación -->
        <div class="paginacion">
            <?php
                if ($total_paginas > 1) {
                    for ($i = 1; $i <= $total_paginas; $i++) {
                        echo "<a href='propiedades.php?busqueda=" . htmlspecialchars($busqueda) . "&ciudad=" . htmlspecialchars($ciudad) . "&tipo_inmueble=" . htmlspecialchars($tipo_inmueble) . "&precio_min=" . htmlspecialchars($precio_min) . "&precio_max=" . htmlspecialchars($precio_max) . "&pagina=" . $i . "' class='boton " . ($i == $pagina_actual ? 'activo' : '') . "'>$i</a>";
                    }
                }
            ?>
        </div>
    </section>
</body>
</html>

<style>
/* estilos.css */

body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
}

/* Estilos para secciones */
section {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Encabezados */
h2 {
    color: #2c3e50;
    border-bottom: 3px solid #3498db;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

/* Buscador */
.buscador {
    text-align: center;
    background-color: #ecf0f1;
    padding: 20px;
    border-radius: 8px;
}

.buscador form {
    display: flex;
    flex-wrap: wrap; /* Permitir que los elementos se envuelvan en varias líneas */
    justify-content: center;
    gap: 10px;
}

.buscador input[type="text"],
.buscador input[type="number"],
.buscador select {
    padding: 10px;
    border: 2px solid #3498db;
    border-radius: 5px;
    font-size: 16px;
}

.buscador input[type="submit"] {
    padding: 10px 20px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.buscador input[type="submit"]:hover {
    background-color: #2980b9;
}

/* Grid de Inmuebles */
.inmuebles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.inmueble {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    background-color: #fff;
    transition: transform 0.3s ease;
}

.inmueble:hover {
    transform: scale(1.03);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.inmueble img.vista-previa {
    width: 100%; /* Ajusta la imagen para que ocupe todo el ancho */
    border-radius: 5px;
}

.inmueble h3 {
    color: #2c3e50;
    margin-bottom: 10px;
}

.inmueble a.boton {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 15px;
    background-color: #27ae60;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.inmueble a.boton:hover {
    background-color: #2ecc71;
}

/* Paginación */
.paginacion {
    text-align: center;
    margin-top: 20px;
}

.paginacion a {
    display: inline-block;
    margin: 0 5px;
    padding: 10px 15px;
    background-color: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.paginacion a:hover {
    background-color: #2980b9;
}

.paginacion a.activo {
    background-color: #27ae60; /* Color diferente para la página activa */
}

/* Sección de Información */
.informacion {
    background-color: #f9f9f9;
    text-align: center;
    font-style: italic;
    padding: 20px;
    border-radius: 8px;
}

</style>