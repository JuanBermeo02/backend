-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-07-2025 a las 05:08:51
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
-- Base de datos: `ventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES
(1, 'Periféricos'),
(2, 'Procesadores'),
(3, 'Tarjetas Gráficas'),
(4, 'Sistemas Operativos'),
(5, 'Tarjetas Madre'),
(6, 'Unidades de Almacenamiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id_ciudad` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `fo_dpto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id_ciudad`, `nombre`, `fo_dpto`) VALUES
(1, 'Bogotá', 1),
(2, 'Medellín', 2),
(3, 'Cali', 3),
(4, 'Barranquilla', 1),
(5, 'Cartagena', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `identificacion` varchar(15) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `fo_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `identificacion`, `nombre`, `email`, `direccion`, `telefono`, `fo_ciudad`) VALUES
(1, '101234567', 'Carlos Rivera', 'carlos.rivera@gmail.com', 'Calle 200 #45-67', '30045678', 4),
(2, '1023456789', 'María López', 'maria.lopez@gmail.com', 'Carrera 67', '3005678901', 2),
(3, '1034567890', 'Jorge Sánchez', 'jorge.sanchez@gmail.com', 'Avenida 23', '3006789012', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compras` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `fo_productos` int(11) DEFAULT NULL,
  `total` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `iva` decimal(15,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compras`, `fecha`, `fo_productos`, `total`, `subtotal`, `iva`, `cantidad`) VALUES
(5, '2024-05-21', 3, 178500.00, 150000.00, 28500.00, 3),
(6, '2024-05-22', 1, 119000.00, 100000.00, 19000.00, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dpto`
--

CREATE TABLE `dpto` (
  `id_dpto` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `dpto`
--

INSERT INTO `dpto` (`id_dpto`, `nombre`) VALUES
(1, 'Cundinamarca'),
(2, 'Antioquia'),
(3, 'Valle del Cauca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `fo_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre`, `documento`, `telefono`, `direccion`, `fo_ciudad`) VALUES
(1, 'Carlos Rodríguez', '1012345678', '3001234567', 'Calle 50 #60-70', 1),
(2, 'María Gómez', '1023456789', '3002345678', 'Carrera 40 #30-20', 2),
(3, 'Juan Pérez', '1034567890', '3003456789', 'Avenida 10 #15-25', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `fo_productos` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_actualizacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `fo_productos`, `cantidad`, `fecha_actualizacion`) VALUES
(2, 1, 5, '2025-07-11'),
(3, 3, 7, '2024-07-01'),
(4, 4, 30, '2025-07-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `nombre`) VALUES
(1, 'Intel'),
(2, 'AMD'),
(3, 'NVIDIA'),
(4, 'Microsoft'),
(5, 'Logitech'),
(13, 'Corsair'),
(14, 'MSI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fo_cliente` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `fecha`, `fo_cliente`, `total`) VALUES
(1, '2025-06-27', 2, 200000.00),
(2, '2024-01-11', 3, 1500000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_productos` int(11) NOT NULL,
  `codigo` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `fo_categoria` int(11) NOT NULL,
  `valor_compra` decimal(15,2) NOT NULL,
  `valor_venta` decimal(15,2) NOT NULL,
  `fo_proveedor` int(11) NOT NULL,
  `fo_marca` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_productos`, `codigo`, `nombre`, `fo_categoria`, `valor_compra`, `valor_venta`, `fo_proveedor`, `fo_marca`, `stock`) VALUES
(1, 'HW001', 'Procesador Intel i7', 2, 800000.00, 1200000.00, 1, 1, 1),
(3, 'HW003', 'Tarjeta Gráfica NVIDIA RTX 3060', 3, 1500000.00, 2000000.00, 1, 3, 3),
(4, 'SW020', 'Licencia Windows 11', 4, 400000.00, 500000.00, 3, 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nit` varchar(150) NOT NULL,
  `razon_social` varchar(150) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contacto` varchar(150) NOT NULL,
  `fo_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nit`, `razon_social`, `direccion`, `celular`, `email`, `contacto`, `fo_ciudad`) VALUES
(1, '900123456', 'Proveedor Tech', 'Carrera 10 #20-30', '3001112233', 'contacto@tech.com', 'Juan Pérez', 1),
(2, '900654321', 'Distribuidora Hardware', 'Calle 45 #67-89', '3002223344', 'ventas@hardware.co', 'Ana López', 2),
(3, '900789012', 'Proveedor Software', 'Avenida 30 #40-50', '3003334455', 'soporte@software.com', 'Luis Gómez', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `tipo_usuario` enum('admin','vendedor','invitado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `clave`, `nombre`, `correo`, `tipo_usuario`) VALUES
(1, '61fc2c3c0c7aab68ddc7403819b6f06127b98872', 'Vendedor Pepe', 'pepe@gmail.com', 'invitado'),
(2, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Invitado Juan', 'juan@invitado.com', 'invitado'),
(3, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Vendedor María', 'maria@tiendasoftware.com', 'invitado'),
(9, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'ING Andres Parra', 'andresparra@gmail.com', 'vendedor'),
(19, 'c75c6abebd904a02e62cfe65e0a82dd55414a217', 'Rosa', 'rosa@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fo_cliente` int(11) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `iva` decimal(15,2) NOT NULL,
  `fo_usuario` int(11) NOT NULL,
  `productos` text NOT NULL,
  `estado` varchar(10) DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_ventas`, `fecha`, `fo_cliente`, `total`, `subtotal`, `iva`, `fo_usuario`, `productos`, `estado`) VALUES
(10, '2025-07-01', 1, 500000.00, 500000.00, 0.00, 3, 'a:1:{i:0;a:5:{i:0;s:5:\"SW020\";i:1;s:19:\"Licencia Windows 11\";i:2;i:500000;i:3;i:1;i:4;i:500000;}}', 'activo'),
(16, '2025-07-03', 1, 500000.00, 500000.00, 0.00, 1, 'a:1:{i:0;a:5:{i:0;s:5:\"SW020\";i:1;s:19:\"Licencia Windows 11\";i:2;i:500000;i:3;i:1;i:4;i:500000;}}', 'activo'),
(17, '2025-07-03', 1, 2000000.00, 2000000.00, 0.00, 3, 'a:1:{i:0;a:5:{i:0;s:5:\"SW020\";i:1;s:19:\"Licencia Windows 11\";i:2;i:500000;i:3;i:4;i:4;i:2000000;}}', 'activo'),
(18, '2025-07-03', 3, 300000.00, 300000.00, 0.00, 3, 'a:1:{i:0;a:5:{i:0;s:5:\"HW004\";i:1;s:19:\"Mouse Logitech G502\";i:2;i:300000;i:3;i:1;i:4;i:300000;}}', 'activo'),
(21, '2025-07-11', 1, 1700000.00, 1700000.00, 0.00, 9, 'a:2:{i:0;a:5:{i:0;s:5:\"SW020\";i:1;s:19:\"Licencia Windows 11\";i:2;i:500000;i:3;i:1;i:4;i:500000;}i:1;a:5:{i:0;s:5:\"HW001\";i:1;s:19:\"Procesador Intel i7\";i:2;i:1200000;i:3;i:1;i:4;i:1200000;}}', 'inactivo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id_ciudad`),
  ADD KEY `fo_dpto` (`fo_dpto`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fo_ciudad` (`fo_ciudad`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compras`),
  ADD KEY `fo_productos` (`fo_productos`);

--
-- Indices de la tabla `dpto`
--
ALTER TABLE `dpto`
  ADD PRIMARY KEY (`id_dpto`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `fo_ciudad` (`fo_ciudad`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `fk_inventario_producto` (`fo_productos`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fo_cliente` (`fo_cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_productos`),
  ADD KEY `fo_proveedor` (`fo_proveedor`),
  ADD KEY `fo_categoria` (`fo_categoria`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `fo_ciudad` (`fo_ciudad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `fo_usuario` (`fo_usuario`),
  ADD KEY `fo_cliente` (`fo_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `dpto`
--
ALTER TABLE `dpto`
  MODIFY `id_dpto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`fo_dpto`) REFERENCES `dpto` (`id_dpto`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`fo_ciudad`) REFERENCES `ciudad` (`id_ciudad`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`fo_productos`) REFERENCES `productos` (`id_productos`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productos` FOREIGN KEY (`fo_productos`) REFERENCES `productos` (`id_productos`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`fo_ciudad`) REFERENCES `ciudad` (`id_ciudad`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_inventario_producto` FOREIGN KEY (`fo_productos`) REFERENCES `productos` (`id_productos`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`fo_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`fo_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `fk_marca` FOREIGN KEY (`fo_marca`) REFERENCES `marca` (`id_marca`),
  ADD CONSTRAINT `fk_proveedor` FOREIGN KEY (`fo_proveedor`) REFERENCES `proveedor` (`id_proveedor`),
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`fo_marca`) REFERENCES `marca` (`id_marca`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`fo_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `fk_proveedor_ciudad` FOREIGN KEY (`fo_ciudad`) REFERENCES `ciudad` (`id_ciudad`),
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`fo_ciudad`) REFERENCES `ciudad` (`id_ciudad`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`fo_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`fo_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
