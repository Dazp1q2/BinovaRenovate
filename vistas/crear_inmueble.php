<?php
include_once '../includes/menu.php';
require_once '../config/base_de_datos.php';
require_once '../controladores/ControladorInmueble.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_inmueble = new ControladorInmueble($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_SESSION['id_usuario'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $tipo_inmueble = $_POST['tipo_inmueble'];
    $precio = $_POST['precio'];
    $amoblado = $_POST['amoblado'];
    $servicios = $_POST['servicios'];
    $area = $_POST['area'];
    $areas_comunes = $_POST['areas_comunes'];
    $parqueadero = $_POST['parqueadero'];
    $descripcion = $_POST['descripcion'];
    $seguridad = $_POST['seguridad'];
    $estado = $_POST['estado'];
    $caracteristicas_locales = $_POST['caracteristicas_locales'];

    $datos = array(
        'id_usuario' => $id_usuario,
        'direccion' => $direccion,
        'ciudad' => $ciudad,
        'tipo_inmueble' => $tipo_inmueble,
        'precio' => $precio,
        'amoblado' => $amoblado,
        'servicios' => $servicios,
        'area' => $area,
        'areas_comunes' => $areas_comunes,
        'parqueadero' => $parqueadero,
        'descripcion' => $descripcion,
        'seguridad' => $seguridad,
        'estado' => $estado,
        'caracteristicas_locales' => $caracteristicas_locales
    );

    if ($controlador_inmueble->crearInmueble($datos)) {
        header("Location: gestionar_inmuebles.php");
        exit();
    } else {
        echo "Error al crear el inmueble.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear Inmueble</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <h1>Crear Inmueble</h1>
    <form id="crearInmuebleForm" action="crear_inmueble.php" method="post">
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required>
        <br>
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" required>
        <br>
        <label for="tipo_inmueble">Tipo de Inmueble:</label>
        <input type="text" id="tipo_inmueble" name="tipo_inmueble" required>
        <br>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" required>
        <br>
        <label for="amoblado">Amoblado:</label>
        <select id="amoblado" name="amoblado" required>
            <option value="Sí">Sí</option>
            <option value="No">No</option>
        </select>
        <br>
        <label for="servicios">Servicios:</label>
        <input type="text" id="servicios" name="servicios" required>
        <br>
        <label for="area">Área (m²):</label>
        <input type="number" id="area" name="area" step="0.01" required>
        <br>
        <label for="areas_comunes">Áreas Comunes:</label>
        <input type="text" id="areas_comunes" name="areas_comunes" required>
        <br>
        <label for="parqueadero">Parqueadero:</label>
        <input type="text" id="parqueadero" name="parqueadero" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
        <br>
        <label for="seguridad">Seguridad:</label>
        <input type="text" id="seguridad" name="seguridad" required>
        <br>
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="Disponible">Disponible</option>
            <option value="Arrendado">Arrendado</option>
            <option value="En Mantenimiento">En Mantenimiento</option>
        </select>
        <br>
        <label for="caracteristicas_locales">Características Locales:</label>
        <input type="text" id="caracteristicas_locales" name="caracteristicas_locales" required>
        <br>
        <input type="submit" value="Crear Inmueble">
    </form>
    <a href="gestionar_inmuebles.php" class="boton">Volver</a>
</body>
</html>