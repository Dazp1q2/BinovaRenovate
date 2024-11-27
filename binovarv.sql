-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2024 a las 23:56:53
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `binovarv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id_contacto` int(11) NOT NULL,
  `id_inmueble` int(11) DEFAULT NULL,
  `nombre_interesado` varchar(100) NOT NULL,
  `correo_interesado` varchar(100) NOT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha_contacto` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_inmuebles`
--

CREATE TABLE `imagenes_inmuebles` (
  `id_imagen` int(11) NOT NULL,
  `id_inmueble` int(11) DEFAULT NULL,
  `ruta_imagen` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE `inmuebles` (
  `id_inmueble` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `tipo_inmueble` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `amoblado` varchar(10) NOT NULL,
  `servicios` text NOT NULL,
  `area` decimal(5,2) DEFAULT NULL,
  `areas_comunes` text NOT NULL,
  `parqueadero` varchar(20) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `seguridad` varchar(20) NOT NULL,
  `estado` text DEFAULT 'Disponible',
  `caracteristicas_locales` text NOT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`id_inmueble`, `id_usuario`, `direccion`, `ciudad`, `tipo_inmueble`, `precio`, `amoblado`, `servicios`, `area`, `areas_comunes`, `parqueadero`, `descripcion`, `seguridad`, `estado`, `caracteristicas_locales`, `fecha_publicacion`) VALUES
(1, 2, 'Calle 123', 'San José', 'Departamento', 500000.00, 'Sí', 'Todos', 25.00, 'Si', 'No', 'Departamento cómodo en el centro de la ciudad', 'Vigilancia', 'Disponible', 'Bonita zona', '2024-11-19 15:52:13'),
(2, NULL, 'Avenida 456', 'Alajuela', 'Casa', 800000.00, '', '', NULL, '', '', 'Casa moderna con piscina', 'Sistema de alarma', 'Arrendado', '', '2024-11-19 15:52:13'),
(3, NULL, 'Calle 789', 'Cartago', 'Oficina', 1200000.00, '', '', NULL, '', '', 'Oficina en edificio empresarial', 'Control de acceso', 'Disponible', '', '2024-11-19 15:52:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(3, 'Administrador'),
(1, 'Arrendador'),
(2, 'Arrendatario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `cedula` int(70) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `cedula`, `correo_electronico`, `telefono`, `contrasena`, `fecha_registro`, `id_rol`) VALUES
(2, 'Daniel', 'Leon', 1000473105, 'fduquedaniel@gmail.com', '3209793972', '$2y$10$c3C3Zj.rP/l.kd0OLvCpUusBtLT3x0H0TAsCwqvlNcYsbAxvkjxOG', '2024-11-19 13:43:45', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id_contacto`),
  ADD KEY `id_inmueble` (`id_inmueble`);

--
-- Indices de la tabla `imagenes_inmuebles`
--
ALTER TABLE `imagenes_inmuebles`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `id_inmueble` (`id_inmueble`);

--
-- Indices de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD PRIMARY KEY (`id_inmueble`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes_inmuebles`
--
ALTER TABLE `imagenes_inmuebles`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  MODIFY `id_inmueble` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`id_inmueble`) REFERENCES `inmuebles` (`id_inmueble`);

--
-- Filtros para la tabla `imagenes_inmuebles`
--
ALTER TABLE `imagenes_inmuebles`
  ADD CONSTRAINT `imagenes_inmuebles_ibfk_1` FOREIGN KEY (`id_inmueble`) REFERENCES `inmuebles` (`id_inmueble`);

--
-- Filtros para la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD CONSTRAINT `inmuebles_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
