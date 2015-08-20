-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-08-2015 a las 12:10:37
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id`, `semestre_id`, `seccion_id`, `dni`, `nombres`, `apellidos`, `direccion`, `celular`, `estado`, `creado`, `ip`) VALUES
(1, 1, 1, '19519519', 'Pedro Rodolfo', 'Alvarez Guedes', 'Por aqui por alla', '12153152136512136', 1, '2015-08-19 01:11:45', '127.0.0.1'),
(3, 2, 5, '12312312', 'Pepe Carlos', 'Montoya San Diego', 'Avenida boyaca', '4489498498948', 1, '2015-08-19 13:26:26', '127.0.0.1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `alumnoasignatura`
--

INSERT INTO `alumnoasignatura` (`id`, `fecha`, `descripcion`, `estrategia`, `unidad`, `creado`, `asignatura_id`, `semestre_id`, `seccion_id`, `ponderacion`, `profesor_id`, `alumno_id`, `terminado`) VALUES
(5, '2015-08-20', 'La descripción que le toca', 'LA estrategia es la que se', 'unidad 1', '2015-08-19 16:30:47', 5, 2, 5, '0%', 6, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `codigo`, `ht`, `hp`, `th`, `cr`, `asignatura`, `semestre_id`, `estado`, `creado`, `ip`) VALUES
(1, '12C01', 2, 2, 4, 3, 'CÁLCULO EN UNA VARIANTE', 1, 1, '2015-08-18 17:59:50', '127.0.0.1'),
(3, '12C02', 2, 2, 4, 3, 'COMUNICACIÓN ORAL Y ESCRITA', 1, 1, '2015-08-18 18:28:48', '127.0.0.1'),
(4, '12C03', 1, 4, 5, 3, 'ADMINISTRACION GENERAL', 1, 1, '2015-08-18 18:29:18', '127.0.0.1'),
(5, '12C012', 1, 1, 1, 1, 'MATEMÁTICAS', 2, 1, '2015-08-19 14:15:54', '127.0.0.1');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id`, `correo`, `dni`, `password`, `nombres`, `apellidos`, `direccion`, `celular`, `tipo_usuario`, `estado`, `creado`, `fnacimiento`, `especialidad`, `ip`) VALUES
(1, 'correo1@gmail.com', '16923509', 'e1f5e60b6d3dfa77b09e1c8daa8fa0ce', 'Pepito Alonzo', 'Camacaro Mendoza', 'Qta Tucan', '04143299925', '0', 1, '2015-08-18 15:50:04', '1969-12-31', 'Desarrollador', '127.0.0.1'),
(3, 'correo2@gmail.com', '16923501', '7d3ff5e583a1727c07bd911d427b514b', 'Pedro Ronald', 'Jaramillo Ruiz', 'Avenida este con oeste', '04143319808', '1', 1, '2015-08-18 16:17:39', '1940-03-15', 'Matemáticas', '127.0.0.1'),
(6, 'putito@putito.com', '19819898', 'd815366c423ac5e0f286ca7bd0c7c007', 'Charlie Pedro', 'Mata Gente', 'Santiago leon', '198198198198198198', '1', 1, '2015-08-18 17:31:30', '1969-02-28', 'Putito', '127.0.0.1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `profesorasignatura`
--

INSERT INTO `profesorasignatura` (`id`, `seccion_id`, `semestre_id`, `asignatura_id`, `profesor_id`) VALUES
(8, 1, 1, 1, 3),
(9, 1, 1, 4, 3),
(11, 3, 1, 3, 3),
(12, 1, 1, 4, 1),
(13, 5, 2, 5, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `profesorevaluacion`
--

INSERT INTO `profesorevaluacion` (`id`, `profesorasignatura_id`, `unidad`, `tipoevaluacion`, `porcentaje`, `fecha`, `creado`) VALUES
(1, 8, 'unidad 1', 'examen escrito', '30%', '2015-08-31', '2015-08-20 14:50:42'),
(8, 8, 'Unidad 2', 'Prueba oral', '40%', '2015-09-03', '2015-08-20 15:07:25'),
(10, 8, 'Unidad 2', 'Prueba oral', '20%', '2015-09-03', '2015-08-20 15:08:50'),
(11, 8, 'Unidad 2', 'Trabajo Escrito', '10%', '2015-09-11', '2015-08-20 15:09:04');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id`, `semestre_id`, `seccion`, `creado`) VALUES
(1, 1, 'A', '2015-08-19 12:18:00'),
(2, 1, 'B', '2015-08-19 12:18:00'),
(3, 1, 'C', '2015-08-19 12:18:02'),
(5, 2, 'A', '2015-08-19 12:34:52'),
(6, 3, 'A', '2015-08-19 12:40:01');

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