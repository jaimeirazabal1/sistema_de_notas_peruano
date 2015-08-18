-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-08-2015 a las 15:53:37
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnoasignatura`
--

CREATE TABLE IF NOT EXISTS `alumnoasignatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `asignatura_id` int(11) NOT NULL,
  `semestre_id` int(11) NOT NULL,
  `ponderacion` varchar(10) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `terminado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `codigo`, `ht`, `hp`, `th`, `cr`, `asignatura`, `semestre_id`, `estado`, `creado`, `ip`) VALUES
(1, '12C01', 2, 2, 4, 3, 'CÁLCULO EN UNA VARIANTE', 1, 1, '2015-08-18 17:59:50', '127.0.0.1'),
(3, '12C02', 2, 2, 4, 3, 'COMUNICACIÓN ORAL Y ESCRITA', 1, 1, '2015-08-18 18:28:48', '127.0.0.1'),
(4, '12C03', 1, 4, 5, 3, 'ADMINISTRACION GENERAL', 1, 1, '2015-08-18 18:29:18', '127.0.0.1');

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
(3, 'correo2@gmail.com', '16923501', '6d293fbe794b83f9f4a840c192c486f7', 'Pedro Ronald', 'Jaramillo Ruiz', 'Avenida este con oeste', '04143319808', '1', 1, '2015-08-18 16:17:39', '1940-03-15', 'Matemáticas', '127.0.0.1'),
(6, 'putito@putito.com', '19819898', 'd815366c423ac5e0f286ca7bd0c7c007', 'Charlie Pedro', 'Mata Gente', 'Santiago leon', '198198198198198198', '1', 1, '2015-08-18 17:31:30', '1969-02-28', 'Putito', '127.0.0.1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesorasignatura`
--

CREATE TABLE IF NOT EXISTS `profesorasignatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asignatura_id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `profesorasignatura`
--

INSERT INTO `profesorasignatura` (`id`, `asignatura_id`, `profesor_id`) VALUES
(3, 1, 3),
(4, 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE IF NOT EXISTS `seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asignatura_id` int(11) NOT NULL,
  `seccion` varchar(20) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
