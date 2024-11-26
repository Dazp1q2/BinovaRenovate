<?php
include_once '../includes/verificar_sesion.php';
include_once '../config/base_de_datos.php';
include_once '../controladores/ControladorUsuario.php';
include_once '../modelos/Rol.php';

$base_de_datos = new BaseDeDatos();
$db = $base_de_datos->getConexion();
$controlador_usuario = new ControladorUsuario($db);

$usuario = $controlador_usuario->obtenerUsuarioPorId($_SESSION['id_usuario']);
echo "<div class='usuario'>";
echo "<h2>{$usuario->nombre} {$usuario->apellidos}</h2>";
echo "<p>Cédula: {$usuario->cedula}</p>";
echo "<p>Correo Electrónico: {$usuario->correo_electronico}</p>";
echo "<p>Teléfono: {$usuario->telefono}</p>";
echo "<p>Rol: ";

$rol = new Rol($db);
$rol->leerUnico($usuario->id_rol);
echo $rol->nombre_rol;

echo "</p>";
echo "<a href='logout.php' class='boton'>Cerrar Sesión</a>";
echo "</div>";
?>