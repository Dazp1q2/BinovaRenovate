<?php
include_once '../includes/menu.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Administrador</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <h1>Bienvenido al Dashboard del Administrador</h1>
    <p>Desde aquí puedes gestionar los inmuebles y usuarios de la plataforma.</p>
    <section class="acciones">
        <a href="gestionar_inmuebles.php" class="boton">Gestionar Inmuebles</a>
        <a href="gestionar_usuarios.php" class="boton">Gestionar Usuarios</a>
    </section>
</body>
</html>