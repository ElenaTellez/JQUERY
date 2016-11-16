-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-01-2014 a las 09:09:48
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.4.0beta2-dev

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `olimpliadas`
--
CREATE DATABASE `olimpliadas` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `olimpliadas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atleta`
--

CREATE TABLE IF NOT EXISTS `atleta` (
  `idatleta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE ucs2_spanish2_ci NOT NULL,
  `iddeporte` int(11) NOT NULL,
  PRIMARY KEY (`idatleta`),
  KEY `iddeporte` (`iddeporte`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish2_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `atleta`
--

INSERT INTO `atleta` (`idatleta`, `nombre`, `iddeporte`) VALUES
(1, 'Rafael Nadal', 1),
(2, 'Roger Fereder', 1),
(3, 'Novac Djokovic', 1),
(4, 'haile gebreselassie', 2),
(5, 'Kenenisa Bekele', 2),
(6, 'Bernard Lagat ', 2),
(7, 'Michael Phelps', 3),
(8, 'Alain Bernard', 3),
(9, 'Alberto Contador', 4),
(10, 'Lance Armstrong', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deporte`
--

CREATE TABLE IF NOT EXISTS `deporte` (
  `iddeporte` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE ucs2_spanish2_ci NOT NULL,
  PRIMARY KEY (`iddeporte`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish2_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `deporte`
--

INSERT INTO `deporte` (`iddeporte`, `nombre`) VALUES
(1, 'Tenis'),
(2, 'Atletismo'),
(3, 'Natacion'),
(4, 'Ciclismo');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `atleta`
--
ALTER TABLE `atleta`
  ADD CONSTRAINT `atleta_ibfk_1` FOREIGN KEY (`iddeporte`) REFERENCES `deporte` (`iddeporte`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
