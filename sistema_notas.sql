-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-08-2015 a las 19:13:04
-- Versión del servidor: 5.5.44-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sistema_notas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semestre_id` int(11) NOT NULL,
  `seccion_id` int(11) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `direccion` text NOT NULL,
  `celular` varchar(20) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`,`celular`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id`, `semestre_id`, `seccion_id`, `dni`, `nombres`, `apellidos`, `direccion`, `celular`, `estado`, `creado`, `ip`) VALUES
(1, 1, 1, '1111111', 'Pepe', 'Rosalvo', 'Direccion de pepe', '11111111', 1, '2015-08-25 22:41:34', '127.0.0.1'),
(2, 1, 1, '22222222', 'Pedro', 'Castaneda', 'Direccion de pedro', '222222222', 1, '2015-08-25 22:41:58', '127.0.0.1'),
(3, 1, 1, '33333333', 'Rosa', 'Camacho', 'Direccion de rosa', '33333333333', 1, '2015-08-25 22:42:22', '127.0.0.1'),
(4, 1, 1, '44444444', 'Carmen', 'Santander', 'Direccion de carmen', '44444444', 1, '2015-08-25 22:43:15', '127.0.0.1'),
(5, 1, 1, '55555555', 'Roxana', 'Medina', 'Direccion de roxana', '5555555555', 1, '2015-08-25 22:43:38', '127.0.0.1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnoasignatura`
--

CREATE TABLE IF NOT EXISTS `alumnoasignatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `descripcion` text NOT NULL,
  `estrategia` text NOT NULL,
  `unidad` varchar(20) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `asignatura_id` int(11) NOT NULL,
  `semestre_id` int(11) NOT NULL,
  `seccion_id` int(11) NOT NULL,
  `ponderacion` varchar(10) DEFAULT NULL,
  `profesor_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnoevaluacion`
--

CREATE TABLE IF NOT EXISTS `alumnoevaluacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incripcionalumnoasignatura_id` int(11) NOT NULL,
  `profesorevaluacion_id` int(11) NOT NULL,
  `ponderacion` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Volcado de datos para la tabla `alumnoevaluacion`
--

INSERT INTO `alumnoevaluacion` (`id`, `incripcionalumnoasignatura_id`, `profesorevaluacion_id`, `ponderacion`) VALUES
(16, 1, 4, '10'),
(17, 2, 4, '5'),
(18, 3, 4, '10'),
(19, 4, 4, '20'),
(20, 5, 4, '5'),
(21, 1, 5, '11'),
(22, 2, 5, '10'),
(23, 3, 5, '5'),
(24, 4, 5, '20'),
(25, 5, 5, '5'),
(26, 1, 6, '5'),
(27, 2, 6, '20'),
(28, 3, 6, '10'),
(29, 4, 6, '20'),
(30, 5, 6, '10'),
(31, 6, 7, '20'),
(32, 7, 7, '5'),
(33, 8, 7, '10'),
(34, 9, 7, '20'),
(35, 10, 7, '5'),
(36, 6, 8, '20'),
(37, 7, 8, '5'),
(38, 8, 8, '5'),
(39, 9, 8, '20'),
(40, 10, 8, '10'),
(41, 6, 9, '20'),
(42, 7, 9, '10'),
(43, 8, 9, '20'),
(44, 9, 9, '20'),
(45, 10, 9, '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE IF NOT EXISTS `asignatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `ht` int(11) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `th` int(11) DEFAULT NULL,
  `cr` int(11) DEFAULT NULL,
  `asignatura` varchar(100) NOT NULL,
  `semestre_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(35) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `asignatura` (`asignatura`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `codigo`, `ht`, `hp`, `th`, `cr`, `asignatura`, `semestre_id`, `estado`, `creado`, `ip`) VALUES
(1, '1203', 2, 2, 4, 4, 'Matematicas', 1, 1, '2015-08-25 22:40:52', '127.0.0.1'),
(2, '1202', 2, 2, 2, 4, 'Matematicas II', 2, 1, '2015-08-25 23:07:50', '127.0.0.1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incripcionalumnoasignatura`
--

