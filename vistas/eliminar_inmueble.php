<?php
include_once '../includes/verificar_sesion.php';
require_once '../config/base_de_datos.php';
require_once '../controladores/ControladorInmueble.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_inmueble = new ControladorInmueble($db);

$id_inmueble = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id_inmueble)) {
    header("Location: gestionar_inmuebles.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($controlador_inmueble->eliminarInmueble($id_inmueble)) {
        header("Location: gestionar_inmuebles.php");
        exit();
    } else {
        echo "Error al eliminar el inmueble.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Inmueble</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <h1>Eliminar Inmueble</h1>
    <p>¿Estás seguro de que deseas eliminar este inmueble?</p>
    <form id="eliminarInmuebleForm" action="eliminar_inmueble.php?id=<?php echo $id_inmueble; ?>" method="post">
        <input type="submit" value="Eliminar Inmueble" class="boton">
    </form>
    <a href="gestionar_inmuebles.php" class="boton">Volver</a>
</body>
</html>