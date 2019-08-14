-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-08-2019 a las 21:16:09
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `invitados`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarImagen` (IN `ruta` VARCHAR(200), IN `invitados` VARCHAR(100), OUT `actualizados` VARCHAR(50))  BEGIN
UPDATE invitados set codigo = ruta where id in (invitados);
set actualizados  = ROW_COUNT();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `limpiarCodigos` (IN `_graduado` INT, OUT `affected_rows` INT)  BEGIN
	UPDATE invitados set codigo = null where codigo is not null and graduado=_graduado;
    SET affected_rows = ROW_COUNT();
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `graduados`
--

CREATE TABLE `graduados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `invitados` int(11) NOT NULL DEFAULT '0',
  `correo` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `graduados`
--

INSERT INTO `graduados` (`id`, `nombre`, `apellidos`, `invitados`, `correo`) VALUES
(1, 'Enrique', 'Damasco Alducin', 23, 'enriquealducin@siswebs.com.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitados`
--

CREATE TABLE `invitados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `graduado` int(11) NOT NULL,
  `mesa` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '2',
  `tipo` char(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A',
  `codigo` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `invitados`
--

INSERT INTO `invitados` (`id`, `nombre`, `graduado`, `mesa`, `status`, `tipo`, `codigo`) VALUES
(1, 'Sonia Alducin Guajardo', 1, 6, 2, 'A', '1565809486.png'),
(2, 'Victor Vazquez Velazquez', 1, 6, 2, 'A', '1565809486.png'),
(3, 'Enrique Damasco Alducin', 1, 6, 2, 'A', '1565809486.png'),
(4, 'Francisca Guajardo', 1, 1, 2, 'A', NULL),
(5, 'Jasiel Alducin', 1, 1, 2, 'A', NULL),
(6, 'Diego Alducin', 1, 1, 2, 'A', NULL),
(7, 'Christian Alducin', 1, 1, 2, 'A', NULL),
(8, 'Adrian Segundo', 1, 1, 2, 'A', NULL),
(9, 'Brian Jasiel Segundo', 1, 1, 2, 'A', NULL),
(10, 'Carlos Axel Chavarria', 1, 1, 2, 'A', NULL),
(11, 'Stephanie Padilla', 1, 1, 2, 'A', NULL),
(12, 'Ariadna Gomez', 1, 1, 2, 'A', NULL),
(13, 'Valeria Sanchez', 1, 1, 2, 'A', NULL),
(14, 'Mari Velazquez', 1, 2, 2, 'A', NULL),
(15, 'Israel Vazquez', 1, 2, 2, 'A', NULL),
(16, 'Eduardo Vazquez', 1, 2, 2, 'A', NULL),
(17, 'Samanta Iliana Baez', 1, 2, 2, 'A', NULL),
(18, 'Ximena Vazquez', 1, 2, 2, 'A', NULL),
(19, 'Roxana Vazquez', 1, 2, 2, 'A', NULL),
(20, 'Margarita Martinez', 1, 2, 2, 'A', NULL),
(21, 'Marlem Gomez', 1, 2, 2, 'A', NULL),
(22, 'Verenice Gomez', 1, 2, 2, 'A', NULL),
(23, 'Avril Romero', 1, 2, 2, 'A', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugaresxMesa`
--

CREATE TABLE `lugaresxMesa` (
  `id` int(11) NOT NULL,
  `graduado` int(11) DEFAULT NULL,
  `mesa` int(11) DEFAULT NULL,
  `lugares` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lugaresxMesa`
--

INSERT INTO `lugaresxMesa` (`id`, `graduado`, `mesa`, `lugares`) VALUES
(1, 1, 1, 10),
(2, 1, 2, 10),
(3, 1, 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `mesa` varchar(11) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `mesa`) VALUES
(1, 'mesa 1'),
(2, 'mesa 2'),
(3, 'mesa 3'),
(4, 'mesa 4'),
(5, 'mesa 5'),
(6, 'mesa 6'),
(7, 'mesa 7'),
(8, 'mesa 8'),
(9, 'mesa 9'),
(10, 'mesa 10'),
(11, 'mesa 11'),
(12, 'mesa 12'),
(13, 'mesa 13'),
(14, 'mesa 14'),
(15, 'mesa 15'),
(16, 'mesa 16'),
(17, 'mesa 17'),
(18, 'mesa 18'),
(19, 'mesa 19'),
(20, 'mesa 20'),
(21, 'mesa 21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `graduados`
--
ALTER TABLE `graduados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `invitados`
--
ALTER TABLE `invitados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lugaresxMesa`
--
ALTER TABLE `lugaresxMesa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `graduados`
--
ALTER TABLE `graduados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `invitados`
--
ALTER TABLE `invitados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `lugaresxMesa`
--
ALTER TABLE `lugaresxMesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
