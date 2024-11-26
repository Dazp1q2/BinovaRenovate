<?php
include_once '../includes/menu.php';
require_once '../config/base_de_datos.php';
require_once '../controladores/ControladorInmueble.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_inmueble = new ControladorInmueble($db);

$id_inmueble = isset($_GET['id']) ? $_GET['id'] : '';

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
        'id_inmueble' => $id_inmueble,
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

    if ($controlador_inmueble->actualizarInmueble($datos)) {
        header("Location: gestionar_inmuebles.php");
        exit();
    } else {
        echo "Error al actualizar el inmueble.";
    }
}

if (empty($id_inmueble)) {
    header("Location: gestionar_inmuebles.php");
    exit();
}

$inmueble = $controlador_inmueble->obtenerInmueblePorId($id_inmueble);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Inmueble</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <h1>Editar Inmueble</h1>
    <form id="editarInmuebleForm" action="editar_inmueble.php?id=<?php echo $id_inmueble; ?>" method="post">
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($inmueble->direccion); ?>" required>
        <br>
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" value="<?php echo htmlspecialchars($inmueble->ciudad); ?>" required>
        <br>
        <label for="tipo_inmueble">Tipo de Inmueble:</label>
        <input type="text" id="tipo_inmueble" name="tipo_inmueble" value="<?php echo htmlspecialchars($inmueble->tipo_inmueble); ?>" required>
        <br>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" value="<?php echo htmlspecialchars($inmueble->precio); ?>" required>
        <br>
        <label for="amoblado">Amoblado:</label>
        <select id="amoblado" name="amoblado" required>
            <option value="Sí" <?php if ($inmueble->amoblado == 'Sí') echo 'selected'; ?>>Sí</option>
            <option value="No" <?php if ($inmueble->amoblado == 'No') echo 'selected'; ?>>No</option>
        </select>
        <br>
        <label for="servicios">Servicios:</label>
        <input type="text" id="servicios" name="servicios" value="<?php echo htmlspecialchars($inmueble->servicios); ?>" required>
        <br>
        <label for="area">Área (m²):</label>
        <input type="number" id="area" name="area" step="0.01" value="<?php echo htmlspecialchars($inmueble->area); ?>" required>
        <br>
        <label for="areas_comunes">Áreas Comunes:</label>
        <input type="text" id="areas_comunes" name="areas_comunes" value="<?php echo htmlspecialchars($inmueble->areas_comunes); ?>" required>
        <br>
        <label for="parqueadero">Parqueadero:</label>
        <input type="text" id="parqueadero" name="parqueadero" value="<?php echo htmlspecialchars($inmueble->parqueadero); ?>" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($inmueble->descripcion); ?></textarea>
        <br>
        <label for="seguridad">Seguridad:</label>
        <input type="text" id="seguridad" name="seguridad" value="<?php echo htmlspecialchars($inmueble->seguridad); ?>" required>
        <br>
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="Disponible" <?php if ($inmueble->estado == 'Disponible') echo 'selected'; ?>>Disponible</option>
            <option value="Arrendado" <?php if ($inmueble->estado == 'Arrendado') echo 'selected'; ?>>Arrendado</option>
            <option value="En Mantenimiento" <?php if ($inmueble->estado == 'En Mantenimiento') echo 'selected'; ?>>En Mantenimiento</option>
        </select>
        <br>
        <label for="caracteristicas_locales">Características Locales:</label>
        <input type="text" id="caracteristicas_locales" name="caracteristicas_locales" value="<?php echo htmlspecialchars($inmueble->caracteristicas_locales); ?>" required>
        <br>
        <input type="submit" value="Actualizar Inmueble">
    </form>
    <a href="gestionar_inmuebles.php" class="boton">Volver</a>
</body>
</html>