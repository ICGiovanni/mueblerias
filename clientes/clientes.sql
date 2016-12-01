-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Servidor: db642823290.db.1and1.com
-- Tiempo de generación: 02-09-2016 a las 11:31:23
-- Versión del servidor: 5.5.50-0+deb7u2-log
-- Versión de PHP: 5.4.45-0+deb7u4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db642823290`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidoP` varchar(100) NOT NULL,
  `apellidoM` varchar(100) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `num_exterior` varchar(50) NOT NULL,
  `num_interior` varchar(50) NOT NULL,
  `colonia` varchar(100) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `inv_phone_type` (
  `phone_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`phone_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `inv_phone_type`
--

INSERT INTO `inv_phone_type` (`phone_type_id`, `type`) VALUES
(1, 'Celular'),
(2, 'Casa'),
(3, 'Oficina'),
(4, 'Otro');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE IF NOT EXISTS cliente_telefono
(
	id_telefono INT NOT NULL AUTO_INCREMENT,
	id_cliente INT NOT NULL,
	phone_type_id INT NOT NULL,
	number VARCHAR(45),
	PRIMARY KEY(id_telefono),
	FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
	FOREIGN KEY (phone_type_id) REFERENCES inv_phone_type(phone_type_id)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS cliente_email
(
	id_email INT NOT NULL AUTO_INCREMENT,
	id_cliente INT NOT NULL,
	email VARCHAR(120),
	PRIMARY KEY(id_email),
	FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1;