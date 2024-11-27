<?php
include_once '../includes/menu.php';
require_once '../config/base_de_datos.php';
require_once '../controladores/ControladorInmueble.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_inmueble = new ControladorInmueble($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id_usuario']) && $_SESSION['id_rol'] == 1) {
    $datos = [
        'id_usuario' => $_SESSION['id_usuario'],
        'direccion' => $_POST['direccion'],
        'ciudad' => $_POST['ciudad'],
        'tipo_inmueble' => $_POST['tipo_inmueble'],
        'precio' => $_POST['precio'],
        'amoblado' => $_POST['amoblado'],
        'servicios' => $_POST['servicios'],
        'area' => $_POST['area'],
        'areas_comunes' => $_POST['areas_comunes'],
        'parqueadero' => $_POST['parqueadero'],
        'descripcion' => $_POST['descripcion'],
        'seguridad' => $_POST['seguridad'],
        'estado' => $_POST['estado'],
        'caracteristicas_locales' => $_POST['caracteristicas_locales'],
        'imagen_vista_previa' => ''
    ];

    // Subir imagen de vista previa
    if (isset($_FILES['imagen_vista_previa']) && $_FILES['imagen_vista_previa']['error'] == 0) {
        $nombre_archivo = $_FILES['imagen_vista_previa']['name'];
        $nombre_temporal = $_FILES['imagen_vista_previa']['tmp_name'];
        $ruta_destino = '../uploads/inmuebles/' . $nombre_archivo;

        if (move_uploaded_file($nombre_temporal, $ruta_destino)) {
            $datos['imagen_vista_previa'] = $nombre_archivo;
        } else {
            $_SESSION['error_registro_inmueble'] = "Error al subir la imagen de vista previa.";
            header("Location: registrar_inmueble.php");
            exit();
        }
    }

    if ($controlador_inmueble->crearInmueble($datos)) {
        header("Location: gestionar_inmuebles.php");
        exit();
    } else {
        $_SESSION['error_registro_inmueble'] = "Error al registrar el inmueble.";
        header("Location: registrar_inmueble.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrar Inmueble</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <h1>Registrar Inmueble</h1>
    <?php
    if (isset($_SESSION['error_registro_inmueble'])) {
        echo "<p class='error'>" . htmlspecialchars($_SESSION['error_registro_inmueble']) . "</p>";
        unset($_SESSION['error_registro_inmueble']);
    }
    ?>
    <form action="registrar_inmueble.php" method="post" enctype="multipart/form-data">
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required>

        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" required>

        <label for="tipo_inmueble">Tipo de Inmueble:</label>
        <select id="tipo_inmueble" name="tipo_inmueble" required>
            <option value="Departamento">Departamento</option>
            <option value="Casa">Casa</option>
            <option value="Oficina">Oficina</option>
            <option value="Comercial">Comercial</option>
        </select>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" required>

        <label for="amoblado">Amoblado:</label>
        <select id="amoblado" name="amoblado" required>
            <option value="Sí">Sí</option>
            <option value="No">No</option>
        </select>

        <label for="servicios">Servicios:</label>
        <textarea id="servicios" name="servicios" required></textarea>

        <label for="area">Área (m²):</label>
        <input type="number" id="area" name="area" step="0.01" required>

        <label for="areas_comunes">Áreas Comunes:</label>
        <textarea id="areas_comunes" name="areas_comunes" required></textarea>

        <label for="parqueadero">Parqueadero:</label>
        <input type="text" id="parqueadero" name="parqueadero" required>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <label for="seguridad">Seguridad:</label>
        <input type="text" id="seguridad" name="seguridad" required>

        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="Disponible">Disponible</option>
            <option value="Arrendado">Arrendado</option>
            <option value="En Mantenimiento">En Mantenimiento</option>
        </select>

        <label for="caracteristicas_locales">Características Locales:</label>
        <textarea id="caracteristicas_locales" name="caracteristicas_locales" required></textarea>

        <label for="imagen_vista_previa">Imagen de Vista Previa:</label>
        <input type="file" id="imagen_vista_previa" name="imagen_vista_previa" accept="image/*" required>

        <input type="submit" value="Registrar Inmueble">
    </form>

    <a href="gestionar_inmuebles.php" class="boton">Volver</a>
</body>
</html>

<style>

/* estilos.css */

/* Estilos generales */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

/* Estilo del encabezado */
h1 {
    text-align: center;
    color: #333;
}

/* Estilo del formulario */
form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 0 auto;
}

/* Estilo de los labels */
label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

/* Estilo de los inputs y textarea */
input[type="text"],
input[type="number"],
textarea,
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box; /* Para incluir el padding en el ancho total */
}

/* Estilo del botón de envío */
input[type="submit"] {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #218838;
}

/* Estilo del enlace para volver */
.boton {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}

.boton:hover {
    background-color: #0056b3;
}

</style>