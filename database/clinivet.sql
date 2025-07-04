-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2025 a las 20:18:28
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
-- Base de datos: `clinivet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `Id_Cita` int(11) NOT NULL,
  `Id_Tipo_Servicio` int(11) DEFAULT NULL,
  `Id_Mascota` int(11) DEFAULT NULL,
  `Id_Empleado` int(11) DEFAULT NULL,
  `Fecha_cita_actual` datetime DEFAULT NULL,
  `Fecha_Proxima_cita` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Id_Cliente` int(11) NOT NULL,
  `Cédula` int(11) DEFAULT NULL,
  `Nombres` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `Direccion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Id_Cliente`, `Cédula`, `Nombres`, `Apellidos`, `Correo`, `Direccion`) VALUES
(23, 123123, 'luis', 'asdasd', 'asdassd@gmail.com', 'asdasd'),
(24, 23123123, 'sdasd', 'asdasda', 'asdasdasdasdas@gmail.com', 'asdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_factura`
--

CREATE TABLE `detalles_factura` (
  `Id_Detalles_Factura` int(11) NOT NULL,
  `Id_Factura` int(11) NOT NULL,
  `Monto_Servicio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `Id_Empleado` int(11) NOT NULL,
  `Cedula` int(11) DEFAULT NULL,
  `Nombres` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `generoEmpleado` int(11) NOT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `Direccion` varchar(45) DEFAULT NULL,
  `Fecha_Nacimiento` datetime DEFAULT NULL,
  `Especializacion` varchar(45) DEFAULT NULL,
  `Desempeño` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`Id_Empleado`, `Cedula`, `Nombres`, `Apellidos`, `generoEmpleado`, `Correo`, `Direccion`, `Fecha_Nacimiento`, `Especializacion`, `Desempeño`) VALUES
(22, 23213, 'asdas', 'asdasd', 0, 'asdasd@gmail.com', 'asd', '2000-02-02 00:00:00', 'asd', 0.1),
(23, 123, 'asdasdasda', 'asdasd', 0, 'asdasdasdasd@gmail.com', 'asdas', '2000-02-02 00:00:00', 'asdasd', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `Id_Especie` int(11) NOT NULL,
  `Nombre_Especie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especie`
--

INSERT INTO `especie` (`Id_Especie`, `Nombre_Especie`) VALUES
(1, 'perro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_mascota`
--

CREATE TABLE `examen_mascota` (
  `id_examen_mascota` int(11) NOT NULL,
  `id_examen` int(11) NOT NULL,
  `id_Servicio_Realizado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `Id_Factura` int(11) NOT NULL,
  `Monto_total` decimal(10,2) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `Id_Mascota` int(11) NOT NULL,
  `Id_Cliente` int(11) DEFAULT NULL,
  `Nombre_Mascota` varchar(45) DEFAULT NULL,
  `Sexo` varchar(45) DEFAULT NULL,
  `Fecha_Nacimiento` datetime DEFAULT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `Tiene_Cita` tinyint(1) DEFAULT 0,
  `Id_Especie` int(11) DEFAULT NULL,
  `Id_Raza` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `Id_Producto` int(11) NOT NULL,
  `Nombre_Producto` varchar(100) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Cantidad_Stock` int(11) NOT NULL,
  `Id_Proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Id_Producto`, `Nombre_Producto`, `Descripcion`, `Precio`, `Cantidad_Stock`, `Id_Proveedor`) VALUES
(7, 'asdas', 'asdasd', 233.00, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `Id_Proveedor` int(11) NOT NULL,
  `Nombre_Proveedor` varchar(100) NOT NULL,
  `Contacto` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`Id_Proveedor`, `Nombre_Proveedor`, `Contacto`, `Telefono`, `Correo`) VALUES
(3, 'sdfsdf', 'asd', '25', 'asd@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `Id_Raza` int(11) NOT NULL,
  `Id_Especie` int(11) NOT NULL,
  `Nombre_Raza` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`Id_Raza`, `Id_Especie`, `Nombre_Raza`) VALUES
(1, 1, 'pastor aleman');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `Id_Tipo_Servicio` int(11) NOT NULL,
  `Nombre_Servicio` varchar(45) DEFAULT NULL,
  `tipo_servicio` int(11) DEFAULT NULL,
  `Precio_Servicio` decimal(10,2) DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`Id_Tipo_Servicio`, `Nombre_Servicio`, `tipo_servicio`, `Precio_Servicio`, `Descripcion`) VALUES
(7, 'asdasd', 1, 23.00, 'asd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_realizado`
--

CREATE TABLE `servicio_realizado` (
  `Id_Servicio_Realizado` int(11) NOT NULL,
  `Id_Cita` int(11) DEFAULT NULL,
  `Factura_Id_Factura` int(11) DEFAULT NULL,
  `Id_Mascota` int(11) DEFAULT NULL,
  `Id_Empleado` int(11) DEFAULT NULL,
  `Informacion_Adicional` varchar(45) DEFAULT NULL,
  `Cita_Previa` tinyint(1) NOT NULL,
  `Id_Tipo_Servicio` int(11) DEFAULT NULL,
  `Precio_Cobrado` decimal(10,2) DEFAULT NULL,
  `Fecha_Realizacion` datetime DEFAULT NULL,
  `Notas_Adicionales` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_servicio`
--

CREATE TABLE `tipos_servicio` (
  `id` int(11) NOT NULL,
  `nombre_tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_servicio`
--

INSERT INTO `tipos_servicio` (`id`, `nombre_tipo`) VALUES
(1, 'Consulta'),
(2, 'Laboratorio'),
(3, 'Peluquería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_examen`
--

CREATE TABLE `tipo_examen` (
  `id_Tipo_Examen` int(11) NOT NULL,
  `Nombre_Examen` varchar(20) NOT NULL,
  `Precio` float NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_examen`
--

INSERT INTO `tipo_examen` (`id_Tipo_Examen`, `Nombre_Examen`, `Precio`, `descripcion`) VALUES
(27, 'sdas', 23, 'sadasds');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`Id_Cita`),
  ADD KEY `Id_Tipo_Servicio` (`Id_Tipo_Servicio`),
  ADD KEY `Id_Mascota` (`Id_Mascota`),
  ADD KEY `Id_Empleado` (`Id_Empleado`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id_Cliente`),
  ADD UNIQUE KEY `Cédula` (`Cédula`),
  ADD UNIQUE KEY `Correo` (`Correo`);

--
-- Indices de la tabla `detalles_factura`
--
ALTER TABLE `detalles_factura`
  ADD PRIMARY KEY (`Id_Detalles_Factura`),
  ADD KEY `Id_Factura` (`Id_Factura`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`Id_Empleado`),
  ADD UNIQUE KEY `Cedula` (`Cedula`),
  ADD UNIQUE KEY `Correo` (`Correo`);

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`Id_Especie`),
  ADD UNIQUE KEY `Nombre_Especie` (`Nombre_Especie`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`Id_Factura`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`Id_Mascota`),
  ADD KEY `Id_Cliente` (`Id_Cliente`),
  ADD KEY `fk_mascota_especie` (`Id_Especie`),
  ADD KEY `fk_mascota_raza` (`Id_Raza`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Id_Producto`),
  ADD KEY `fk_producto_proveedor` (`Id_Proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`Id_Proveedor`),
  ADD UNIQUE KEY `Correo` (`Correo`),
  ADD UNIQUE KEY `uq_correo_proveedor` (`Correo`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`Id_Raza`),
  ADD KEY `Id_Especie` (`Id_Especie`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`Id_Tipo_Servicio`),
  ADD KEY `fk_tipo_servicio` (`tipo_servicio`);

--
-- Indices de la tabla `servicio_realizado`
--
ALTER TABLE `servicio_realizado`
  ADD PRIMARY KEY (`Id_Servicio_Realizado`),
  ADD KEY `Id_Cita` (`Id_Cita`),
  ADD KEY `Factura_Id_Factura` (`Factura_Id_Factura`),
  ADD KEY `Id_Mascota` (`Id_Mascota`),
  ADD KEY `Id_Empleado` (`Id_Empleado`),
  ADD KEY `fk_servicio_realizado_tipo_servicio` (`Id_Tipo_Servicio`);

--
-- Indices de la tabla `tipos_servicio`
--
ALTER TABLE `tipos_servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_examen`
--
ALTER TABLE `tipo_examen`
  ADD PRIMARY KEY (`id_Tipo_Examen`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `Id_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `Id_Empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `especie`
--
ALTER TABLE `especie`
  MODIFY `Id_Especie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `Id_Mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Id_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `Id_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
  MODIFY `Id_Raza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `Id_Tipo_Servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipos_servicio`
--
ALTER TABLE `tipos_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_examen`
--
ALTER TABLE `tipo_examen`
  MODIFY `id_Tipo_Examen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`Id_Tipo_Servicio`) REFERENCES `servicio` (`Id_Tipo_Servicio`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`Id_Mascota`) REFERENCES `mascota` (`Id_Mascota`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`Id_Empleado`) REFERENCES `empleado` (`Id_Empleado`);

--
-- Filtros para la tabla `detalles_factura`
--
ALTER TABLE `detalles_factura`
  ADD CONSTRAINT `detalles_factura_ibfk_1` FOREIGN KEY (`Id_Factura`) REFERENCES `factura` (`Id_Factura`);

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `fk_mascota_especie` FOREIGN KEY (`Id_Especie`) REFERENCES `especie` (`Id_Especie`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mascota_raza` FOREIGN KEY (`Id_Raza`) REFERENCES `raza` (`Id_Raza`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `mascota_ibfk_1` FOREIGN KEY (`Id_Cliente`) REFERENCES `cliente` (`Id_Cliente`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_proveedor` FOREIGN KEY (`Id_Proveedor`) REFERENCES `proveedor` (`Id_Proveedor`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `raza`
--
ALTER TABLE `raza`
  ADD CONSTRAINT `raza_ibfk_1` FOREIGN KEY (`Id_Especie`) REFERENCES `especie` (`Id_Especie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `fk_tipo_servicio` FOREIGN KEY (`tipo_servicio`) REFERENCES `tipos_servicio` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio_realizado`
--
ALTER TABLE `servicio_realizado`
  ADD CONSTRAINT `servicio_realizado_ibfk_1` FOREIGN KEY (`Id_Cita`) REFERENCES `cita` (`Id_Cita`),
  ADD CONSTRAINT `servicio_realizado_ibfk_2` FOREIGN KEY (`Factura_Id_Factura`) REFERENCES `factura` (`Id_Factura`),
  ADD CONSTRAINT `servicio_realizado_ibfk_3` FOREIGN KEY (`Id_Mascota`) REFERENCES `mascota` (`Id_Mascota`),
  ADD CONSTRAINT `servicio_realizado_ibfk_4` FOREIGN KEY (`Id_Empleado`) REFERENCES `empleado` (`Id_Empleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