CREATE TABLE IF NOT EXISTS `incripcionalumnoasignatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profesorasignatura_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `incripcionalumnoasignatura`
--

INSERT INTO `incripcionalumnoasignatura` (`id`, `creado`, `profesorasignatura_id`, `alumno_id`) VALUES
(1, '2015-08-25 22:45:18', 1, 1),
(2, '2015-08-25 22:45:30', 1, 2),
(3, '2015-08-25 22:45:46', 1, 3),
(4, '2015-08-25 22:45:57', 1, 4),
(5, '2015-08-25 22:46:07', 1, 5),
(6, '2015-08-25 23:10:00', 2, 1),
(7, '2015-08-25 23:10:07', 2, 2),
(8, '2015-08-25 23:10:17', 2, 3),
(9, '2015-08-25 23:10:24', 2, 4),
(10, '2015-08-25 23:10:31', 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE IF NOT EXISTS `profesor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(100) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `direccion` text NOT NULL,
  `celular` varchar(20) NOT NULL,
  `tipo_usuario` varchar(4) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fnacimiento` date NOT NULL,
  `especialidad` varchar(50) NOT NULL,
  `ip` varchar(35) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`,`celular`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id`, `correo`, `dni`, `password`, `nombres`, `apellidos`, `direccion`, `celular`, `tipo_usuario`, `estado`, `creado`, `fnacimiento`, `especialidad`, `ip`) VALUES
(1, 'correo1@gmail.com', '16923509', 'e1f5e60b6d3dfa77b09e1c8daa8fa0ce', 'Pepito Alonzo', 'Camacaro Mendoza', 'Qta Tucan', '04143299925', '0', 1, '2015-08-18 15:50:04', '1969-12-31', 'Desarrollador', '127.0.0.1'),
(3, 'correo2@gmail.com', '16923501', '7d3ff5e583a1727c07bd911d427b514b', 'Pedro Ronald', 'Jaramillo Ruiz', 'Avenida este con oeste', '04143319808', '1', 1, '2015-08-18 16:17:39', '1940-03-15', 'Matemáticas', '127.0.0.1'),
(6, 'putito@putito.com', '19819898', 'd815366c423ac5e0f286ca7bd0c7c007', 'Charlie Pedro', 'Mata Gente', 'Santiago leon', '198198198198198198', '1', 1, '2015-08-18 17:31:30', '1969-02-28', 'Putito', '127.0.0.1'),
(7, 'juan@jaun.com', '11111111', '1bbd886460827015e5d605ed44252251', 'Juan', 'Medina', 'Direccion de profesor de matematicas juan', '4444444444', '1', 1, '2015-08-25 22:44:46', '1970-01-14', 'Matematicas', '127.0.0.1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesorasignatura`
--

CREATE TABLE IF NOT EXISTS `profesorasignatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seccion_id` int(11) NOT NULL,
  `semestre_id` int(11) NOT NULL,
  `asignatura_id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `profesorasignatura`
--

INSERT INTO `profesorasignatura` (`id`, `seccion_id`, `semestre_id`, `asignatura_id`, `profesor_id`) VALUES
(1, 1, 1, 1, 7),
(2, 4, 2, 2, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesorevaluacion`
--

CREATE TABLE IF NOT EXISTS `profesorevaluacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profesorasignatura_id` int(11) NOT NULL,
  `unidad` varchar(30) NOT NULL,
  `tipoevaluacion` varchar(100) NOT NULL,
  `porcentaje` varchar(4) NOT NULL,
  `fecha` date NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `profesorevaluacion`
--

INSERT INTO `profesorevaluacion` (`id`, `profesorasignatura_id`, `unidad`, `tipoevaluacion`, `porcentaje`, `fecha`, `creado`) VALUES
(4, 1, 'Unidad 1', 'Examen Escrito', '30%', '2015-08-19', '2015-08-25 22:48:44'),
(5, 1, 'Unidad 2', 'Examen Escrito', '40%', '2015-08-27', '2015-08-25 22:48:59'),
(6, 1, 'Unidad 3', 'Examen Escrito', '30%', '2015-09-24', '2015-08-25 22:49:22'),
(7, 2, 'Unidad 1', 'Examen Escrito', '30%', '2015-08-06', '2015-08-25 23:12:05'),
(8, 2, 'Unidad 2', 'Examen Escrito', '30%', '2015-09-17', '2015-08-25 23:12:31'),
(9, 2, 'Unidad 3', 'Examen Escrito', '40%', '2015-08-22', '2015-08-25 23:13:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE IF NOT EXISTS `seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semestre_id` int(11) NOT NULL,
  `seccion` varchar(20) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id`, `semestre_id`, `seccion`, `creado`) VALUES
(1, 1, 'A', '2015-08-25 22:40:13'),
(2, 1, 'B', '2015-08-25 22:40:24'),
(3, 1, 'C', '2015-08-25 22:40:31'),
(4, 2, 'A', '2015-08-25 23:08:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestre`
--

CREATE TABLE IF NOT EXISTS `semestre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(5) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `semestre`
--

INSERT INTO `semestre` (`id`, `numero`, `creado`) VALUES
(1, 'I', '2015-08-18 15:37:01'),
(2, 'II', '2015-08-18 15:37:01'),
(3, 'III', '2015-08-18 15:37:01'),
(4, 'IV', '2015-08-18 15:37:01'),
(5, 'V', '2015-08-18 15:37:01'),
(6, 'VI', '2015-08-18 15:37:01'),
(7, 'VII', '2015-08-18 15:37:01'),
(8, 'VIII', '2015-08-18 15:37:01'),
(9, 'IX', '2015-08-18 15:37:01'),
(10, 'X', '2015-08-18 15:37:01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
