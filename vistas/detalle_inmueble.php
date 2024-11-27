<!DOCTYPE html>
<html>
<head>
    <title>Detalle del Inmueble</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <h1>Detalle del Inmueble</h1>
    <?php
        session_start();
        include_once '../config/base_de_datos.php';
        include_once '../controladores/ControladorInmueble.php';
        $base_de_datos = new BaseDeDatos();
        $db = $base_de_datos->getConexion();
        $controlador_inmueble = new ControladorInmueble($db);
        $inmueble = $controlador_inmueble->obtenerInmueblePorId($_GET['id']);
        echo "<div class='inmueble'>";
        echo "<h2>{$inmueble->direccion}</h2>";
        echo "<p>{$inmueble->ciudad}</p>";
        echo "<p>{$inmueble->tipo_inmueble}</p>";
        echo "<p>Precio: {$inmueble->precio}</p>";
        echo "<p>{$inmueble->descripcion}</p>";
        echo "<p>{$inmueble->seguridad}</p>";
        echo "<p>{$inmueble->estado}</p>";
        echo "</div>";
    ?>
</body>
</html>


<style>

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
    line-height: 1.6;
    color: #333;
}

h1 {
    text-align: center;
    color: #2c3e50;
    border-bottom: 3px solid #3498db;
    padding-bottom: 15px;
    margin-bottom: 30px;
}

.inmueble {
    background-color: white;
    max-width: 800px;
    margin: 0 auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.inmueble:hover {
    transform: scale(1.02);
}

.inmueble h2 {
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 24px;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
}

.inmueble p {
    margin: 15px 0;
    padding: 12px;
    background-color: #ecf0f1;
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.inmueble p:nth-child(even) {
    background-color: #f7f9f9;
}

/* Estilos para tipos específicos de información */
.inmueble p:first-of-type {
    background-color: #3498db;
    color: white;
    font-weight: bold;
}

.inmueble p:nth-child(4) {
    background-color: #2ecc71;
    color: white;
    font-size: 1.2em;
}

.inmueble p:last-of-type {
    background-color: #e74c3c;
    color: white;
}

/* Pseudo-elementos para etiquetas */
.inmueble p::before {
    font-weight: bold;
    color: #2c3e50;
    margin-right: 10px;
}

.inmueble p:nth-child(2)::before { content: "Ciudad: "; }
.inmueble p:nth-child(3)::before { content: "Tipo de Inmueble: "; }
.inmueble p:nth-child(4)::before { content: "Precio: "; }
.inmueble p:nth-child(5)::before { content: "Descripción: "; }
.inmueble p:nth-child(6)::before { content: "Seguridad: "; }
.inmueble p:last-of-type::before { content: "Estado: "; }

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

.inmueble {
    animation: fadeIn 0.6s ease-out;
}

/* Responsive Design */
@media screen and (max-width: 600px) {
    body {
        padding: 10px;
    }

    .inmueble {
        padding: 15px;
        width: 95%;
    }

    .inmueble h2 {
        font-size: 20px;
    }

    .inmueble p {
        flex-direction: column;
        align-items: flex-start;
    }

    .inmueble p::before {
        margin-bottom: 5px;
    }
}

</style>