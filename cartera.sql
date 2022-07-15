-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2019 a las 18:37:36
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cartera`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `usuario` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`usuario`, `clave`) VALUES
('JohanMp', 'reg01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `nitocc` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `razonSocial` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `cupoCredito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`nitocc`, `razonSocial`, `direccion`, `telefono`, `cupoCredito`) VALUES
('1020', 'Colombiana de Cine S.A.', 'Cra 80, Itagui', '4442244', 20000000),
('5050', 'Cheetos S.A.', 'Cra 30, Medellin', '4445566', 15000000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `nroFactura` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `nitocc` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `formaPago` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `vlrFactura` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`nroFactura`, `nitocc`, `fecha`, `formaPago`, `vlrFactura`) VALUES
('1010', '1020', '2019-02-01', 'Credito', 35000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `nroRecibo` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `nroFactura` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `valorAbono` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`nroRecibo`, `nroFactura`, `fecha`, `valorAbono`) VALUES
('001', '1010', '2019-02-01', 35000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`nitocc`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`nroFactura`),
  ADD KEY `nitocc` (`nitocc`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`nroRecibo`),
  ADD KEY `nroFactura` (`nroFactura`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`nitocc`) REFERENCES `cliente` (`nitocc`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`nroFactura`) REFERENCES `factura` (`nroFactura`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
