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

<style>

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    color: #333;
}

h1 {
    text-align: center;
    color: #2c3e50;
    border-bottom: 3px solid #3498db;
    padding-bottom: 15px;
    margin-bottom: 30px;
    font-size: 2.5em;
}

p {
    text-align: center;
    color: #34495e;
    max-width: 600px;
    margin: 0 auto 40px;
    line-height: 1.6;
}

.acciones {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
    width: 100%;
    max-width: 800px;
}

.boton {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 250px;
    padding: 20px;
    text-decoration: none;
    background-color: #3498db;
    color: white;
    border-radius: 10px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.boton:first-child {
    background-color: #2ecc71;
}

.boton:last-child {
    background-color: #e74c3c;
}

.boton::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.2);
    transition: all 0.3s ease;
}

.boton:hover::before {
    left: 0;
}

.boton:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
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

h1, p, .acciones {
    animation: fadeIn 0.6s ease-out;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .acciones {
        flex-direction: column;
        align-items: center;
    }

    .boton {
        width: 80%;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 2em;
    }
}

/* Efectos adicionales */
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(to right, #3498db, #2ecc71, #e74c3c);
    z-index: 1000;
}

</style>