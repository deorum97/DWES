-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 07-01-2026 a las 12:03:11
-- Versión del servidor: 8.0.44
-- Versión de PHP: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--
DROP DATABASE IF EXISTS `restaurante`;
CREATE DATABASE IF NOT EXISTS `restaurante` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `restaurante`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `CodCat` int NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`CodCat`, `Nombre`, `Descripcion`) VALUES
(1, 'Bebida con alcohol', 'Bebidas alcohólicas'),
(2, 'Bebida sin alcohol', 'Refrescos y bebidas sin alcohol'),
(3, 'Comida', 'Platos y comidas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `CodPed` int NOT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Enviado` tinyint(1) DEFAULT NULL,
  `Restaurante` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosproductos`
--

CREATE TABLE `pedidosproductos` (
  `CodPedProd` int NOT NULL,
  `Pedido` int DEFAULT NULL,
  `Producto` int DEFAULT NULL,
  `Unidades` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `CodProd` int NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Descripcion` text,
  `Peso` decimal(10,2) DEFAULT NULL,
  `Stock` int DEFAULT NULL,
  `Categoria` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`CodProd`, `Nombre`, `Descripcion`, `Peso`, `Stock`, `Categoria`) VALUES
(1, 'Cerveza', 'Cerveza rubia 33cl', 330.00, 100, 1),
(2, 'Vino tinto', 'Vino tinto de la casa', 750.00, 50, 1),
(3, 'Vino blanco', 'Vino blanco seco', 750.00, 40, 1),
(4, 'Whisky', 'Whisky escocés', 700.00, 25, 1),
(5, 'Ron', 'Ron añejo', 700.00, 30, 1),
(6, 'Agua mineral', 'Agua mineral natural', 500.00, 200, 2),
(7, 'Refresco cola', 'Refresco sabor cola', 330.00, 150, 2),
(8, 'Zumo naranja', 'Zumo natural de naranja', 250.00, 100, 2),
(9, 'Tónica', 'Tónica premium', 200.00, 80, 2),
(10, 'Bebida energética', 'Bebida energética', 250.00, 90, 2),
(11, 'Hamburguesa', 'Hamburguesa de ternera', 300.00, 60, 3),
(12, 'Pizza', 'Pizza margarita', 500.00, 40, 3),
(13, 'Ensalada', 'Ensalada mixta', 250.00, 70, 3),
(14, 'Pasta', 'Pasta con salsa boloñesa', 350.00, 50, 3),
(15, 'Bocadillo', 'Bocadillo de jamón', 200.00, 80, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `CodRes` int NOT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Clave` varchar(255) DEFAULT NULL,
  `Pais` varchar(50) DEFAULT NULL,
  `CP` int DEFAULT NULL,
  `Ciudad` varchar(50) DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `restaurantes` (`CodRes`, `Correo`, `Clave`, `Pais`, `CP`, `Ciudad`, `Direccion`) VALUES
(1, 'pedidos@tabernalarioja.es', 'rioja2025', 'España', 26001, 'Logroño', 'C/ Laurel 12'),
(2, 'contacto@alfarogrill.es', 'alfaro2025', 'España', 26540, 'Alfaro', 'Av. Zaragoza 44');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`CodCat`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`CodPed`),
  ADD KEY `fk_pedidos_restaurante` (`Restaurante`);

--
-- Indices de la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  ADD PRIMARY KEY (`CodPedProd`),
  ADD KEY `fk_pp_pedido` (`Pedido`),
  ADD KEY `fk_pp_producto` (`Producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`CodProd`),
  ADD KEY `fk_productos_categoria` (`Categoria`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`CodRes`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `CodCat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `CodPed` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  MODIFY `CodPedProd` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `CodProd` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `CodRes` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_restaurante` FOREIGN KEY (`Restaurante`) REFERENCES `restaurantes` (`CodRes`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  ADD CONSTRAINT `fk_pp_pedido` FOREIGN KEY (`Pedido`) REFERENCES `pedidos` (`CodPed`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pp_producto` FOREIGN KEY (`Producto`) REFERENCES `productos` (`CodProd`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categoria` FOREIGN KEY (`Categoria `) REFERENCES `categorias` (`CodCat`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
