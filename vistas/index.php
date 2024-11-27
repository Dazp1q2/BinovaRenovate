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
                $stmt = $controlador_inmueble->obtenerInmueblesRecientes();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
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
        <a href="propiedades.php" class="boton">Ver Todas las Propiedades</a>
    </section>

    <section class="informacion">
        <h2>Información sobre Nosotros</h2>
        <p>Bienvenido a BinovaRenovate, tu portal de arrendamientos en línea. Ofrecemos una amplia variedad de propiedades para arrendar, desde departamentos y casas hasta oficinas y espacios comerciales. Contáctanos para más información o para programar una visita.</p>
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
    justify-content: center;
    gap: 10px;
}

.buscador input[type="text"] {
    width: 60%;
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

/* Sección de Información */
.informacion {
    background-color: #f9f9f9;
    text-align: center;
    font-style: italic;
    padding: 20px;
    border-radius: 8px;
}

</style>
