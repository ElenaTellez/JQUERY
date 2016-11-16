-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-03-2013 a las 20:59:38
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `inmobiliaria`
--
CREATE DATABASE `inmobiliaria` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `inmobiliaria`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble`
--

CREATE TABLE IF NOT EXISTS `inmueble` (
  `idinmueble` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `idtipo` int(11) NOT NULL,
  `visita` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idinmueble`),
  KEY `idtipo` (`idtipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `inmueble`
--

INSERT INTO `inmueble` (`idinmueble`, `direccion`, `idtipo`, `visita`) VALUES
(3, 'Calle Larios, 23', 1, 0),
(4, 'Avenida de Andalucía, 34', 1, 0),
(5, 'Paseo de Reding, 77', 2, 0),
(6, 'Alameda de Colón, 12', 2, 0),
(7, 'Calle Bolivia, 11', 3, 0),
(8, 'Calle Carretería, 54', 3, 0),
(9, 'Paseo de Sancha, 33', 4, 0),
(10, 'Carretera de Olias, 45', 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listavisita`
--

CREATE TABLE IF NOT EXISTS `listavisita` (
  `idlistavisita` int(11) NOT NULL AUTO_INCREMENT,
  `idvisita` int(11) NOT NULL,
  `idinmueble` int(11) NOT NULL,
  `numero` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idlistavisita`),
  KEY `idvisita` (`idvisita`),
  KEY `idinmueble` (`idinmueble`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`idtipo`, `nombre`) VALUES
(1, 'Estudio'),
(2, 'Apartamento'),
(3, 'Piso'),
(4, 'Chalet');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE IF NOT EXISTS `visita` (
  `idvisita` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `confirmada` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idvisita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inmueble`
--
ALTER TABLE `inmueble`
  ADD CONSTRAINT `inmueble_ibfk_1` FOREIGN KEY (`idtipo`) REFERENCES `tipo` (`idtipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `listavisita`
--
ALTER TABLE `listavisita`
  ADD CONSTRAINT `listavisita_ibfk_1` FOREIGN KEY (`idvisita`) REFERENCES `visita` (`idvisita`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `listavisita_ibfk_2` FOREIGN KEY (`idinmueble`) REFERENCES `inmueble` (`idinmueble`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
