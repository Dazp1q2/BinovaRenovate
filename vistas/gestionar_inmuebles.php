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

<style>

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
    color: #333;
}

h1 {
    text-align: center;
    color: #2c3e50;
    border-bottom: 3px solid #3498db;
    padding-bottom: 15px;
    margin-bottom: 30px;
}

/* Botón de Crear Nuevo Inmueble */
.boton {
    display: block;
    width: 250px;
    margin: 0 auto 30px;
    padding: 12px 20px;
    background-color: #2ecc71;
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
    font-weight: bold;
}

.boton:hover {
    background-color: #27ae60;
    transform: translateY(-3px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

/* Grid de Inmuebles */
.inmuebles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    padding: 0 20px;
}

.inmueble {
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: column;
}

.inmueble:hover {
    transform: scale(1.03);
}

.inmueble h3 {
    color: #2c3e50;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
    margin-bottom: 15px;
}

.inmueble p {
    margin: 10px 0;
    padding: 8px;
    background-color: #ecf0f1;
    border-radius: 5px;
}

.inmueble p:nth-child(4) {
    background-color: #2ecc71;
    color: white;
    font-weight: bold;
}

/* Botones de Acción */
.inmueble .boton {
    width: 100%;
    margin: 5px 0;
    padding: 10px;
    font-size: 0.9em;
}

.inmueble .boton:first-of-type {
    background-color: #3498db;
}

.inmueble .boton:last-of-type {
    background-color: #e74c3c;
}

.inmueble .boton:first-of-type:hover {
    background-color: #2980b9;
}

.inmueble .boton:last-of-type:hover {
    background-color: #c0392b;
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

.inmuebles-grid .inmueble {
    animation: fadeIn 0.5s ease-out;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .inmuebles-grid {
        grid-template-columns: 1fr;
        padding: 0 10px;
    }

    .boton {
        width: 100%;
    }
}

/* Pseudo-elementos para etiquetas */
.inmueble p:first-of-type::before { content: "Ciudad: "; font-weight: bold; }
.inmueble p:nth-child(3)::before { content: "Tipo: "; font-weight: bold; }

</style>