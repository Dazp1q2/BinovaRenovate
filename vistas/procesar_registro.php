<?php
session_start();
include_once '../config/base_de_datos.php';
include_once '../controladores/ControladorUsuario.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_usuario = new ControladorUsuario($db);

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$cedula = $_POST['cedula'];
$correo_electronico = $_POST['correo_electronico'];
$telefono = $_POST['telefono'];
$contrasena = $_POST['contrasena'];
$id_rol = $_POST['id_rol'];

$datos = array(
    'nombre' => $nombre,
    'apellidos' => $apellidos,
    'cedula' => $cedula,
    'correo_electronico' => $correo_electronico,
    'telefono' => $telefono,
    'contrasena' => $contrasena,
    'id_rol' => $id_rol
);

if ($controlador_usuario->crearUsuario($datos)) {
    echo "Usuario registrado exitosamente.";
    header("Location: login.php");
    exit();
} else {
    echo "Error al registrar el usuario.";
    header("Location: registro.php");
    exit();
}
?>