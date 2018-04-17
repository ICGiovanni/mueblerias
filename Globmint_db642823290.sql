-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Servidor: db642823290.db.1and1.com
-- Tiempo de generación: 17-04-2018 a las 12:21:56
-- Versión del servidor: 5.5.59-0+deb7u1-log
-- Versión de PHP: 5.4.45-0+deb7u13

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
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_name` varchar(64) DEFAULT NULL,
  `categoria_abrev` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `categoria_name`, `categoria_abrev`) VALUES
(3, 'SOFA CAMA', ''),
(4, 'REPOSET', ''),
(5, 'SALA', ''),
(6, 'SILLON', ''),
(7, 'SOFA 3-2-1', ''),
(8, 'LOVE SEAT', ''),
(9, 'SALA 2-2-T', ''),
(10, 'CHAISE LONGUE', ''),
(11, 'FUTON', ''),
(12, 'SALA 2-2-E', ''),
(13, 'SALA MODULAR', ''),
(14, 'SALA 3-2-T', ''),
(15, 'COLCHON', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL DEFAULT 'N/A',
  `apellidoP` varchar(100) NOT NULL DEFAULT 'N/A',
  `apellidoM` varchar(100) NOT NULL DEFAULT 'N/A',
  `rating` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellidoP`, `apellidoM`, `rating`) VALUES
(2, 'Uriel', 'Medina', ' ', 3),
(4, 'Juan ', 'Perez', 'Perez', 0),
(5, 'Ramiro', 'Ramirez', 'Perez', 0),
(6, 'J', 'H', 'H', 0),
(7, 'Edgar', 'Montoya', 'C', 4),
(8, 'sadsad', 'sadsada', 'sadasd', 0),
(9, 'Julio', 'Rodriguez', 'Juarez', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_direccion`
--

CREATE TABLE IF NOT EXISTS `cliente_direccion` (
  `cliente_direccion_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `cliente_direccion_tipo_id` int(11) NOT NULL,
  `cliente_direccion_calle` varchar(255) NOT NULL,
  `cliente_direccion_numero_ext` varchar(50) DEFAULT NULL,
  `cliente_direccion_numero_int` varchar(50) DEFAULT NULL,
  `cliente_direccion_colonia` varchar(255) NOT NULL,
  `cliente_direccion_municipio` varchar(255) NOT NULL,
  `id_estado` varchar(255) NOT NULL,
  `cliente_direccion_cp` int(11) NOT NULL,
  `cliente_direccion_rfc` varchar(50) DEFAULT NULL,
  `cliente_direccion_razon_social` varchar(500) DEFAULT NULL,
  `cliente_direccion_entre_calles` tinytext,
  PRIMARY KEY (`cliente_direccion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `cliente_direccion`
--

INSERT INTO `cliente_direccion` (`cliente_direccion_id`, `cliente_id`, `cliente_direccion_tipo_id`, `cliente_direccion_calle`, `cliente_direccion_numero_ext`, `cliente_direccion_numero_int`, `cliente_direccion_colonia`, `cliente_direccion_municipio`, `id_estado`, `cliente_direccion_cp`, `cliente_direccion_rfc`, `cliente_direccion_razon_social`, `cliente_direccion_entre_calles`) VALUES
(1, 7, 1, 'Francisco Goitia', '2347', NULL, 'Bonanza', 'Metepec', '13', 52160, '', '', NULL),
(2, 7, 2, 'Calle Del Censo', '12', NULL, 'Ixcotla', 'Santa Ana Chiahutempan', '18', 90810, '', '', NULL),
(3, 7, 1, 'Camelia', '227', '103', 'Buena Vista', 'Cuautemoc', '15', 50290, '', '', NULL),
(4, 7, 2, 'Luis Lagarto', '2115', NULL, 'Banus', 'Metepec', '13', 52160, '', '', 'calles de referencia'),
(5, 0, 1, 'sadsadas', 'asdasdas', '', 'sadasd', 'sadasd', '6', 0, 'sadsad', 'asdsad', ''),
(6, 0, 1, 'sadasd', 'sadasd', '', 'asdasd', 'sadasdsa', '6', 0, 'asdasd', 'sadasdas', ''),
(7, 0, 1, 'sadasdasd', '44343', '', 'sadasd34543435', 'asdasdasd', '1', 34234, 'sadsadsa', 'sadasdasd', ''),
(8, 2, 2, 'Calle envio', 'envio', '', 'colonia envio', 'municipio envio', '1', 500212, '', '', 'sadasdasd'),
(9, 2, 1, 'calle facturacion', '54545', '', 'colonia facturacion', 'municipio facturacion', '2', 552120, 'rfcfacturacion', 'calle facturacion', 'asdasdas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_direccion_tipo`
--

CREATE TABLE IF NOT EXISTS `cliente_direccion_tipo` (
  `cliente_direccion_tipo_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_direccion_tipo_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`cliente_direccion_tipo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `cliente_direccion_tipo`
--

INSERT INTO `cliente_direccion_tipo` (`cliente_direccion_tipo_id`, `cliente_direccion_tipo_desc`) VALUES
(1, 'facturacion'),
(2, 'envio'),
(3, 'ambos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_email`
--

CREATE TABLE IF NOT EXISTS `cliente_email` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id_email`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `cliente_email`
--

INSERT INTO `cliente_email` (`id_email`, `id_cliente`, `email`) VALUES
(2, 5, 'abcd@hotmail.com'),
(3, 5, 'qwert.qwert@gmail.com'),
(4, 6, 'hola@hotmail.com'),
(6, 7, 'shingoo_n@yahoo.com.mx'),
(19, 8, 'sadsasad@dfsddsf.com'),
(20, 9, 'juarez@hotmail.com'),
(21, 9, 'julio@hotmail.com'),
(24, 2, 'umedina86@yahoo.com.mx'),
(25, 2, 'umedina86@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_telefono`
--

CREATE TABLE IF NOT EXISTS `cliente_telefono` (
  `id_telefono` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `phone_type_id` int(11) NOT NULL,
  `number` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_telefono`),
  KEY `id_cliente` (`id_cliente`),
  KEY `phone_type_id` (`phone_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `cliente_telefono`
--

INSERT INTO `cliente_telefono` (`id_telefono`, `id_cliente`, `phone_type_id`, `number`) VALUES
(12, 4, 1, '55 55 55 55'),
(13, 4, 2, '22 22 22 22'),
(14, 4, 3, '33 33 33 33'),
(16, 5, 1, '55 00 00 00 00 '),
(17, 5, 3, '55 00 00 00 '),
(18, 6, 1, '5'),
(21, 7, 1, '55 55 05 65 35 '),
(26, 8, 1, '33 23 23 23 23 2'),
(27, 9, 1, '55 33 33 33 33 '),
(28, 9, 2, '52 24 24 24 '),
(31, 2, 1, '55555555'),
(32, 2, 1, '00 00 00 00 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE IF NOT EXISTS `colores` (
  `color_id` int(11) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(64) DEFAULT NULL,
  `color_abrev` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`color_id`, `color_name`, `color_abrev`) VALUES
(4, 'CHOCOLATE', 'CHO'),
(5, 'SHEDRON', 'SHE'),
(6, 'NEGRO', 'NE'),
(7, 'BLANCO', ''),
(8, 'GRIS', ''),
(9, 'BEIGE', ''),
(11, 'ESPECIAL', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte_caja_final`
--

CREATE TABLE IF NOT EXISTS `corte_caja_final` (
  `corte_final_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`corte_final_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `corte_caja_final`
--

INSERT INTO `corte_caja_final` (`corte_final_id`, `usuario_id`, `sucursal_id`, `date`) VALUES
(1, 1, 1, '2018-01-22 09:55:19'),
(2, 1, 1, '2018-02-01 03:47:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte_caja_final_parcial`
--

CREATE TABLE IF NOT EXISTS `corte_caja_final_parcial` (
  `corte_final_id` int(11) NOT NULL,
  `corte_parcial_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `corte_caja_final_parcial`
--

INSERT INTO `corte_caja_final_parcial` (`corte_final_id`, `corte_parcial_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte_caja_parcial`
--

CREATE TABLE IF NOT EXISTS `corte_caja_parcial` (
  `corte_parcial_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL DEFAULT '1',
  `sucursal_id` int(11) NOT NULL DEFAULT '1',
  `date` datetime NOT NULL,
  PRIMARY KEY (`corte_parcial_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `corte_caja_parcial`
--

INSERT INTO `corte_caja_parcial` (`corte_parcial_id`, `usuario_id`, `sucursal_id`, `date`) VALUES
(1, 1, 1, '2018-01-22 09:51:51'),
(2, 1, 1, '2018-02-01 03:39:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte_parcial_ventas`
--

CREATE TABLE IF NOT EXISTS `corte_parcial_ventas` (
  `corte_parcial_id` int(11) NOT NULL DEFAULT '0',
  `ventas_pago_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `corte_parcial_ventas`
--

INSERT INTO `corte_parcial_ventas` (`corte_parcial_id`, `ventas_pago_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 7),
(1, 8),
(2, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(0, ''),
(1, 'Aguascalientes'),
(2, 'Baja California'),
(3, 'Baja California Sur'),
(4, 'Campeche'),
(5, 'Ciudad de México'),
(6, 'Chiapas'),
(7, 'Chihuahua'),
(8, 'Coahuila'),
(9, 'Colima'),
(10, 'Durango'),
(11, 'Estado de México'),
(12, 'Guanajuato'),
(13, 'Guerrero'),
(14, 'Hidalgo'),
(15, 'Jalisco'),
(16, 'Michoacán'),
(17, 'Morelos'),
(18, 'Nayarit'),
(19, 'Nuevo León'),
(20, 'Oaxaca'),
(21, 'Puebla'),
(22, 'Querétaro'),
(23, 'Quintana Roo'),
(24, 'San Luis Potosí'),
(25, 'Sinaloa'),
(26, 'Sonora'),
(27, 'Tabasco'),
(28, 'Tamaulipas'),
(29, 'Tlaxcala'),
(30, 'Veracruz'),
(31, 'Yucatán'),
(32, 'Zacatecas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `evento_id` int(11) NOT NULL AUTO_INCREMENT,
  `evento_nombre` varchar(100) DEFAULT NULL,
  `evento_fecha` datetime DEFAULT NULL,
  `evento_desc` varchar(255) DEFAULT NULL,
  `evento_recordatorio_activo` int(11) DEFAULT NULL,
  `evento_recordatorio_fecha` datetime DEFAULT NULL,
  `evento_recordatorio_enviado` int(11) DEFAULT NULL,
  `login_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`evento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`evento_id`, `evento_nombre`, `evento_fecha`, `evento_desc`, `evento_recordatorio_activo`, `evento_recordatorio_fecha`, `evento_recordatorio_enviado`, `login_id`) VALUES
(13, 'PAGO LUZ', '2016-11-12 12:00:00', 'REFORMA', 1, '2016-11-11 12:00:00', 0, 1),
(14, 'Pedido Proveedor', '0000-00-00 00:00:00', '', 1, '0000-00-00 00:00:00', 0, 1),
(15, 'Pedido Proveedor', '2016-12-12 00:00:00', 'Observaciones nuevo pedido', 1, '2016-12-12 00:00:00', 0, 1),
(16, 'Pedido Proveedor', '2017-02-28 00:00:00', 'Observaciones de entrega', 1, '2017-02-14 00:00:00', 0, 1),
(17, 'Pedido Proveedor', '2017-02-14 00:00:00', '', 1, '2017-03-01 00:00:00', 0, 1),
(18, 'Pedido Proveedor', '2017-02-20 00:00:00', 'obs', 1, '2017-03-07 00:00:00', 0, 1),
(19, 'Pedido Proveedor', '2017-02-21 00:00:00', 'asda', 1, '2017-02-22 00:00:00', 0, 1),
(20, 'Pedido Proveedor', '2017-02-06 00:00:00', 'asd', 1, '2017-02-23 00:00:00', 0, 1),
(21, 'Pedido Proveedor', '2017-02-22 00:00:00', 'asdas', 1, '2017-02-28 00:00:00', 0, 1),
(22, 'Pedido Proveedor', '2017-03-01 00:00:00', 'sdf', 1, '2017-02-20 00:00:00', 0, 1),
(23, 'Pedido Proveedor', '2017-02-22 00:00:00', 'sdf', 1, '2017-02-28 00:00:00', 0, 1),
(24, 'Pedido Proveedor', '2017-02-21 00:00:00', 'dfg', 1, '2017-02-20 00:00:00', 0, 1),
(25, 'Pedido Proveedor', '2017-03-01 00:00:00', 'OBS', 1, '2017-02-25 00:00:00', 0, 1),
(26, 'Pedido Proveedor', '2017-02-28 00:00:00', '123', 1, '2017-02-27 00:00:00', 0, 1),
(27, 'fdsdf', '2017-03-30 12:00:00', 'test', 0, '2017-03-30 12:00:00', 0, 1),
(28, 'Cita Miel', '2017-04-29 12:00:00', 'Entregan Chequeras', 1, '2017-04-28 12:00:00', 0, 1),
(29, 'Pedido Proveedor', '2017-06-28 00:00:00', '', 1, '2017-06-27 00:00:00', 0, 1),
(30, 'Pedido Proveedor', '2017-06-25 00:00:00', '', 1, '2017-06-25 00:00:00', 0, 1),
(31, 'Pedido Proveedor', '2017-07-25 00:00:00', 'entre', 1, '2017-07-25 00:00:00', 0, 1),
(32, 'Pedido Proveedor', '2017-09-19 00:00:00', '', 1, '2017-09-27 00:00:00', 0, 1),
(33, 'Pedido Proveedor', '2017-10-18 00:00:00', 'Test Pedido', 1, '2017-10-31 00:00:00', 0, 1),
(34, 'Pedido Proveedor', '2017-10-31 00:00:00', 'por ', 1, '2017-10-25 00:00:00', 0, 1),
(35, 'Compra mercancía', '2018-01-26 12:00:00', 'Colchón verde', 1, '2018-02-02 12:00:00', 0, 1),
(36, 'Pedido Proveedor', '2018-02-14 00:00:00', '', 1, '2018-02-20 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_gasto`
--

CREATE TABLE IF NOT EXISTS `evento_gasto` (
  `evento_gasto_id` int(11) NOT NULL AUTO_INCREMENT,
  `evento_id` int(11) DEFAULT NULL,
  `gasto_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`evento_gasto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `evento_gasto`
--

INSERT INTO `evento_gasto` (`evento_gasto_id`, `evento_id`, `gasto_id`) VALUES
(1, 13, 33),
(2, 35, 237);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE IF NOT EXISTS `gastos` (
  `gasto_id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_no_documento` varchar(255) DEFAULT NULL,
  `gasto_fecha_creacion` datetime DEFAULT NULL,
  `gasto_fecha_vencimiento` datetime DEFAULT NULL,
  `gasto_fecha_recordatorio_activo` int(11) DEFAULT NULL,
  `gasto_fecha_recordatorio` datetime DEFAULT NULL,
  `gasto_concepto` varchar(500) DEFAULT NULL,
  `gasto_descripcion` text,
  `gasto_monto` float DEFAULT NULL,
  `gasto_categoria_id` int(11) DEFAULT NULL,
  `gasto_beneficiario` varchar(255) DEFAULT NULL,
  `gasto_status_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `login_id` int(11) DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`gasto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=271 ;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`gasto_id`, `gasto_no_documento`, `gasto_fecha_creacion`, `gasto_fecha_vencimiento`, `gasto_fecha_recordatorio_activo`, `gasto_fecha_recordatorio`, `gasto_concepto`, `gasto_descripcion`, `gasto_monto`, `gasto_categoria_id`, `gasto_beneficiario`, `gasto_status_id`, `proveedor_id`, `login_id`, `sucursal_id`) VALUES
(1, 'Nomina semana 46', NULL, '2016-11-16 00:00:00', 0, '2016-11-16 00:00:00', 'Nomina Root Globmint, semana 46', 'Nomina Root Globmint, semana 46', 1000, 13, 'Root Globmint', 2, 0, 1, 1),
(2, 'Nomina semana 46', NULL, '2016-11-16 00:00:00', 0, '2016-11-16 00:00:00', 'Nomina Vendedor 1 Tienda, semana 46', 'Nomina Vendedor 1 Tienda, semana 46', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(3, 'Nomina semana 46', NULL, '2016-11-16 00:00:00', 0, '2016-11-16 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 46', 'Nomina vendedor 02 vendedor 02, semana 46', 500, 13, 'vendedor 02 vendedor 02', 2, 0, 50, 1),
(4, 'Nomina semana 46', NULL, '2016-11-16 00:00:00', 0, '2016-11-16 00:00:00', 'Nomina gio tes, semana 46', 'Nomina gio tes, semana 46', 1500, 13, 'gio tes', 4, 0, 51, 1),
(5, 'Nomina semana 47', NULL, '2016-11-22 00:00:00', 0, '2016-11-22 00:00:00', 'Nomina Vendedor 1 Tienda, semana 47', 'Nomina Vendedor 1 Tienda, semana 47', 500, 13, 'vendedor 02 vendedor 02', 3, 0, 50, 1),
(6, 'Nomina semana 47', NULL, '2016-11-22 00:00:00', 0, '2016-11-22 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 47', 'Nomina vendedor 02 vendedor 02, semana 47', 500, 13, 'vendedor 02 vendedor 02', 2, 0, 50, 1),
(7, 'Nomina semana 47', NULL, '2016-11-25 00:00:00', 0, '2016-11-25 00:00:00', 'Nomina Vendedor 1 Tienda, semana 47', 'Nomina Vendedor 1 Tienda, semana 47', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(8, 'Nomina semana 47', NULL, '2016-11-25 00:00:00', 0, '2016-11-25 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 47', 'Nomina vendedor 02 vendedor 02, semana 47', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(9, '01', NULL, '2016-11-25 12:00:00', 0, '2016-11-25 12:00:00', 'PRESTAMO', 'PRESTAMO A LIQUIDAR EN UN MES', 1000, 2, 'Root Globmint', 1, 0, 1, 1),
(10, 'Nomina semana 47', NULL, '2016-11-25 00:00:00', 0, '2016-11-25 00:00:00', 'Nomina Vendedor 1 Tienda, semana 47', 'Nomina Vendedor 1 Tienda, semana 47', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(11, 'Nomina semana 47', NULL, '2016-11-25 00:00:00', 0, '2016-11-25 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 47', 'Nomina vendedor 02 vendedor 02, semana 47', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(12, 'dia extra salario folio 1', NULL, '2016-11-25 02:16:57', 0, '2016-11-25 02:16:57', 'dia extra salario folio 1', 'dia extra salario folio 1', 142.86, 25, '1', 2, 0, 1, 1),
(13, '', NULL, '2016-11-25 12:00:00', 0, '2016-12-25 12:00:00', 'PRESTAMO', 'A PAGAR EN 4 SEMANAS', 5000, 2, 'gio tes', 1, 0, 51, 1),
(14, 'Nomina semana 45', NULL, '2016-11-25 00:00:00', 0, '2016-11-25 00:00:00', 'Nomina Vendedor 1 Tienda, semana 45', 'Nomina Vendedor 1 Tienda, semana 45', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(15, 'Nomina semana 45', NULL, '2016-11-25 00:00:00', 0, '2016-11-25 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 45', 'Nomina vendedor 02 vendedor 02, semana 45', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(16, 'Nomina semana 48', NULL, '2016-11-30 00:00:00', 0, '2016-11-30 00:00:00', 'Nomina Root Globmint, semana 48', 'Nomina Root Globmint, semana 48', 1000, 13, 'Root Globmint', 1, 0, 1, 1),
(17, 'Nomina semana 48', NULL, '2016-11-30 00:00:00', 0, '2016-11-30 00:00:00', 'Nomina Vendedor 1 Tienda, semana 48', 'Nomina Vendedor 1 Tienda, semana 48', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(18, 'Nomina semana 48', NULL, '2016-11-30 00:00:00', 0, '2016-11-30 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 48', 'Nomina vendedor 02 vendedor 02, semana 48', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(19, 'Nomina semana 48', NULL, '2016-11-30 00:00:00', 0, '2016-11-30 00:00:00', 'Nomina gio tes, semana 48', 'Nomina gio tes, semana 48', 1500, 13, 'gio tes', 1, 0, 51, 1),
(20, 'Nomina semana 49', NULL, '2016-12-07 00:00:00', 0, '2016-12-07 00:00:00', 'Nomina Vendedor 1 Tienda, semana 49', 'Nomina Vendedor 1 Tienda, semana 49', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(21, 'Nomina semana 49', NULL, '2016-12-07 00:00:00', 0, '2016-12-07 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 49', 'Nomina vendedor 02 vendedor 02, semana 49', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(22, 'Nomina semana 49', NULL, '2016-12-07 00:00:00', 0, '2016-12-07 00:00:00', 'Nomina jose manu, semana 49', 'Nomina jose manu, semana 49', 1000, 13, 'jose manu', 1, 0, 54, 1),
(23, 'Nomina semana 50', NULL, '2016-12-12 00:00:00', 0, '2016-12-12 00:00:00', 'Nomina Root Globmint, semana 50', 'Nomina Root Globmint, semana 50', 1000, 13, 'Root Globmint', 1, 0, 1, 1),
(24, 'Nomina semana 50', NULL, '2016-12-12 00:00:00', 0, '2016-12-12 00:00:00', 'Nomina Vendedor 1 Tienda, semana 50', 'Nomina Vendedor 1 Tienda, semana 50', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(25, 'Nomina semana 50', NULL, '2016-12-12 00:00:00', 0, '2016-12-12 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 50', 'Nomina vendedor 02 vendedor 02, semana 50', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(26, 'Nomina semana 50', NULL, '2016-12-12 00:00:00', 0, '2016-12-12 00:00:00', 'Nomina gio tes, semana 50', 'Nomina gio tes, semana 50', 1500, 13, 'gio tes', 1, 0, 51, 1),
(27, 'Nomina semana 50', NULL, '2016-12-12 00:00:00', 0, '2016-12-12 00:00:00', 'Nomina jose manu, semana 50', 'Nomina jose manu, semana 50', 1000, 13, 'jose manu', 1, 0, 54, 1),
(28, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Vendedor 1 Tienda, semana 25', 'Nomina Vendedor 1 Tienda, semana 25', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(29, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 25', 'Nomina vendedor 02 vendedor 02, semana 25', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(30, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina jose manu, semana 25', 'Nomina jose manu, semana 25', 1000, 13, 'jose manu', 1, 0, 54, 1),
(31, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Jose Ramon Martinez, semana 25', 'Nomina Jose Ramon Martinez, semana 25', 1000, 13, 'Jose Ramon Martinez', 1, 0, 55, 1),
(32, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Felipe Lara, semana 25', 'Nomina Felipe Lara, semana 25', 0, 13, 'Felipe Lara', 1, 0, 56, 1),
(33, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Felipe Montiel, semana 25', 'Nomina Felipe Montiel, semana 25', 0, 13, 'Felipe Montiel', 1, 0, 57, 1),
(34, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Jesus Garcia, semana 25', 'Nomina Jesus Garcia, semana 25', 0, 13, 'Jesus Garcia', 1, 0, 58, 1),
(35, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Jose Antonio, semana 25', 'Nomina Jose Antonio, semana 25', 0, 13, 'Jose Antonio', 1, 0, 59, 1),
(36, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Alfredo Flores, semana 25', 'Nomina Alfredo Flores, semana 25', 0, 13, 'Alfredo Flores', 1, 0, 60, 1),
(37, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Amador Ramirez, semana 25', 'Nomina Amador Ramirez, semana 25', 0, 13, 'Amador Ramirez', 1, 0, 61, 1),
(38, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Artemio Juventino Mendez, semana 25', 'Nomina Artemio Juventino Mendez, semana 25', 0, 13, 'Artemio Juventino Mendez', 1, 0, 62, 1),
(39, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Carlos Espinosa, semana 25', 'Nomina Carlos Espinosa, semana 25', 0, 13, 'Carlos Espinosa', 1, 0, 63, 1),
(40, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Emilio Morales, semana 25', 'Nomina Emilio Morales, semana 25', 0, 13, 'Emilio Morales', 1, 0, 64, 1),
(41, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Enrique Octavio SIlva, semana 25', 'Nomina Enrique Octavio SIlva, semana 25', 0, 13, 'Enrique Octavio SIlva', 1, 0, 65, 1),
(42, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Ezequiel Torres, semana 25', 'Nomina Ezequiel Torres, semana 25', 0, 13, 'Ezequiel Torres', 1, 0, 66, 1),
(43, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Fabian Mora, semana 25', 'Nomina Fabian Mora, semana 25', 0, 13, 'Fabian Mora', 1, 0, 67, 1),
(44, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Francisco Celada, semana 25', 'Nomina Francisco Celada, semana 25', 0, 13, 'Francisco Celada', 1, 0, 68, 1),
(45, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Genaro Simon, semana 25', 'Nomina Genaro Simon, semana 25', 0, 13, 'Genaro Simon', 1, 0, 69, 1),
(46, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Leonel Martinez, semana 25', 'Nomina Leonel Martinez, semana 25', 0, 13, 'Leonel Martinez', 1, 0, 70, 1),
(47, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Leonel Martinez, semana 25', 'Nomina Leonel Martinez, semana 25', 0, 13, 'Leonel Martinez', 1, 0, 71, 1),
(48, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Lucila Villaneda, semana 25', 'Nomina Lucila Villaneda, semana 25', 0, 13, 'Lucila Villaneda', 1, 0, 72, 1),
(49, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Rodolfo de Jesus Martinez, semana 25', 'Nomina Rodolfo de Jesus Martinez, semana 25', 0, 13, 'Rodolfo de Jesus Martinez', 1, 0, 73, 1),
(50, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Jose Juan Gomez, semana 25', 'Nomina Jose Juan Gomez, semana 25', 0, 13, 'Jose Juan Gomez', 1, 0, 74, 1),
(51, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Jose Jonathan Campos, semana 25', 'Nomina Jose Jonathan Campos, semana 25', 0, 13, 'Jose Jonathan Campos', 1, 0, 75, 1),
(52, 'Nomina semana 25', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Miguel Angel Vidal, semana 25', 'Nomina Miguel Angel Vidal, semana 25', 0, 13, 'Miguel Angel Vidal', 1, 0, 76, 1),
(53, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Root Globmint, semana 24', 'Nomina Root Globmint, semana 24', 1000, 13, 'Root Globmint', 1, 0, 1, 1),
(54, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Vendedor 1 Tienda, semana 24', 'Nomina Vendedor 1 Tienda, semana 24', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(55, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 24', 'Nomina vendedor 02 vendedor 02, semana 24', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(56, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina gio tes, semana 24', 'Nomina gio tes, semana 24', 1500, 13, 'gio tes', 1, 0, 51, 1),
(57, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina jose manu, semana 24', 'Nomina jose manu, semana 24', 1000, 13, 'jose manu', 1, 0, 54, 1),
(58, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Jose Ramon Martinez, semana 24', 'Nomina Jose Ramon Martinez, semana 24', 1000, 13, 'Jose Ramon Martinez', 1, 0, 55, 1),
(59, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Felipe Lara, semana 24', 'Nomina Felipe Lara, semana 24', 0, 13, 'Felipe Lara', 1, 0, 56, 1),
(60, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Felipe Montiel, semana 24', 'Nomina Felipe Montiel, semana 24', 0, 13, 'Felipe Montiel', 1, 0, 57, 1),
(61, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Jesus Garcia, semana 24', 'Nomina Jesus Garcia, semana 24', 0, 13, 'Jesus Garcia', 1, 0, 58, 1),
(62, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Jose Antonio, semana 24', 'Nomina Jose Antonio, semana 24', 0, 13, 'Jose Antonio', 1, 0, 59, 1),
(63, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Alfredo Flores, semana 24', 'Nomina Alfredo Flores, semana 24', 0, 13, 'Alfredo Flores', 1, 0, 60, 1),
(64, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Amador Ramirez, semana 24', 'Nomina Amador Ramirez, semana 24', 0, 13, 'Amador Ramirez', 1, 0, 61, 1),
(65, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Artemio Juventino Mendez, semana 24', 'Nomina Artemio Juventino Mendez, semana 24', 0, 13, 'Artemio Juventino Mendez', 1, 0, 62, 1),
(66, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Carlos Espinosa, semana 24', 'Nomina Carlos Espinosa, semana 24', 0, 13, 'Carlos Espinosa', 1, 0, 63, 1),
(67, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Emilio Morales, semana 24', 'Nomina Emilio Morales, semana 24', 0, 13, 'Emilio Morales', 1, 0, 64, 1),
(68, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Enrique Octavio SIlva, semana 24', 'Nomina Enrique Octavio SIlva, semana 24', 0, 13, 'Enrique Octavio SIlva', 1, 0, 65, 1),
(69, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Ezequiel Torres, semana 24', 'Nomina Ezequiel Torres, semana 24', 0, 13, 'Ezequiel Torres', 1, 0, 66, 1),
(70, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Fabian Mora, semana 24', 'Nomina Fabian Mora, semana 24', 0, 13, 'Fabian Mora', 1, 0, 67, 1),
(71, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Francisco Celada, semana 24', 'Nomina Francisco Celada, semana 24', 0, 13, 'Francisco Celada', 1, 0, 68, 1),
(72, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Genaro Simon, semana 24', 'Nomina Genaro Simon, semana 24', 0, 13, 'Genaro Simon', 1, 0, 69, 1),
(73, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Leonel Martinez, semana 24', 'Nomina Leonel Martinez, semana 24', 0, 13, 'Leonel Martinez', 1, 0, 70, 1),
(74, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Leonel Martinez, semana 24', 'Nomina Leonel Martinez, semana 24', 0, 13, 'Leonel Martinez', 1, 0, 71, 1),
(75, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Lucila Villaneda, semana 24', 'Nomina Lucila Villaneda, semana 24', 0, 13, 'Lucila Villaneda', 1, 0, 72, 1),
(76, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Rodolfo de Jesus Martinez, semana 24', 'Nomina Rodolfo de Jesus Martinez, semana 24', 0, 13, 'Rodolfo de Jesus Martinez', 1, 0, 73, 1),
(77, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Jose Juan Gomez, semana 24', 'Nomina Jose Juan Gomez, semana 24', 0, 13, 'Jose Juan Gomez', 1, 0, 74, 1),
(78, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Jose Jonathan Campos, semana 24', 'Nomina Jose Jonathan Campos, semana 24', 0, 13, 'Jose Jonathan Campos', 1, 0, 75, 1),
(79, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Miguel Angel Vidal, semana 24', 'Nomina Miguel Angel Vidal, semana 24', 0, 13, 'Miguel Angel Vidal', 1, 0, 76, 1),
(80, 'Nomina semana 24', NULL, '2017-06-22 00:00:00', 0, '2017-06-22 00:00:00', 'Nomina Marilu Hernandez, semana 24', 'Nomina Marilu Hernandez, semana 24', 0, 13, 'Marilu Hernandez', 1, 0, 77, 1),
(81, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Root Globmint, semana 26', 'Nomina Root Globmint, semana 26', 1000, 13, 'Root Globmint', 1, 0, 1, 1),
(82, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Vendedor 1 Tienda, semana 26', 'Nomina Vendedor 1 Tienda, semana 26', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(83, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 26', 'Nomina vendedor 02 vendedor 02, semana 26', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(84, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina gio tes, semana 26', 'Nomina gio tes, semana 26', 1500, 13, 'gio tes', 1, 0, 51, 1),
(85, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina jose manu, semana 26', 'Nomina jose manu, semana 26', 1000, 13, 'jose manu', 1, 0, 54, 1),
(86, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Jose Ramon Martinez, semana 26', 'Nomina Jose Ramon Martinez, semana 26', 1000, 13, 'Jose Ramon Martinez', 1, 0, 55, 1),
(87, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Felipe Lara, semana 26', 'Nomina Felipe Lara, semana 26', 0, 13, 'Felipe Lara', 1, 0, 56, 1),
(88, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Felipe Montiel, semana 26', 'Nomina Felipe Montiel, semana 26', 0, 13, 'Felipe Montiel', 1, 0, 57, 1),
(89, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Jesus Garcia, semana 26', 'Nomina Jesus Garcia, semana 26', 0, 13, 'Jesus Garcia', 1, 0, 58, 1),
(90, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Jose Antonio, semana 26', 'Nomina Jose Antonio, semana 26', 0, 13, 'Jose Antonio', 1, 0, 59, 1),
(91, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Alfredo Flores, semana 26', 'Nomina Alfredo Flores, semana 26', 0, 13, 'Alfredo Flores', 1, 0, 60, 1),
(92, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Amador Ramirez, semana 26', 'Nomina Amador Ramirez, semana 26', 0, 13, 'Amador Ramirez', 1, 0, 61, 1),
(93, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Artemio Juventino Mendez, semana 26', 'Nomina Artemio Juventino Mendez, semana 26', 0, 13, 'Artemio Juventino Mendez', 1, 0, 62, 1),
(94, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Carlos Espinosa, semana 26', 'Nomina Carlos Espinosa, semana 26', 0, 13, 'Carlos Espinosa', 1, 0, 63, 1),
(95, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Emilio Morales, semana 26', 'Nomina Emilio Morales, semana 26', 0, 13, 'Emilio Morales', 1, 0, 64, 1),
(96, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Enrique Octavio SIlva, semana 26', 'Nomina Enrique Octavio SIlva, semana 26', 0, 13, 'Enrique Octavio SIlva', 1, 0, 65, 1),
(97, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Ezequiel Torres, semana 26', 'Nomina Ezequiel Torres, semana 26', 0, 13, 'Ezequiel Torres', 1, 0, 66, 1),
(98, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Fabian Mora, semana 26', 'Nomina Fabian Mora, semana 26', 0, 13, 'Fabian Mora', 1, 0, 67, 1),
(99, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Francisco Celada, semana 26', 'Nomina Francisco Celada, semana 26', 0, 13, 'Francisco Celada', 1, 0, 68, 1),
(100, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Genaro Simon, semana 26', 'Nomina Genaro Simon, semana 26', 0, 13, 'Genaro Simon', 1, 0, 69, 1),
(101, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Leonel Martinez, semana 26', 'Nomina Leonel Martinez, semana 26', 0, 13, 'Leonel Martinez', 1, 0, 70, 1),
(102, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Leonel Martinez, semana 26', 'Nomina Leonel Martinez, semana 26', 0, 13, 'Leonel Martinez', 1, 0, 71, 1),
(103, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Lucila Villaneda, semana 26', 'Nomina Lucila Villaneda, semana 26', 0, 13, 'Lucila Villaneda', 1, 0, 72, 1),
(104, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Rodolfo de Jesus Martinez, semana 26', 'Nomina Rodolfo de Jesus Martinez, semana 26', 0, 13, 'Rodolfo de Jesus Martinez', 1, 0, 73, 1),
(105, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Jose Juan Gomez, semana 26', 'Nomina Jose Juan Gomez, semana 26', 0, 13, 'Jose Juan Gomez', 1, 0, 74, 1),
(106, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Jose Jonathan Campos, semana 26', 'Nomina Jose Jonathan Campos, semana 26', 0, 13, 'Jose Jonathan Campos', 1, 0, 75, 1),
(107, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Miguel Angel Vidal, semana 26', 'Nomina Miguel Angel Vidal, semana 26', 0, 13, 'Miguel Angel Vidal', 1, 0, 76, 1),
(108, 'Nomina semana 26', NULL, '2017-06-26 00:00:00', 0, '2017-06-26 00:00:00', 'Nomina Marilu Hernandez, semana 26', 'Nomina Marilu Hernandez, semana 26', 0, 13, 'Marilu Hernandez', 1, 0, 77, 1),
(109, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Vendedor 1 Tienda, semana 27', 'Nomina Vendedor 1 Tienda, semana 27', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(110, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 27', 'Nomina vendedor 02 vendedor 02, semana 27', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(111, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina jose manu, semana 27', 'Nomina jose manu, semana 27', 1000, 13, 'jose manu', 2, 0, 54, 1),
(112, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Jose Ramon Martinez, semana 27', 'Nomina Jose Ramon Martinez, semana 27', 1000, 13, 'Jose Ramon Martinez', 1, 0, 55, 1),
(113, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Felipe Lara, semana 27', 'Nomina Felipe Lara, semana 27', 0, 13, 'Felipe Lara', 1, 0, 56, 1),
(114, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Felipe Montiel, semana 27', 'Nomina Felipe Montiel, semana 27', 0, 13, 'Felipe Montiel', 1, 0, 57, 1),
(115, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Jesus Garcia, semana 27', 'Nomina Jesus Garcia, semana 27', 0, 13, 'Jesus Garcia', 1, 0, 58, 1),
(116, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Jose Antonio, semana 27', 'Nomina Jose Antonio, semana 27', 0, 13, 'Jose Antonio', 1, 0, 59, 1),
(117, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Alfredo Flores, semana 27', 'Nomina Alfredo Flores, semana 27', 0, 13, 'Alfredo Flores', 1, 0, 60, 1),
(118, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Amador Ramirez, semana 27', 'Nomina Amador Ramirez, semana 27', 0, 13, 'Amador Ramirez', 1, 0, 61, 1),
(119, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Artemio Juventino Mendez, semana 27', 'Nomina Artemio Juventino Mendez, semana 27', 0, 13, 'Artemio Juventino Mendez', 1, 0, 62, 1),
(120, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Carlos Espinosa, semana 27', 'Nomina Carlos Espinosa, semana 27', 0, 13, 'Carlos Espinosa', 1, 0, 63, 1),
(121, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Emilio Morales, semana 27', 'Nomina Emilio Morales, semana 27', 0, 13, 'Emilio Morales', 1, 0, 64, 1),
(122, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Enrique Octavio SIlva, semana 27', 'Nomina Enrique Octavio SIlva, semana 27', 0, 13, 'Enrique Octavio SIlva', 1, 0, 65, 1),
(123, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Ezequiel Torres, semana 27', 'Nomina Ezequiel Torres, semana 27', 0, 13, 'Ezequiel Torres', 1, 0, 66, 1),
(124, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Fabian Mora, semana 27', 'Nomina Fabian Mora, semana 27', 0, 13, 'Fabian Mora', 1, 0, 67, 1),
(125, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Francisco Celada, semana 27', 'Nomina Francisco Celada, semana 27', 0, 13, 'Francisco Celada', 1, 0, 68, 1),
(126, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Genaro Simon, semana 27', 'Nomina Genaro Simon, semana 27', 0, 13, 'Genaro Simon', 1, 0, 69, 1),
(127, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Leonel Martinez, semana 27', 'Nomina Leonel Martinez, semana 27', 0, 13, 'Leonel Martinez', 1, 0, 70, 1),
(128, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Leonel Martinez, semana 27', 'Nomina Leonel Martinez, semana 27', 0, 13, 'Leonel Martinez', 1, 0, 71, 1),
(129, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Lucila Villaneda, semana 27', 'Nomina Lucila Villaneda, semana 27', 0, 13, 'Lucila Villaneda', 1, 0, 72, 1),
(130, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Rodolfo de Jesus Martinez, semana 27', 'Nomina Rodolfo de Jesus Martinez, semana 27', 0, 13, 'Rodolfo de Jesus Martinez', 1, 0, 73, 1),
(131, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Jose Juan Gomez, semana 27', 'Nomina Jose Juan Gomez, semana 27', 0, 13, 'Jose Juan Gomez', 1, 0, 74, 1),
(132, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Jose Jonathan Campos, semana 27', 'Nomina Jose Jonathan Campos, semana 27', 0, 13, 'Jose Jonathan Campos', 1, 0, 75, 1),
(133, 'Nomina semana 27', NULL, '2017-07-05 00:00:00', 0, '2017-07-05 00:00:00', 'Nomina Miguel Angel Vidal, semana 27', 'Nomina Miguel Angel Vidal, semana 27', 0, 13, 'Miguel Angel Vidal', 1, 0, 76, 1),
(134, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Vendedor 1 Tienda, semana 28', 'Nomina Vendedor 1 Tienda, semana 28', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(135, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 28', 'Nomina vendedor 02 vendedor 02, semana 28', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(136, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina jose manu, semana 28', 'Nomina jose manu, semana 28', 1000, 13, 'jose manu', 1, 0, 54, 1),
(137, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Jose Ramon Martinez, semana 28', 'Nomina Jose Ramon Martinez, semana 28', 1000, 13, 'Jose Ramon Martinez', 1, 0, 55, 1),
(138, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Felipe Lara, semana 28', 'Nomina Felipe Lara, semana 28', 0, 13, 'Felipe Lara', 1, 0, 56, 1),
(139, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Felipe Montiel, semana 28', 'Nomina Felipe Montiel, semana 28', 0, 13, 'Felipe Montiel', 1, 0, 57, 1),
(140, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Jesus Garcia, semana 28', 'Nomina Jesus Garcia, semana 28', 0, 13, 'Jesus Garcia', 1, 0, 58, 1),
(141, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Jose Antonio, semana 28', 'Nomina Jose Antonio, semana 28', 0, 13, 'Jose Antonio', 1, 0, 59, 1),
(142, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Alfredo Flores, semana 28', 'Nomina Alfredo Flores, semana 28', 0, 13, 'Alfredo Flores', 1, 0, 60, 1),
(143, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Amador Ramirez, semana 28', 'Nomina Amador Ramirez, semana 28', 0, 13, 'Amador Ramirez', 1, 0, 61, 1),
(144, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Artemio Juventino Mendez, semana 28', 'Nomina Artemio Juventino Mendez, semana 28', 0, 13, 'Artemio Juventino Mendez', 1, 0, 62, 1),
(145, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Carlos Espinosa, semana 28', 'Nomina Carlos Espinosa, semana 28', 0, 13, 'Carlos Espinosa', 1, 0, 63, 1),
(146, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Emilio Morales, semana 28', 'Nomina Emilio Morales, semana 28', 0, 13, 'Emilio Morales', 1, 0, 64, 1),
(147, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Enrique Octavio SIlva, semana 28', 'Nomina Enrique Octavio SIlva, semana 28', 0, 13, 'Enrique Octavio SIlva', 1, 0, 65, 1),
(148, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Ezequiel Torres, semana 28', 'Nomina Ezequiel Torres, semana 28', 0, 13, 'Ezequiel Torres', 1, 0, 66, 1),
(149, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Fabian Mora, semana 28', 'Nomina Fabian Mora, semana 28', 0, 13, 'Fabian Mora', 1, 0, 67, 1),
(150, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Francisco Celada, semana 28', 'Nomina Francisco Celada, semana 28', 0, 13, 'Francisco Celada', 1, 0, 68, 1),
(151, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Genaro Simon, semana 28', 'Nomina Genaro Simon, semana 28', 0, 13, 'Genaro Simon', 1, 0, 69, 1),
(152, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Leonel Martinez, semana 28', 'Nomina Leonel Martinez, semana 28', 0, 13, 'Leonel Martinez', 1, 0, 70, 1),
(153, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Leonel Martinez, semana 28', 'Nomina Leonel Martinez, semana 28', 0, 13, 'Leonel Martinez', 1, 0, 71, 1),
(154, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Lucila Villaneda, semana 28', 'Nomina Lucila Villaneda, semana 28', 0, 13, 'Lucila Villaneda', 1, 0, 72, 1),
(155, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Rodolfo de Jesus Martinez, semana 28', 'Nomina Rodolfo de Jesus Martinez, semana 28', 0, 13, 'Rodolfo de Jesus Martinez', 1, 0, 73, 1),
(156, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Jose Juan Gomez, semana 28', 'Nomina Jose Juan Gomez, semana 28', 0, 13, 'Jose Juan Gomez', 1, 0, 74, 1),
(157, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Jose Jonathan Campos, semana 28', 'Nomina Jose Jonathan Campos, semana 28', 0, 13, 'Jose Jonathan Campos', 1, 0, 75, 1),
(158, 'Nomina semana 28', NULL, '2017-07-11 00:00:00', 0, '2017-07-11 00:00:00', 'Nomina Miguel Angel Vidal, semana 28', 'Nomina Miguel Angel Vidal, semana 28', 0, 13, 'Miguel Angel Vidal', 1, 0, 76, 1),
(159, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Vendedor 1 Tienda, semana 36', 'Nomina Vendedor 1 Tienda, semana 36', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(160, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 36', 'Nomina vendedor 02 vendedor 02, semana 36', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(161, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina jose manu, semana 36', 'Nomina jose manu, semana 36', 1000, 13, 'jose manu', 1, 0, 54, 1),
(162, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Jose Ramon Martinez, semana 36', 'Nomina Jose Ramon Martinez, semana 36', 1000, 13, 'Jose Ramon Martinez', 1, 0, 55, 1),
(163, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Felipe Lara, semana 36', 'Nomina Felipe Lara, semana 36', 0, 13, 'Felipe Lara', 1, 0, 56, 1),
(164, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Felipe Montiel, semana 36', 'Nomina Felipe Montiel, semana 36', 0, 13, 'Felipe Montiel', 1, 0, 57, 1),
(165, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Jesus Garcia, semana 36', 'Nomina Jesus Garcia, semana 36', 0, 13, 'Jesus Garcia', 1, 0, 58, 1),
(166, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Jose Antonio, semana 36', 'Nomina Jose Antonio, semana 36', 0, 13, 'Jose Antonio', 1, 0, 59, 1),
(167, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Alfredo Flores, semana 36', 'Nomina Alfredo Flores, semana 36', 0, 13, 'Alfredo Flores', 1, 0, 60, 1),
(168, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Amador Ramirez, semana 36', 'Nomina Amador Ramirez, semana 36', 0, 13, 'Amador Ramirez', 1, 0, 61, 1),
(169, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Artemio Juventino Mendez, semana 36', 'Nomina Artemio Juventino Mendez, semana 36', 0, 13, 'Artemio Juventino Mendez', 1, 0, 62, 1),
(170, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Carlos Espinosa, semana 36', 'Nomina Carlos Espinosa, semana 36', 0, 13, 'Carlos Espinosa', 1, 0, 63, 1),
(171, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Emilio Morales, semana 36', 'Nomina Emilio Morales, semana 36', 0, 13, 'Emilio Morales', 1, 0, 64, 1),
(172, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Enrique Octavio SIlva, semana 36', 'Nomina Enrique Octavio SIlva, semana 36', 0, 13, 'Enrique Octavio SIlva', 1, 0, 65, 1),
(173, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Ezequiel Torres, semana 36', 'Nomina Ezequiel Torres, semana 36', 0, 13, 'Ezequiel Torres', 1, 0, 66, 1),
(174, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Fabian Mora, semana 36', 'Nomina Fabian Mora, semana 36', 0, 13, 'Fabian Mora', 1, 0, 67, 1),
(175, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Francisco Celada, semana 36', 'Nomina Francisco Celada, semana 36', 0, 13, 'Francisco Celada', 1, 0, 68, 1),
(176, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Genaro Simon, semana 36', 'Nomina Genaro Simon, semana 36', 0, 13, 'Genaro Simon', 1, 0, 69, 1),
(177, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Leonel Martinez, semana 36', 'Nomina Leonel Martinez, semana 36', 0, 13, 'Leonel Martinez', 1, 0, 70, 1),
(178, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Leonel Martinez, semana 36', 'Nomina Leonel Martinez, semana 36', 0, 13, 'Leonel Martinez', 1, 0, 71, 1),
(179, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Lucila Villaneda, semana 36', 'Nomina Lucila Villaneda, semana 36', 0, 13, 'Lucila Villaneda', 1, 0, 72, 1),
(180, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Rodolfo de Jesus Martinez, semana 36', 'Nomina Rodolfo de Jesus Martinez, semana 36', 0, 13, 'Rodolfo de Jesus Martinez', 1, 0, 73, 1),
(181, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Jose Juan Gomez, semana 36', 'Nomina Jose Juan Gomez, semana 36', 0, 13, 'Jose Juan Gomez', 1, 0, 74, 1),
(182, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Jose Jonathan Campos, semana 36', 'Nomina Jose Jonathan Campos, semana 36', 0, 13, 'Jose Jonathan Campos', 1, 0, 75, 1),
(183, 'Nomina semana 36', NULL, '2017-09-08 00:00:00', 0, '2017-09-08 00:00:00', 'Nomina Miguel Angel Vidal, semana 36', 'Nomina Miguel Angel Vidal, semana 36', 0, 13, 'Miguel Angel Vidal', 1, 0, 76, 1),
(184, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Root Globmint, semana 42', 'Nomina Root Globmint, semana 42', 1000, 13, 'Root Globmint', 1, 0, 1, 1),
(185, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Vendedor 1 Tienda, semana 42', 'Nomina Vendedor 1 Tienda, semana 42', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(186, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 42', 'Nomina vendedor 02 vendedor 02, semana 42', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(187, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina gio tes, semana 42', 'Nomina gio tes, semana 42', 1500, 13, 'gio tes', 1, 0, 51, 1),
(188, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina jose manu, semana 42', 'Nomina jose manu, semana 42', 1000, 13, 'jose manu', 1, 0, 54, 1),
(189, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Jose Ramon Martinez, semana 42', 'Nomina Jose Ramon Martinez, semana 42', 1000, 13, 'Jose Ramon Martinez', 1, 0, 55, 1),
(190, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Felipe Lara, semana 42', 'Nomina Felipe Lara, semana 42', 0, 13, 'Felipe Lara', 1, 0, 56, 1),
(191, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Felipe Montiel, semana 42', 'Nomina Felipe Montiel, semana 42', 0, 13, 'Felipe Montiel', 1, 0, 57, 1),
(192, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Jesus Garcia, semana 42', 'Nomina Jesus Garcia, semana 42', 0, 13, 'Jesus Garcia', 1, 0, 58, 1),
(193, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Jose Antonio, semana 42', 'Nomina Jose Antonio, semana 42', 0, 13, 'Jose Antonio', 1, 0, 59, 1),
(194, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Alfredo Flores, semana 42', 'Nomina Alfredo Flores, semana 42', 0, 13, 'Alfredo Flores', 1, 0, 60, 1),
(195, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Amador Ramirez, semana 42', 'Nomina Amador Ramirez, semana 42', 0, 13, 'Amador Ramirez', 1, 0, 61, 1),
(196, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Artemio Juventino Mendez, semana 42', 'Nomina Artemio Juventino Mendez, semana 42', 0, 13, 'Artemio Juventino Mendez', 1, 0, 62, 1),
(197, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Carlos Espinosa, semana 42', 'Nomina Carlos Espinosa, semana 42', 0, 13, 'Carlos Espinosa', 1, 0, 63, 1),
(198, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Emilio Morales, semana 42', 'Nomina Emilio Morales, semana 42', 0, 13, 'Emilio Morales', 1, 0, 64, 1),
(199, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Enrique Octavio SIlva, semana 42', 'Nomina Enrique Octavio SIlva, semana 42', 0, 13, 'Enrique Octavio SIlva', 1, 0, 65, 1),
(200, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Ezequiel Torres, semana 42', 'Nomina Ezequiel Torres, semana 42', 0, 13, 'Ezequiel Torres', 1, 0, 66, 1),
(201, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Fabian Mora, semana 42', 'Nomina Fabian Mora, semana 42', 0, 13, 'Fabian Mora', 1, 0, 67, 1),
(202, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Francisco Celada, semana 42', 'Nomina Francisco Celada, semana 42', 0, 13, 'Francisco Celada', 1, 0, 68, 1),
(203, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Genaro Simon, semana 42', 'Nomina Genaro Simon, semana 42', 0, 13, 'Genaro Simon', 1, 0, 69, 1),
(204, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Leonel Martinez, semana 42', 'Nomina Leonel Martinez, semana 42', 0, 13, 'Leonel Martinez', 1, 0, 70, 1),
(205, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Leonel Martinez, semana 42', 'Nomina Leonel Martinez, semana 42', 0, 13, 'Leonel Martinez', 1, 0, 71, 1),
(206, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Lucila Villaneda, semana 42', 'Nomina Lucila Villaneda, semana 42', 0, 13, 'Lucila Villaneda', 1, 0, 72, 1),
(207, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Rodolfo de Jesus Martinez, semana 42', 'Nomina Rodolfo de Jesus Martinez, semana 42', 0, 13, 'Rodolfo de Jesus Martinez', 1, 0, 73, 1),
(208, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Jose Juan Gomez, semana 42', 'Nomina Jose Juan Gomez, semana 42', 0, 13, 'Jose Juan Gomez', 1, 0, 74, 1),
(209, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Jose Jonathan Campos, semana 42', 'Nomina Jose Jonathan Campos, semana 42', 0, 13, 'Jose Jonathan Campos', 1, 0, 75, 1),
(210, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Miguel Angel Vidal, semana 42', 'Nomina Miguel Angel Vidal, semana 42', 0, 13, 'Miguel Angel Vidal', 1, 0, 76, 1),
(211, 'Nomina semana 42', NULL, '2017-10-18 00:00:00', 0, '2017-10-18 00:00:00', 'Nomina Marilu Hernandez, semana 42', 'Nomina Marilu Hernandez, semana 42', 0, 13, 'Marilu Hernandez', 1, 0, 77, 1),
(212, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Vendedor 1 Tienda, semana 4', 'Nomina Vendedor 1 Tienda, semana 4', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(213, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 4', 'Nomina vendedor 02 vendedor 02, semana 4', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(214, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina jose manu, semana 4', 'Nomina jose manu, semana 4', 1000, 13, 'jose manu', 1, 0, 54, 1),
(215, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Jose Ramon Martinez, semana 4', 'Nomina Jose Ramon Martinez, semana 4', 1000, 13, 'Jose Ramon Martinez', 1, 0, 55, 1),
(216, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Felipe Lara, semana 4', 'Nomina Felipe Lara, semana 4', 0, 13, 'Felipe Lara', 1, 0, 56, 1),
(217, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Felipe Montiel, semana 4', 'Nomina Felipe Montiel, semana 4', 0, 13, 'Felipe Montiel', 1, 0, 57, 1),
(218, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Jesus Garcia, semana 4', 'Nomina Jesus Garcia, semana 4', 0, 13, 'Jesus Garcia', 1, 0, 58, 1),
(219, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Jose Antonio, semana 4', 'Nomina Jose Antonio, semana 4', 0, 13, 'Jose Antonio', 1, 0, 59, 1),
(220, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Alfredo Flores, semana 4', 'Nomina Alfredo Flores, semana 4', 0, 13, 'Alfredo Flores', 1, 0, 60, 1),
(221, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Amador Ramirez, semana 4', 'Nomina Amador Ramirez, semana 4', 0, 13, 'Amador Ramirez', 1, 0, 61, 1),
(222, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Artemio Juventino Mendez, semana 4', 'Nomina Artemio Juventino Mendez, semana 4', 0, 13, 'Artemio Juventino Mendez', 1, 0, 62, 1),
(223, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Carlos Espinosa, semana 4', 'Nomina Carlos Espinosa, semana 4', 0, 13, 'Carlos Espinosa', 1, 0, 63, 1),
(224, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Emilio Morales, semana 4', 'Nomina Emilio Morales, semana 4', 0, 13, 'Emilio Morales', 1, 0, 64, 1),
(225, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Enrique Octavio SIlva, semana 4', 'Nomina Enrique Octavio SIlva, semana 4', 0, 13, 'Enrique Octavio SIlva', 1, 0, 65, 1),
(226, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Ezequiel Torres, semana 4', 'Nomina Ezequiel Torres, semana 4', 0, 13, 'Ezequiel Torres', 1, 0, 66, 1),
(227, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Fabian Mora, semana 4', 'Nomina Fabian Mora, semana 4', 0, 13, 'Fabian Mora', 1, 0, 67, 1),
(228, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Francisco Celada, semana 4', 'Nomina Francisco Celada, semana 4', 0, 13, 'Francisco Celada', 1, 0, 68, 1),
(229, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Genaro Simon, semana 4', 'Nomina Genaro Simon, semana 4', 0, 13, 'Genaro Simon', 1, 0, 69, 1),
(230, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Leonel Martinez, semana 4', 'Nomina Leonel Martinez, semana 4', 0, 13, 'Leonel Martinez', 1, 0, 70, 1),
(231, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Leonel Martinez, semana 4', 'Nomina Leonel Martinez, semana 4', 0, 13, 'Leonel Martinez', 1, 0, 71, 1),
(232, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Lucila Villaneda, semana 4', 'Nomina Lucila Villaneda, semana 4', 0, 13, 'Lucila Villaneda', 1, 0, 72, 1),
(233, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Rodolfo de Jesus Martinez, semana 4', 'Nomina Rodolfo de Jesus Martinez, semana 4', 0, 13, 'Rodolfo de Jesus Martinez', 1, 0, 73, 1),
(234, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Jose Juan Gomez, semana 4', 'Nomina Jose Juan Gomez, semana 4', 0, 13, 'Jose Juan Gomez', 1, 0, 74, 1),
(235, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Jose Jonathan Campos, semana 4', 'Nomina Jose Jonathan Campos, semana 4', 0, 13, 'Jose Jonathan Campos', 1, 0, 75, 1),
(236, 'Nomina semana 4', NULL, '2018-01-22 00:00:00', 0, '2018-01-22 00:00:00', 'Nomina Miguel Angel Vidal, semana 4', 'Nomina Miguel Angel Vidal, semana 4', 0, 13, 'Miguel Angel Vidal', 1, 0, 76, 1),
(237, '58406124384', NULL, '2018-01-26 12:00:00', 1, '2018-02-02 12:00:00', 'Compra mercancía', 'Colchón verde', 1000, 15, 'DIVANO', 1, 7, 77, 1),
(238, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Root Globmint, semana 5', 'Nomina Root Globmint, semana 5', 1000, 13, 'Root Globmint', 2, 0, 1, 1),
(239, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Vendedor 1 Tienda, semana 5', 'Nomina Vendedor 1 Tienda, semana 5', 500, 13, 'Vendedor 1 Tienda', 1, 0, 49, 1),
(240, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina vendedor 02 vendedor 02, semana 5', 'Nomina vendedor 02 vendedor 02, semana 5', 500, 13, 'vendedor 02 vendedor 02', 1, 0, 50, 1),
(241, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina gio tes, semana 5', 'Nomina gio tes, semana 5', 1500, 13, 'gio tes', 1, 0, 51, 1),
(242, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina jose manu, semana 5', 'Nomina jose manu, semana 5', 1000, 13, 'jose manu', 2, 0, 54, 1),
(243, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Jose Ramon Martinez, semana 5', 'Nomina Jose Ramon Martinez, semana 5', 1000, 13, 'Jose Ramon Martinez', 1, 0, 55, 1),
(244, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Felipe Lara, semana 5', 'Nomina Felipe Lara, semana 5', 0, 13, 'Felipe Lara', 1, 0, 56, 1),
(245, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Felipe Montiel, semana 5', 'Nomina Felipe Montiel, semana 5', 0, 13, 'Felipe Montiel', 1, 0, 57, 1),
(246, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Jesus Garcia, semana 5', 'Nomina Jesus Garcia, semana 5', 0, 13, 'Jesus Garcia', 1, 0, 58, 1),
(247, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Jose Antonio, semana 5', 'Nomina Jose Antonio, semana 5', 0, 13, 'Jose Antonio', 1, 0, 59, 1),
(248, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Alfredo Flores, semana 5', 'Nomina Alfredo Flores, semana 5', 0, 13, 'Alfredo Flores', 1, 0, 60, 1),
(249, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Amador Ramirez, semana 5', 'Nomina Amador Ramirez, semana 5', 0, 13, 'Amador Ramirez', 1, 0, 61, 1),
(250, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Artemio Juventino Mendez, semana 5', 'Nomina Artemio Juventino Mendez, semana 5', 0, 13, 'Artemio Juventino Mendez', 1, 0, 62, 1),
(251, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Carlos Espinosa, semana 5', 'Nomina Carlos Espinosa, semana 5', 0, 13, 'Carlos Espinosa', 1, 0, 63, 1),
(252, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Emilio Morales, semana 5', 'Nomina Emilio Morales, semana 5', 0, 13, 'Emilio Morales', 1, 0, 64, 1),
(253, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Enrique Octavio SIlva, semana 5', 'Nomina Enrique Octavio SIlva, semana 5', 0, 13, 'Enrique Octavio SIlva', 1, 0, 65, 1),
(254, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Ezequiel Torres, semana 5', 'Nomina Ezequiel Torres, semana 5', 0, 13, 'Ezequiel Torres', 1, 0, 66, 1),
(255, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Fabian Mora, semana 5', 'Nomina Fabian Mora, semana 5', 0, 13, 'Fabian Mora', 1, 0, 67, 1);
INSERT INTO `gastos` (`gasto_id`, `gasto_no_documento`, `gasto_fecha_creacion`, `gasto_fecha_vencimiento`, `gasto_fecha_recordatorio_activo`, `gasto_fecha_recordatorio`, `gasto_concepto`, `gasto_descripcion`, `gasto_monto`, `gasto_categoria_id`, `gasto_beneficiario`, `gasto_status_id`, `proveedor_id`, `login_id`, `sucursal_id`) VALUES
(256, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Francisco Celada, semana 5', 'Nomina Francisco Celada, semana 5', 0, 13, 'Francisco Celada', 1, 0, 68, 1),
(257, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Genaro Simon, semana 5', 'Nomina Genaro Simon, semana 5', 0, 13, 'Genaro Simon', 1, 0, 69, 1),
(258, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Leonel Martinez, semana 5', 'Nomina Leonel Martinez, semana 5', 0, 13, 'Leonel Martinez', 1, 0, 70, 1),
(259, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Leonel Martinez, semana 5', 'Nomina Leonel Martinez, semana 5', 0, 13, 'Leonel Martinez', 1, 0, 71, 1),
(260, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Lucila Villaneda, semana 5', 'Nomina Lucila Villaneda, semana 5', 0, 13, 'Lucila Villaneda', 1, 0, 72, 1),
(261, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Rodolfo de Jesus Martinez, semana 5', 'Nomina Rodolfo de Jesus Martinez, semana 5', 0, 13, 'Rodolfo de Jesus Martinez', 2, 0, 73, 1),
(262, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Jose Juan Gomez, semana 5', 'Nomina Jose Juan Gomez, semana 5', 0, 13, 'Jose Juan Gomez', 1, 0, 74, 1),
(263, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Jose Jonathan Campos, semana 5', 'Nomina Jose Jonathan Campos, semana 5', 0, 13, 'Jose Jonathan Campos', 1, 0, 75, 1),
(264, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Miguel Angel Vidal, semana 5', 'Nomina Miguel Angel Vidal, semana 5', 0, 13, 'Miguel Angel Vidal', 1, 0, 76, 1),
(265, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Marilu Hernandez, semana 5', 'Nomina Marilu Hernandez, semana 5', 0, 13, 'Marilu Hernandez', 1, 0, 77, 1),
(266, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Gio test, semana 5', 'Nomina Gio test, semana 5', 500, 13, 'Gio test', 2, 0, 78, 1),
(267, 'Nomina semana 5', NULL, '2018-01-31 00:00:00', 0, '2018-01-31 00:00:00', 'Nomina Gio est, semana 5', 'Nomina Gio est, semana 5', 888, 13, 'Gio est', 2, 0, 79, 1),
(268, 'dia extra salario folio 242', NULL, '2018-01-31 23:00:00', 0, '2018-01-31 23:00:00', 'stfg', 'dia extra salario folio 242', 290, 25, '', 2, 0, 0, 1),
(269, 'dia extra salario folio 267', NULL, '2018-02-01 21:02:28', 0, '2018-02-01 21:02:28', 'dia extra salario folio 267', 'dia extra salario folio 267', 126.86, 25, '79', 2, 0, 79, 1),
(270, 'dia extra salario folio 261', NULL, '2018-02-01 21:19:00', 0, '2018-02-01 21:19:00', 'zzz', 'dia extra salario folio 261', 25, 25, '', 2, 0, 73, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_pagos`
--

CREATE TABLE IF NOT EXISTS `gastos_pagos` (
  `gastos_pagos_id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_id` int(11) DEFAULT NULL,
  `gastos_pagos_monto` float DEFAULT NULL,
  `gastos_pagos_forma_de_pago_id` int(11) DEFAULT NULL,
  `gastos_pagos_referencia` text,
  `gastos_pagos_es_fiscal` varchar(2) DEFAULT NULL,
  `gastos_pagos_monto_sin_iva` float DEFAULT NULL,
  `gastos_pagos_iva` float DEFAULT NULL,
  `gastos_pagos_fecha` datetime DEFAULT NULL,
  `login_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`gastos_pagos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `gastos_pagos`
--

INSERT INTO `gastos_pagos` (`gastos_pagos_id`, `gasto_id`, `gastos_pagos_monto`, `gastos_pagos_forma_de_pago_id`, `gastos_pagos_referencia`, `gastos_pagos_es_fiscal`, `gastos_pagos_monto_sin_iva`, `gastos_pagos_iva`, `gastos_pagos_fecha`, `login_id`) VALUES
(1, 6, 500, 1, '', '0', 0, 0, '2016-11-24 19:52:58', 1),
(2, 3, 500, 1, '', '0', 0, 0, '2016-11-25 12:00:00', 1),
(3, 5, 100, 1, '', '0', 0, 0, '2016-11-25 12:00:00', 1),
(4, 5, 100, 1, '', '0', 0, 0, '2016-11-25 12:00:00', 1),
(5, 5, 200, 2, '', '1', 168, 32, '2016-11-25 12:00:00', 1),
(6, 1, 1000, 1, '', '0', 0, 0, '2016-11-25 02:16:57', 1),
(7, 12, 142.86, 1, '', '0', 0, 0, '2016-11-25 02:16:57', 1),
(8, 19, 100, 1, '', '0', 0, 0, '2016-12-05 23:12:00', 1),
(9, 19, 15, 1, '', '0', 0, 0, '2016-12-07 20:12:00', 1),
(10, 111, 1000, 1, '', '0', 0, 0, '2017-07-06 22:34:25', 1),
(11, 242, 1000, 1, '', '0', 0, 0, '2018-01-31 23:00:31', 1),
(12, 268, 190, 1, '', '0', 0, 0, '2018-01-31 23:00:31', 1),
(13, 238, 1000, 1, '', '0', 0, 0, '2018-02-01 20:51:44', 1),
(14, 267, 888, 1, '', '0', 0, 0, '2018-02-01 21:02:28', 1),
(15, 269, 126.86, 1, '', '0', 0, 0, '2018-02-01 21:02:28', 1),
(16, 266, 500, 1, '', '0', 0, 0, '2018-02-01 21:18:46', 1),
(17, 261, 0, 1, '', '0', 0, 0, '2018-02-01 21:19:20', 1),
(18, 270, 10, 1, '', '0', 0, 0, '2018-02-01 21:19:20', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_pagos_forma_de_pago`
--

CREATE TABLE IF NOT EXISTS `gastos_pagos_forma_de_pago` (
  `gastos_pagos_forma_de_pago_id` int(11) NOT NULL AUTO_INCREMENT,
  `gastos_pagos_forma_de_pago_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`gastos_pagos_forma_de_pago_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `gastos_pagos_forma_de_pago`
--

INSERT INTO `gastos_pagos_forma_de_pago` (`gastos_pagos_forma_de_pago_id`, `gastos_pagos_forma_de_pago_desc`) VALUES
(1, 'Efectivo'),
(2, 'Cheque'),
(3, 'Deposito'),
(4, 'Tranferencia Electronica'),
(5, 'Vales de despensa'),
(6, 'Tarjeta de credito'),
(7, 'Tarjeta de debito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasto_categoria`
--

CREATE TABLE IF NOT EXISTS `gasto_categoria` (
  `gasto_categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_categoria_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`gasto_categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `gasto_categoria`
--

INSERT INTO `gasto_categoria` (`gasto_categoria_id`, `gasto_categoria_desc`) VALUES
(1, 'RENTA'),
(2, 'PRESTAMOS'),
(3, 'LUZ'),
(4, 'AGUA'),
(5, 'PREDIAL'),
(6, 'TELEFONO'),
(7, 'CELULARES'),
(8, 'PAPELERIA'),
(9, 'CAJA CHICA'),
(10, 'GASTOS DE REPRESENTACION'),
(11, 'MANTENIMIENTO DE EQUIPO'),
(12, 'MANTENIMIENTO DE INMUEBLES'),
(13, 'SUELDOS'),
(14, 'HONORARIOS PROFESIONALES'),
(15, 'PROVEEDORES'),
(16, 'IMPUESTOS'),
(17, 'PUBLICIDAD Y PROPAGANDA'),
(18, 'SEGURO DE INMUEBLES'),
(19, 'SEGURO DE AUTOS'),
(20, 'EXTRAS'),
(21, 'IMPREVISTOS'),
(22, 'GASOLINA'),
(23, 'COMISIONES'),
(24, 'INCENTIVO/BONO'),
(25, 'DIA EXTRA SUELDOS'),
(26, 'MANTENIMIENTO DE VEHÍCULOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasto_status`
--

CREATE TABLE IF NOT EXISTS `gasto_status` (
  `gasto_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_status_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`gasto_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `gasto_status`
--

INSERT INTO `gasto_status` (`gasto_status_id`, `gasto_status_desc`) VALUES
(1, 'Pendiente'),
(2, 'Pagado'),
(3, 'Cancelado'),
(4, 'Vencido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general_formas_de_pago`
--

CREATE TABLE IF NOT EXISTS `general_formas_de_pago` (
  `general_forma_de_pago_id` int(11) NOT NULL AUTO_INCREMENT,
  `general_forma_de_pago_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`general_forma_de_pago_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `general_formas_de_pago`
--

INSERT INTO `general_formas_de_pago` (`general_forma_de_pago_id`, `general_forma_de_pago_desc`) VALUES
(1, 'Efectivo'),
(2, 'Cheque'),
(3, 'Depósito'),
(4, 'Tranferencia electrónica'),
(5, 'Vales de despensa'),
(6, 'Tarjeta de crédito'),
(7, 'Tarjeta de débito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_productos`
--

CREATE TABLE IF NOT EXISTS `imagenes_productos` (
  `imagen_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `imagen_name` varchar(100) DEFAULT NULL,
  `imagen_route` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`imagen_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `imagenes_productos`
--

INSERT INTO `imagenes_productos` (`imagen_id`, `producto_id`, `imagen_name`, `imagen_route`) VALUES
(1, 9, 'producto_9_1.jpg', 'http://globmint.com/uploads/productos/producto_9_1.jpg'),
(2, 6, 'producto_6_1.png', 'http://globmint.com/uploads/productos/producto_6_1.png'),
(3, 11, 'producto_11_1.png', 'http://globmint.com/uploads/productos/producto_11_1.png'),
(4, 12, 'producto_12_1.jpg', 'http://globmint.com/uploads/productos/producto_12_1.jpg'),
(5, 21, 'producto_21_1.jpg', 'https://globmint.com/uploads/productos/producto_21_1.jpg'),
(6, 22, 'producto_22_1.jpg', 'https://globmint.com/uploads/productos/producto_22_1.jpg'),
(7, 23, 'producto_23_1.jpg', 'https://globmint.com/uploads/productos/producto_23_1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE IF NOT EXISTS `ingresos` (
  `ingreso_id` int(11) NOT NULL AUTO_INCREMENT,
  `ingreso_monto` float NOT NULL,
  `ingreso_fecha` datetime NOT NULL,
  `ingreso_categoria_id` int(11) DEFAULT NULL,
  `ingreso_descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ingreso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`ingreso_id`, `ingreso_monto`, `ingreso_fecha`, `ingreso_categoria_id`, `ingreso_descripcion`) VALUES
(43, 200, '2016-11-25 02:16:57', 1, 'Pago al prestamo/gasto folio 9'),
(44, 600, '2018-01-31 23:00:31', 2, 'Dia Descuento/Penalización salario folio 242'),
(45, 142.86, '2018-02-01 20:51:44', 2, 'Dia Descuento/Penalización salario folio 238');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_categoria`
--

CREATE TABLE IF NOT EXISTS `ingreso_categoria` (
  `ingreso_categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `ingreso_categoria_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ingreso_categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ingreso_categoria`
--

INSERT INTO `ingreso_categoria` (`ingreso_categoria_id`, `ingreso_categoria_desc`) VALUES
(1, 'Pago a prestamo'),
(2, 'Dia Descuento/Penalizacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_gasto`
--

CREATE TABLE IF NOT EXISTS `ingreso_gasto` (
  `ingreso_gasto_id` int(11) NOT NULL AUTO_INCREMENT,
  `ingreso_id` int(11) DEFAULT NULL,
  `gasto_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`ingreso_gasto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `ingreso_gasto`
--

INSERT INTO `ingreso_gasto` (`ingreso_gasto_id`, `ingreso_id`, `gasto_id`) VALUES
(6, 42, 46),
(7, 43, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_productos`
--

CREATE TABLE IF NOT EXISTS `inventario_productos` (
  `inventario_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`inventario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `inventario_productos`
--

INSERT INTO `inventario_productos` (`inventario_id`, `producto_id`, `sucursal_id`, `cantidad`) VALUES
(1, 5, 2, 32),
(2, 6, 2, 8),
(3, 5, 1, 2),
(4, 8, 1, 0),
(5, 9, 1, 2),
(6, 6, 1, 0),
(7, 8, 2, 1),
(8, 2, 1, 3),
(9, 9, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_address`
--

CREATE TABLE IF NOT EXISTS `inv_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(128) DEFAULT NULL,
  `number` varchar(45) DEFAULT NULL,
  `int_number` varchar(45) DEFAULT NULL,
  `neighborhood` varchar(128) DEFAULT NULL,
  `municipality` varchar(128) DEFAULT NULL,
  `zip_code` varchar(6) DEFAULT NULL,
  `state` varchar(128) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Volcado de datos para la tabla `inv_address`
--

INSERT INTO `inv_address` (`address_id`, `street`, `number`, `int_number`, `neighborhood`, `municipality`, `zip_code`, `state`, `country`) VALUES
(13, 'Oriente 171 ', '136', '', 'Ampliación San Juan de Aragón', '', '07470', '5', NULL),
(14, '', '', '', '', '', '', '0', NULL),
(15, 'juan', '23', '1', 'pedro', 'hola', '00001', '5', NULL),
(16, '', '', '', '', '', '', '0', NULL),
(17, 'hhh', '2', 'b', 'hhhh', 'hhh', '55555', '3', NULL),
(18, '', '', '', '', '', '', '0', NULL),
(19, '', '', '', '', '', '', '0', NULL),
(20, 'assd', '2', 'f', 'sdf', 'sf', '22222', '18', NULL),
(21, 'hiu', '7', 'y', 'ityut', 'yuiuy', '66777', '2', NULL),
(22, 'iuytu', '7', 'yiuy', 'gkjgk', 'jgkjhgkj', '77777', '4', NULL),
(23, '', '', '', '', '', '', '0', NULL),
(24, 'calle', '7', 'B', 'col', 'Municipio', '32345', '16', NULL),
(25, 'calle', '8', 'j', 'yhiuy', 'yiouy', '88888', '4', NULL),
(26, 'asd', '2', 'e', 'ewrwe', 'fsdf', '2223', '18', NULL),
(27, 'asd', '2', 'd', 'sfdf', 'sdf', '33333', '16', NULL),
(28, 'hjgkj', '7', 'ygtyu', 'khkjhg', 'jkhgkjhgk', '66666', '3', NULL),
(29, 'Calle', '2', 'R', 'Colonia', 'sdsf', '123', '18', NULL),
(30, 'asdas', '2', 'B', 'sdfsf', 'sfds', '22222', '16', NULL),
(31, 'Calle', '2', 'B', 'Colonia', 'tol', '12345', '1', NULL),
(32, 'calle', '3', 'B', 'Colonia', 'tol', '50020', '3', NULL),
(33, 'Calle Cerrada esquina abierta entre Honduras y Peru', '325', '4B', 'Colonia Eugenia', 'Municipio 3', '31025', '11', NULL),
(34, '', '', '', '', '', '', '0', NULL),
(35, '', '', '', '', '', '', '0', NULL),
(36, 'un', 'un', '1', 'fff', 'fff', 'fff', '1', NULL),
(37, 'Calle 1', '01', '301', 'Equis', '', '06100', '5', NULL),
(38, '', '', '', '', '', '', '0', NULL),
(39, '', '', '', '', '', '', '0', NULL),
(40, '', '', '', '', '', '', '0', NULL),
(41, '', '', '', '', '', '', '0', NULL),
(42, '', '', '', '', '', '', '0', NULL),
(43, '', '', '', '', '', '', '0', NULL),
(44, '', '', '', '', '', '', '0', NULL),
(45, '', '', '', '', '', '', '0', NULL),
(46, '', '', '', '', '', '', '0', NULL),
(47, '', '', '', '', '', '', '0', NULL),
(48, '', '', '', '', '', '', '0', NULL),
(49, '', '', '', '', '', '', '0', NULL),
(50, '', '', '', '', '', '', '0', NULL),
(51, '', '', '', '', '', '', '0', NULL),
(52, '', '', '', '', '', '', '0', NULL),
(53, '', '', '', '', '', '', '0', NULL),
(54, '', '', '', '', '', '', '0', NULL),
(55, '', '', '', '', '', '', '0', NULL),
(56, '', '', '', '', '', '', '0', NULL),
(57, '', '', '', '', '', '', '0', NULL),
(58, '', '', '', '', '', '', '0', NULL),
(59, '', '', '', '', '', '', '0', NULL),
(60, '', '', '', '', '', '', '0', NULL),
(61, 'Direccion', '3', 'b', 'Colni', 'Delegacion', '50020', '11', NULL),
(62, 'asdadj', '7', '7', 'uytu', 'uytutu', '77777', '2', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_login`
--

CREATE TABLE IF NOT EXISTS `inv_login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `secondLastName` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_id` int(4) DEFAULT NULL,
  `collaborator` tinyint(4) DEFAULT '0',
  `sucursal_id` tinyint(4) DEFAULT '0',
  `address_id` tinyint(4) DEFAULT '0',
  `salary` float DEFAULT NULL,
  `salary_periodicity` int(11) DEFAULT NULL,
  `comision` float DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `status_id` tinyint(4) DEFAULT '2',
  `created_timestamp` int(11) DEFAULT NULL,
  `modify_timestamp` int(11) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `last_logout` int(11) DEFAULT NULL,
  `url_image` varchar(256) DEFAULT 'img/profile_default.png',
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Volcado de datos para la tabla `inv_login`
--

INSERT INTO `inv_login` (`login_id`, `firstName`, `lastName`, `secondLastName`, `email`, `password`, `profile_id`, `collaborator`, `sucursal_id`, `address_id`, `salary`, `salary_periodicity`, `comision`, `birthdate`, `status_id`, `created_timestamp`, `modify_timestamp`, `last_login`, `last_logout`, `url_image`) VALUES
(1, 'Root', 'Globmint', '', 'root@globmint.com', '6E/nLHChQ9iTtyuqeuvAgledicZhEsipGnJWN+XTMCY=', 1, 0, 1, 1, 1000, 2, 0, NULL, 1, 1460155058, 1521141258, NULL, NULL, 'img/profile_default.png'),
(49, 'Vendedor 1', 'Tienda', 'San', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 6, NULL, 0, 15, 500, 1, 2, '2016-11-01', 99, 1478970916, 1478970916, NULL, NULL, 'img/profile_default.png'),
(50, 'vendedor 02', 'vendedor 02', '', 'ventas02@globmint.com', '3w/jsFPEwR4fUf31EBaWW2cbY4C4s+3tzTuvKf9ANc4=', 6, NULL, 1, 16, 500, 1, 0, '2016-11-12', 99, 1478972833, 1478973396, NULL, NULL, 'img/profile_default.png'),
(51, 'gio', 'tes', 'est', 'vvvaa@ddd.com', 'UeFAKs999pBoYVjr154XzVh787gGtxG+YNFmqEzwU8c=', 6, NULL, 1, 17, 1500, 2, 10, '2016-11-01', 99, 1479251865, 1479251865, NULL, NULL, 'img/profile_default.png'),
(52, '', '', '', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 0, NULL, 0, 34, 0, 0, 0, '2016-12-05', 2, 1480998123, 1480998123, NULL, NULL, 'img/profile_default.png'),
(53, 'httg', 'htg', 'htt', 'hrhy', '5pSHI2B48iR+pxFrzcosB0Lvrz2Dd0oVqIrCy82soBU=', 0, NULL, 0, 35, 0, 0, 0, '2016-12-07', 2, 1481164229, 1481164229, NULL, NULL, 'img/profile_default.png'),
(54, 'jose', 'manu', '', 'kasjoss89@hotmail.com', 'CksKjU8vXXNl6poVjsTERMe7fGRGG0/7Xjx4X7K4f80=', 2, NULL, 0, 36, 1000, 1, 0, '2016-02-09', 99, 1481164334, 1481164334, NULL, NULL, 'img/profile_default.png'),
(55, 'Jose Ramon', 'Martinez', 'Perez', 'josemp90@hotmail.com', 'FhMixgArvBJZZz43R8rTZi6Q9AcHYsZoOxDzTNiqQWg=', 5, NULL, 1, 37, 1000, 1, 0, '1990-05-14', 99, 1492476131, 1492476131, NULL, NULL, 'img/profile_default.png'),
(56, 'Felipe', 'Lara', 'Rodriguez', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 6, NULL, 4, 38, 0, 1, 2, '2017-06-22', 3, 1498156298, 1498156298, NULL, NULL, 'img/profile_default.png'),
(57, 'Felipe', 'Montiel', 'Anguiano', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 6, NULL, 3, 39, 0, 1, 2, '2017-06-22', 2, 1498156348, 1498156348, NULL, NULL, 'img/profile_default.png'),
(58, 'Jesus', 'Garcia', 'Flores', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 6, NULL, 10, 40, 0, 1, 2, '2017-06-22', 2, 1498156408, 1498156408, NULL, NULL, 'img/profile_default.png'),
(59, 'Jose', 'Antonio', 'Pacheco', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 6, NULL, 12, 41, 0, 1, 2, '2017-06-22', 2, 1498156442, 1498156442, NULL, NULL, 'img/profile_default.png'),
(60, 'Alfredo', 'Flores', '', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 8, NULL, 0, 42, 0, 1, 0, '2017-06-22', 1, 1498156540, 1498156540, NULL, NULL, 'img/profile_default.png'),
(61, 'Amador', 'Ramirez', 'Hernandez', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 7, NULL, 11, 43, 0, 1, 0, '2017-06-22', 1, 1498156577, 1498156577, NULL, NULL, 'img/profile_default.png'),
(62, 'Artemio Juventino', 'Mendez', 'Reynoso', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 7, NULL, 5, 44, 0, 1, 0, '2017-06-22', 2, 1498156637, 1498156637, NULL, NULL, 'img/profile_default.png'),
(63, 'Carlos', 'Espinosa', '', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 7, NULL, 3, 45, 0, 1, 0, '2017-06-22', 2, 1498156711, 1498156711, NULL, NULL, 'img/profile_default.png'),
(64, 'Emilio', 'Morales', '', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 7, NULL, 13, 46, 0, 1, 0, '2017-06-22', 2, 1498156750, 1498156750, NULL, NULL, 'img/profile_default.png'),
(65, 'Enrique Octavio', 'SIlva', 'Aldate', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 7, NULL, 5, 47, 0, 1, 0, '2017-06-22', 2, 1498156805, 1498156805, NULL, NULL, 'img/profile_default.png'),
(66, 'Ezequiel', 'Torres', 'Balcazar', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 7, NULL, 8, 48, 0, 1, 0, '2017-06-22', 1, 1498156838, 1498156838, NULL, NULL, 'img/profile_default.png'),
(67, 'Fabian', 'Mora', 'Reyes', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 7, NULL, 13, 49, 0, 1, 0, '2017-06-22', 2, 1498156878, 1498156878, NULL, NULL, 'img/profile_default.png'),
(68, 'Francisco', 'Celada', 'Vieyra', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 5, NULL, 13, 50, 0, 1, 0, '2017-06-22', 2, 1498156919, 1498156919, NULL, NULL, 'img/profile_default.png'),
(69, 'Genaro', 'Simon', 'Bautista', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 7, NULL, 12, 51, 0, 1, 0, '2017-06-22', 2, 1498156953, 1498156953, NULL, NULL, 'img/profile_default.png'),
(70, 'Leonel', 'Martinez', 'Luca', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 7, NULL, 7, 52, 0, 1, 0, '2017-06-22', 2, 1498156997, 1498156997, NULL, NULL, 'img/profile_default.png'),
(71, 'Leonel', 'Martinez', 'Luca', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 7, NULL, 7, 53, 0, 1, 0, '2017-06-22', 99, 1498159378, 1498159378, NULL, NULL, 'img/profile_default.png'),
(72, 'Lucila', 'Villaneda', 'Duarte', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 7, NULL, 11, 54, 0, 1, 0, '2017-06-22', 1, 1498159456, 1498159456, NULL, NULL, 'img/profile_default.png'),
(73, 'Rodolfo de Jesus', 'Martinez', 'Torres', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 7, NULL, 9, 55, 0, 1, 0, '2017-06-22', 2, 1498159494, 1498159494, NULL, NULL, 'img/profile_default.png'),
(74, 'Jose Juan', 'Gomez', 'Castro', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 9, NULL, 0, 56, 0, 1, 0, '2017-06-22', 2, 1498159521, 1498159521, NULL, NULL, 'img/profile_default.png'),
(75, 'Jose Jonathan', 'Campos', 'Gonzalez', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 9, NULL, 0, 57, 0, 1, 0, '2017-06-22', 2, 1498159560, 1498159560, NULL, NULL, 'img/profile_default.png'),
(76, 'Miguel Angel', 'Vidal', 'Montiel', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 9, NULL, 0, 58, 0, 1, 0, '2017-06-22', 3, 1498159588, 1498159588, NULL, NULL, 'img/profile_default.png'),
(77, 'Marilu', 'Hernandez', '', '', '5sQ9unQ4JmqArB24V4AOu5Q6wMhUF6HElXjHC1goSWk=', 4, NULL, 1, 59, 0, 2, 0, '2017-06-22', 1, 1498159621, 1498159621, NULL, NULL, 'img/profile_default.png'),
(78, 'Gio', 'test', 'test', 'giovanni@globmint.com', 'IKWVg8NQUjHoSqWN16g+HGmPHeu/CTu83PbjmBBIu58=', 6, NULL, 3, 60, 500, 1, 10, '2018-01-29', 99, 1517259316, 1517259316, NULL, NULL, 'img/profile_default.png'),
(79, 'Gio', 'est', 'ale', 'ggg@globmint.com', 'cU5vYu+2zYVA+KkN7KJ1J6vFSDSO4KsCp9Mh98dZjPw=', 6, NULL, 3, 62, 888, 2, 10, '2018-01-29', 1, 1517279822, 1517282597, NULL, NULL, 'img/profile_default.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_login_phone_number`
--

CREATE TABLE IF NOT EXISTS `inv_login_phone_number` (
  `login_phone_number_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` varchar(45) DEFAULT NULL,
  `phone_type_id` int(11) NOT NULL,
  `number` varchar(45) NOT NULL,
  PRIMARY KEY (`login_phone_number_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `inv_login_phone_number`
--

INSERT INTO `inv_login_phone_number` (`login_phone_number_id`, `login_id`, `phone_type_id`, `number`) VALUES
(7, '49', 1, '55555555'),
(8, '51', 1, '122'),
(9, '55', 1, '5522222222'),
(10, '55', 1, '55333333'),
(11, '79', 1, '23423424');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_phone_type`
--

CREATE TABLE IF NOT EXISTS `inv_phone_type` (
  `phone_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`phone_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `inv_phone_type`
--

INSERT INTO `inv_phone_type` (`phone_type_id`, `type`) VALUES
(1, 'Celular (044)'),
(2, 'Casa'),
(3, 'Oficina'),
(4, 'Otro'),
(5, 'Celular (045)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_profile`
--

CREATE TABLE IF NOT EXISTS `inv_profile` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_name` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `inv_profile`
--

INSERT INTO `inv_profile` (`profile_id`, `profile_name`) VALUES
(1, 'Root'),
(2, 'Dirección'),
(4, 'Administración'),
(5, 'Gerencia'),
(6, 'Vendedor Comisión'),
(7, 'Vendedor Fijo'),
(8, 'Técnico'),
(9, 'Chofer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_profile_pages`
--

CREATE TABLE IF NOT EXISTS `inv_profile_pages` (
  `idProfilePage` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) DEFAULT NULL,
  `page` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idProfilePage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `inv_profile_pages`
--

INSERT INTO `inv_profile_pages` (`idProfilePage`, `profile_id`, `page`) VALUES
(1, 1, 'login/profile.php'),
(2, 2, 'login/profile.php'),
(3, 1, 'usuarios/index.php'),
(4, 2, 'usuarios/index.php'),
(5, 1, 'calendario/index.php'),
(6, 2, 'calendario/index.php'),
(7, 1, 'gastos/index.php'),
(8, 2, 'gastos/index.php'),
(9, 1, 'gastos/nomina/index.php'),
(10, 2, 'gastos/nomina/index.php'),
(11, 1, 'gastos/nuevo/index.php'),
(12, 2, 'gastos/nuevo/index.php'),
(13, 1, 'gastos/editar/index.php'),
(14, 2, 'gastos/editar/index.php'),
(15, 1, 'gastos/borrar/index.php'),
(16, 2, 'gastos/borrar/index.php'),
(17, 1, 'gastos/pagos_lista/index.php'),
(18, 2, 'gastos/pagos_lista/index.php'),
(19, 1, 'gastos/pago_nuevo/index.php'),
(20, 2, 'gastos/pago_nuevo/index.php'),
(21, 1, 'calendario/nuevo/index.php'),
(22, 2, 'calendario/nuevo/index.php'),
(23, 1, 'calendario/editar/index.php'),
(24, 2, 'calendario/editar/index.php'),
(25, 1, 'calendario/borrar/index.php'),
(26, 2, 'calendario/borrar/index.php'),
(27, 6, 'login/profile.php'),
(28, 6, 'gastos/index.php'),
(29, 1, 'tablero_resumen/index.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_status`
--

CREATE TABLE IF NOT EXISTS `inv_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `inv_status`
--

INSERT INTO `inv_status` (`status_id`, `status_name`) VALUES
(1, 'Activo'),
(2, 'Pendiente'),
(3, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_sucursales`
--

CREATE TABLE IF NOT EXISTS `inv_sucursales` (
  `sucursal_id` int(11) NOT NULL AUTO_INCREMENT,
  `sucursal_name` varchar(64) COLLATE latin1_spanish_ci DEFAULT NULL,
  `sucursal_abrev` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`sucursal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `inv_sucursales`
--

INSERT INTO `inv_sucursales` (`sucursal_id`, `sucursal_name`, `sucursal_abrev`) VALUES
(1, 'Oficina Central', 'OC'),
(3, 'Allende 69', 'ALL-69'),
(4, 'Allende 76', 'ALL-76'),
(5, 'Allende 88', 'ALL-88'),
(7, 'Pasaje Allende 40', 'PAS-40'),
(8, 'Comonfort 18', 'COM-18'),
(9, 'Ecuador 89', 'ECU-89'),
(10, 'Ecuador 91', 'ECU-91'),
(11, 'Brasil 94', 'BRA-94'),
(12, 'Peru 14', 'PER-14'),
(13, 'Reforma 364', 'REF-364'),
(14, 'Bodega Peru', 'BOD-PER'),
(15, 'HOLA', 'HOLA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE IF NOT EXISTS `materiales` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_name` varchar(64) DEFAULT NULL,
  `material_abrev` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`material_id`, `material_name`, `material_abrev`) VALUES
(4, 'SUEDE', 'SUE'),
(5, 'TELA LISA', 'TELI'),
(6, 'TELA ESTAMPADA', ''),
(7, 'VINIPIEL', ''),
(8, 'LINO', ''),
(9, 'VELVET', ''),
(10, 'FLOTER', ''),
(11, 'TAGORE VINIPIEL', ''),
(12, 'MORADO', 'MOR'),
(13, 'hols', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `montos_corte_caja`
--

CREATE TABLE IF NOT EXISTS `montos_corte_caja` (
  `monto_inicial_id` int(11) NOT NULL,
  `corte_parcial_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `montos_corte_caja`
--

INSERT INTO `montos_corte_caja` (`monto_inicial_id`, `corte_parcial_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `montos_iniciales`
--

CREATE TABLE IF NOT EXISTS `montos_iniciales` (
  `monto_inicial_id` int(11) NOT NULL AUTO_INCREMENT,
  `monto_inicial` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`monto_inicial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `montos_iniciales`
--

INSERT INTO `montos_iniciales` (`monto_inicial_id`, `monto_inicial`, `user_id`, `sucursal_id`, `fecha`) VALUES
(1, 200, 1, 1, '2018-01-22 09:51:45'),
(2, 200, 1, 1, '2018-02-01 03:42:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_inventario`
--

CREATE TABLE IF NOT EXISTS `movimientos_inventario` (
  `movimiento_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id_salida` int(11) NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `sucursal_id_salida` int(11) NOT NULL,
  `nota_salida` text NOT NULL,
  `chofer` varchar(100) DEFAULT NULL,
  `estatus` varchar(30) DEFAULT NULL,
  `usuario_id_entrega` int(11) NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `sucursal_id_entrada` int(11) NOT NULL,
  `nota_entrega` text NOT NULL,
  PRIMARY KEY (`movimiento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `movimientos_inventario`
--

INSERT INTO `movimientos_inventario` (`movimiento_id`, `usuario_id_salida`, `fecha_salida`, `sucursal_id_salida`, `nota_salida`, `chofer`, `estatus`, `usuario_id_entrega`, `fecha_entrega`, `sucursal_id_entrada`, `nota_entrega`) VALUES
(1, 0, '2017-02-08 01:25:33', 0, '', '', 'EP', 1, '2017-02-08 01:25:33', 2, ''),
(2, 1, '2017-03-22 09:21:16', 2, '', '', 'ET', 1, '2017-03-22 09:21:46', 1, 'dsadsa'),
(3, 1, '2017-03-22 09:26:37', 1, '', '', 'ET', 1, '2017-03-22 09:26:43', 2, ''),
(4, 1, '2017-03-22 09:29:23', 1, '', '', 'ET', 1, '2017-04-28 01:23:28', 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_productos`
--

CREATE TABLE IF NOT EXISTS `movimientos_productos` (
  `movimiento_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos_productos`
--

INSERT INTO `movimientos_productos` (`movimiento_id`, `producto_id`, `cantidad`) VALUES
(1, 7, 8),
(2, 6, 1),
(3, 8, 1),
(4, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `pedido_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_entrega` datetime NOT NULL,
  `costo_total` float NOT NULL,
  `observaciones` varchar(400) COLLATE latin1_spanish_ci NOT NULL,
  `copia_mail` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `abastecido` smallint(6) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `fecha_recordatorio` datetime NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  PRIMARY KEY (`pedido_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=65 ;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`pedido_id`, `fecha_entrega`, `costo_total`, `observaciones`, `copia_mail`, `abastecido`, `proveedor_id`, `status`, `fecha_recordatorio`, `sucursal_id`) VALUES
(64, '2018-02-14 00:00:00', 0, '', '', 0, 22, 1, '2018-02-20 00:00:00', 14),
(63, '2017-10-31 00:00:00', 0, 'por ', 'ft', 0, 22, 1, '2017-10-25 00:00:00', 14),
(62, '2017-10-18 00:00:00', 0, 'Test Pedido', 'test@gmail.com', 0, 7, 1, '2017-10-31 00:00:00', 4),
(61, '2017-09-19 00:00:00', 0, '', '', 0, 22, 1, '2017-09-27 00:00:00', 4),
(60, '2017-07-25 00:00:00', 0, 'entre', '', 0, 21, 2, '2017-07-25 00:00:00', 11),
(59, '2017-06-25 00:00:00', 0, '', '', 0, 22, 1, '2017-06-25 00:00:00', 4),
(58, '2017-06-28 00:00:00', 0, '', '', 0, 21, 1, '2017-06-27 00:00:00', 12),
(57, '2017-02-28 00:00:00', 0, '123', '123@123.com', 0, 22, 2, '2017-02-27 00:00:00', 1),
(56, '2017-03-01 00:00:00', 0, 'OBS', 'MAIL@CORREO.COM,', 0, 22, 2, '2017-02-25 00:00:00', 1),
(55, '2017-02-21 00:00:00', 0, 'dfg', 'dfg', 0, 22, 2, '2017-02-20 00:00:00', 1),
(54, '2017-02-22 00:00:00', 0, 'sdf', 'sdfsf', 0, 22, 2, '2017-02-28 00:00:00', 1),
(53, '2017-03-01 00:00:00', 0, 'sdf', 'sdfsdf', 0, 22, 2, '2017-02-20 00:00:00', 1),
(52, '2017-02-22 00:00:00', 0, 'asdas', 'asdd', 0, 22, 2, '2017-02-28 00:00:00', 1),
(51, '2017-02-06 00:00:00', 0, 'asd', 'asdasd', 0, 22, 2, '2017-02-23 00:00:00', 1),
(49, '2017-02-20 00:00:00', 0, 'obs', 'asadad@ddd.com', 0, 22, 2, '2017-03-07 00:00:00', 2),
(50, '2017-02-21 00:00:00', 0, 'asda', 'asdad', 0, 22, 2, '2017-02-22 00:00:00', 1),
(48, '2017-02-14 00:00:00', 0, '', '', 0, 22, 2, '2017-03-01 00:00:00', 1),
(47, '2017-02-28 00:00:00', 0, 'Observaciones de entrega', 'mail@correo.com', 0, 22, 2, '2017-02-14 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE IF NOT EXISTS `prestamos` (
  `prestamo_id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_id` int(11) DEFAULT NULL,
  `prestamo_status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`prestamo_id`),
  UNIQUE KEY `gasto_id_2` (`gasto_id`),
  KEY `gasto_id` (`gasto_id`),
  KEY `gasto_id_3` (`gasto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`prestamo_id`, `gasto_id`, `prestamo_status_id`) VALUES
(5, 9, 1),
(6, 13, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo_status`
--

CREATE TABLE IF NOT EXISTS `prestamo_status` (
  `prestamo_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `prestamo_status_desc` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`prestamo_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `prestamo_status`
--

INSERT INTO `prestamo_status` (`prestamo_status_id`, `prestamo_status_desc`) VALUES
(1, 'activo'),
(2, 'pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `producto_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_name` varchar(100) NOT NULL,
  `producto_sku` varchar(30) NOT NULL,
  `producto_description` text NOT NULL,
  `producto_description_corta` text NOT NULL,
  `producto_price_purchase` float DEFAULT NULL,
  `producto_price_purchase_discount` float DEFAULT NULL,
  `producto_price_purchase_percent` float DEFAULT NULL,
  `producto_price_public` float DEFAULT NULL,
  `producto_price_public_min` float DEFAULT NULL,
  `producto_price_public_discount` float DEFAULT NULL,
  `producto_price_min_public_percent` float DEFAULT NULL,
  `minimo_stock` int(11) NOT NULL,
  `maximo_stock` int(11) NOT NULL,
  `color_id` int(11) NOT NULL DEFAULT '0',
  `material_id` int(11) NOT NULL DEFAULT '0',
  `proveedor_id` int(11) NOT NULL DEFAULT '0',
  `producto_conjunto` int(11) NOT NULL DEFAULT '0',
  `version_id` int(30) NOT NULL,
  `producto_medida` varchar(30) NOT NULL,
  `producto_type` enum('P','U','V') NOT NULL DEFAULT 'P',
  `producto_parent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`producto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `producto_name`, `producto_sku`, `producto_description`, `producto_description_corta`, `producto_price_purchase`, `producto_price_purchase_discount`, `producto_price_purchase_percent`, `producto_price_public`, `producto_price_public_min`, `producto_price_public_discount`, `producto_price_min_public_percent`, `minimo_stock`, `maximo_stock`, `color_id`, `material_id`, `proveedor_id`, `producto_conjunto`, `version_id`, `producto_medida`, `producto_type`, `producto_parent`) VALUES
(1, 'PRODUCTO SIMPLE', 'CON-CAS-E6J3', 'PRODUCTO SIMPLE', '', 1000, 1000, 65, 1650, 1237.5, 1650, 25, 2, 10, 9, 10, 22, 1, 2, '', 'U', 0),
(2, 'PRODUCTO CONJUNTO', 'CON-CAS-D7C1', 'PRODUCTO CONJUNTO', '', 1000, 1000, 65, 1650, 1237.5, 1650, 25, 2, 10, 9, 10, 22, 0, 2, '', 'U', 0),
(3, 'PRODUCTO VARIACION COMPUESTO', 'COM-CAS-F9H9', 'PRODUCTO COMPUESTO', '', 1000, 1000, 65, 1650, 1237.5, 1650, 25, 2, 10, 9, 10, 22, 1, 2, '', 'V', 4),
(4, 'PRODUCTO PRINCIPAL', 'PRI-COM-I7H4', 'PRODUCTO PRINCIPAL', '', 0, 0, 65, 0, 0, 0, 25, 2, 10, 0, 0, 21, 0, 0, '', 'P', 0),
(5, 'Silla', 'SIL-CAS-H1I3', 'asas', '', 500, 500, 65, 825, 618.75, 825, 25, 2, 10, 7, 10, 22, 0, 2, '', 'U', 0),
(6, 'Mesa', 'MES-CAS-C9G3', 'jjjj', '', 1000, 1000, 65, 1650, 1237.5, 1650, 25, 2, 10, 9, 10, 22, 0, 2, '', 'U', 0),
(7, 'Comedor', 'COM-CAS-G8H4', 'sdsdsd', '', 2500, 2500, 65, 4125, 3093.75, 4125, 25, 2, 10, 9, 10, 22, 1, 2, '', 'U', 0),
(8, 'CAMA', 'REC-CAS-C3H8', 'asada', 'asa', 1000, 1000, 65, 1650, 1237.5, 1650, 25, 2, 10, 9, 10, 22, 0, 2, '', 'U', 0),
(9, 'BURO', 'BUR-COM-E7H4', 'ZZZZ', '', 1000, 1000, 65, 1650, 1237.5, 1650, 25, 3, 10, 9, 10, 21, 0, 2, 'Z', 'V', 21),
(10, 'RECAMARA ROMA', 'ROM-CAS-J9E7', 'AAAAA', '', 2000, 2000, 65, 3300, 2475, 3300, 25, 2, 10, 9, 10, 22, 1, 2, '', 'U', 0),
(11, 'HOLANDA', 'HOL-CAS-CHO-SUE-B7H2', 'Cabecera', 'Cabecera Tapizada', 1000, 850, 65, 1650, 1237.5, 1485, 25, 2, 10, 4, 4, 22, 0, 2, '2 X 2', 'U', 0),
(12, 'Kuman', 'KUM-CAS-CHO-I2D9', 'Mueble para TV', 'Muble TV', 1000, 850, 65, 1650, 1155, 1402.5, 30, 2, 10, 4, 11, 22, 0, 2, '50x50', 'U', 0),
(13, 'ESPAÑA SILLON 1', '1-CAS-G4I6', 'SILLON 1', '', 1000, 1000, 65, 1650, 1237.5, 1650, 25, 2, 10, 9, 10, 22, 0, 2, '', 'V', 20),
(14, 'SILLON2', 'SIL-CAS-C7G7', 'SILLON2', '', 1000, 1000, 65, 1650, 1237.5, 1650, 25, 2, 10, 9, 8, 22, 0, 2, '', 'V', 20),
(15, 'SALA ESPAÑA BEIGE', 'BEI-COM-G7J8', 'SALA ESPAÑA', '', 3000, 3000, 65, 4950, 3712.5, 4950, 25, 2, 10, 9, 13, 21, 1, 2, '', 'V', 19),
(16, 'SILLON 1 NEGRO', 'NEG-CAS-NE-E3H7', 'SADASDSA', '', 1000, 1000, 65, 1650, 1237.5, 1650, 25, 2, 10, 6, 13, 22, 0, 2, '', 'V', 20),
(17, 'SILLON 2 NEGRO', 'NEG-DIV-E5G4', 'SADSADAS', '', 1000, 1000, 65, 1650, 1237.5, 1650, 25, 2, 10, 9, 8, 7, 0, 2, '', 'V', 20),
(18, 'SALA ESPAÑA NEGRA', 'NEG-CAS-NE-C2I8', 'ASDASDAS', '', 3000, 3000, 65, 4950, 3712.5, 4950, 25, 2, 10, 6, 13, 22, 1, 2, '', 'V', 19),
(19, 'salas españa', 'ESP-COM-G2H1', 'sasasasa', '', 0, 0, 65, 0, 0, 0, 25, 2, 10, 0, 0, 21, 0, 0, '', 'P', 0),
(20, 'Sillones España', 'ESP-CAS-E6F2', 'asdasdas', '', 0, 0, 65, 0, 0, 0, 25, 2, 10, 0, 0, 22, 0, 0, '', 'P', 0),
(21, 'JJ', 'JJ-DIV-C8E3', 'Está bien chula', 'Chulisima', 0, 0, 65, 0, 0, 0, 25, 10, 20, 0, 0, 7, 0, 0, '10x10 (metros? cm? o qué unida', 'P', 0),
(22, 'Mexico', 'MEX-DIV-H6J7', 'Estampado tÃ­pico mexicano hecha por taraumaras', 'Sala interiores pequeÃ±a', 5000, 4250, 65, 8250, 6187.5, 8250, 25, 10, 20, 7, 11, 7, 0, 0, '2x2', 'V', 23),
(23, 'mexico', 'MEX-DIV-C2E7', 'hghg', 'yth', 0, 0, 65, 0, 0, 0, 25, 0, 0, 0, 0, 7, 0, 0, 'yyt', 'P', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_categorias`
--

CREATE TABLE IF NOT EXISTS `productos_categorias` (
  `producto_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_categorias`
--

INSERT INTO `productos_categorias` (`producto_id`, `categoria_id`) VALUES
(2, 10),
(3, 10),
(4, 10),
(1, 10),
(5, 10),
(7, 10),
(8, 15),
(10, 15),
(6, 10),
(11, 10),
(12, 11),
(13, 6),
(14, 6),
(15, 11),
(15, 5),
(15, 9),
(15, 13),
(16, 10),
(16, 8),
(17, 15),
(18, 15),
(19, 12),
(20, 6),
(9, 15),
(21, 9),
(22, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_conjunto`
--

CREATE TABLE IF NOT EXISTS `productos_conjunto` (
  `producto_id` int(11) NOT NULL,
  `producto_conjunto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_conjunto`
--

INSERT INTO `productos_conjunto` (`producto_id`, `producto_conjunto_id`, `cantidad`) VALUES
(3, 2, 5),
(1, 2, 2),
(7, 5, 4),
(7, 6, 1),
(10, 8, 1),
(10, 9, 2),
(15, 13, 2),
(15, 14, 1),
(18, 16, 2),
(18, 17, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_descuentos`
--

CREATE TABLE IF NOT EXISTS `productos_descuentos` (
  `descuento_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `producto_descuento` float DEFAULT NULL,
  PRIMARY KEY (`descuento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `productos_descuentos`
--

INSERT INTO `productos_descuentos` (`descuento_id`, `producto_id`, `producto_descuento`) VALUES
(1, 11, 0.15),
(2, 12, 0.15),
(4, 22, 0.15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_descuentos_publico`
--

CREATE TABLE IF NOT EXISTS `productos_descuentos_publico` (
  `descuento_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `producto_descuento` float DEFAULT NULL,
  PRIMARY KEY (`descuento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `productos_descuentos_publico`
--

INSERT INTO `productos_descuentos_publico` (`descuento_id`, `producto_id`, `producto_descuento`) VALUES
(1, 11, 0.1),
(2, 12, 0.15),
(3, 22, 0.1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_pedido`
--

CREATE TABLE IF NOT EXISTS `productos_pedido` (
  `idProductoPedido` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProductoPedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `productos_pedido`
--

INSERT INTO `productos_pedido` (`idProductoPedido`, `pedido_id`, `producto_id`, `stock`) VALUES
(8, 47, 1, 1),
(9, 47, 3, 1),
(10, 47, 5, 1),
(11, 48, 1, 1),
(12, 48, 2, 1),
(13, 49, 5, 1),
(14, 50, 5, 1),
(15, 51, 5, 1),
(16, 52, 5, 1),
(17, 53, 5, 1),
(18, 54, 5, 1),
(19, 55, 5, 1),
(20, 56, 10, 1),
(21, 57, 1, 1),
(22, 57, 2, 1),
(23, 60, 9, 1),
(24, 61, 6, 1),
(25, 61, 5, 1),
(26, 62, 17, 1),
(27, 63, 10, 1),
(28, 64, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `proveedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_nombre` varchar(100) DEFAULT NULL,
  `proveedor_nombre_fiscal` varchar(200) NOT NULL,
  `proveedor_representante` varchar(200) NOT NULL,
  `proveedor_direccion` varchar(250) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`proveedor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`proveedor_id`, `proveedor_nombre`, `proveedor_nombre_fiscal`, `proveedor_representante`, `proveedor_direccion`, `telefono`, `email`, `address_id`, `status`) VALUES
(7, 'DIVANO', '', '', NULL, '55 10 79 37 31   Y   55 91 01 70 20', 'vittoriobenzigaby@hotmail.com', 13, 1),
(8, 'NUPCIAL', '', '', NULL, 'JBEDHED', 'JBDKED', 14, 0),
(21, 'Comercial', 'Fiscal', 'Representante', NULL, NULL, 'casdad@asdd.com', 32, 1),
(22, 'Casvil', 'Vilmusa S.A. de C.V.', 'Juan de Pérez', NULL, '55 11 11 11 ', 'casvilmuebles@hotmail.com', 33, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_telefono`
--

CREATE TABLE IF NOT EXISTS `proveedor_telefono` (
  `id_telefono` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) NOT NULL,
  `phone_type_id` int(11) NOT NULL,
  `number` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_telefono`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `proveedor_telefono`
--

INSERT INTO `proveedor_telefono` (`id_telefono`, `proveedor_id`, `phone_type_id`, `number`) VALUES
(1, 19, 1, '77777'),
(2, 20, 1, '123456'),
(3, 20, 2, '789456'),
(4, 7, 1, '55 10 79 37 31  '),
(5, 7, 2, '55 91 01 70 20'),
(6, 21, 1, '123455');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicidad`
--

CREATE TABLE IF NOT EXISTS `publicidad` (
  `id_publicidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) NOT NULL,
  `contenido` longtext NOT NULL,
  `fecha` datetime NOT NULL,
  `status` char(4) NOT NULL DEFAULT 'SE',
  PRIMARY KEY (`id_publicidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `publicidad`
--

INSERT INTO `publicidad` (`id_publicidad`, `nombre`, `contenido`, `fecha`, `status`) VALUES
(7, 'Campaña Navideña', '\n                            <h5><ul><li style="line-height: 1.5;"><span style="color: inherit; font-family: Arial; font-weight: bold;">Aprovecha nuestras mejores promociones, con un 20% 30% y hasta un 50% esta navidad 2016.</span><br></li><li style="line-height: 1.5;"><span style="font-family: Arial; font-weight: bold; color: rgb(255, 0, 0);">Todos los colchones Carreiro con un 15% adicional.</span></li><li style="line-height: 1.5;"><span style="font-family: Arial; font-weight: bold; color: rgb(255, 0, 0);"><img src="data:image/png;base64,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" style="width: 204px;"><br></span></li></ul></h5>                        ', '2016-11-25 02:15:57', 'E'),
(8, 'ggghhh', 'dsdsdsdssd', '2017-03-22 08:16:32', 'SE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `venta_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime NOT NULL,
  `monto` float NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `venta_flete_id` int(11) DEFAULT NULL,
  `costo_envio` float DEFAULT NULL,
  `detalle_envio` text COLLATE latin1_spanish_ci,
  `cliente_direccion_id` int(11) DEFAULT NULL,
  `email_facturacion` varchar(128) COLLATE latin1_spanish_ci DEFAULT NULL,
  `venta_estatus_id` int(11) DEFAULT NULL,
  `venta_entrega` int(11) DEFAULT NULL,
  `venta_tipo` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `factura_generada` int(11) DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  PRIMARY KEY (`venta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`venta_id`, `fecha_creacion`, `monto`, `sucursal_id`, `id_cliente`, `venta_flete_id`, `costo_envio`, `detalle_envio`, `cliente_direccion_id`, `email_facturacion`, `venta_estatus_id`, `venta_entrega`, `venta_tipo`, `factura_generada`, `fecha_entrega`) VALUES
(1, '2017-10-16 16:39:14', 5742, 1, 7, 4, 500, '{"select_zona_envio":"seccion 1","fecha_hora_entrega":"18/Oct/2017 12:00 hrs","select_planta":"Planta Baja","select_planta_extra":"A pie de puerta"}', 1, 'shingoo_n@yahoo.com.mx', 2, 0, '1', 0, '0000-00-00 00:00:00'),
(2, '2017-10-16 16:48:55', 1650, 1, 7, 4, 500, '{"select_zona_envio":"seccion 1","fecha_hora_entrega":"20/Oct/2017 12:00 hrs","select_planta":"Planta Baja","select_planta_extra":"Al interior de la vivienda"}', 0, '', 2, 0, '1', 0, '0000-00-00 00:00:00'),
(3, '2017-10-16 16:50:39', 1650, 1, 7, 0, 0, '"Flete externo"', 0, '', 1, 0, '1', 0, '0000-00-00 00:00:00'),
(4, '2017-10-16 16:56:38', 6600, 1, 7, 0, 0, '"Flete externo"', 0, '', 1, 0, '2', 0, '0000-00-00 00:00:00'),
(5, '2017-10-18 13:19:04', 8250, 1, 7, 4, 1500, '{"select_zona_envio":"seccion 3","fecha_hora_entrega":"18/Oct/2017 12:00 hrs","select_planta":"Piso 4","select_planta_extra":"Al interior de la vivienda"}', 0, '', 2, 0, '1', 0, '0000-00-00 00:00:00'),
(6, '2017-11-06 22:32:23', 7425, 1, 2, 8, 500, '{"select_zona_envio":"seccion 1","fecha_hora_entrega":"06/Nov/2017 12:00 hrs","select_planta":"Planta Baja","select_planta_extra":"Al interior de la vivienda"}', 0, '', 2, 0, '1', 0, '0000-00-00 00:00:00'),
(7, '2018-02-01 04:18:27', 8250, 1, 2, 8, 500, '{"select_zona_envio":"seccion 1","fecha_hora_entrega":"01/Feb/2018 12:00 hrs","select_planta":"Piso 2","select_planta_extra":"A pie de puerta"}', 0, '', 2, 0, '1', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_estatus`
--

CREATE TABLE IF NOT EXISTS `ventas_estatus` (
  `ventas_estatus_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ventas_estatus_nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`ventas_estatus_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ventas_estatus`
--

INSERT INTO `ventas_estatus` (`ventas_estatus_id`, `ventas_estatus_nombre`) VALUES
(1, 'pago pendiente'),
(2, 'pagado'),
(3, 'cancelado'),
(4, 'vencido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_nota_entrega`
--

CREATE TABLE IF NOT EXISTS `ventas_nota_entrega` (
  `venta_nota_entrega_id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_id` int(11) NOT NULL,
  `descripcion_nota` varchar(1024) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`venta_nota_entrega_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ventas_nota_entrega`
--

INSERT INTO `ventas_nota_entrega` (`venta_nota_entrega_id`, `venta_id`, `descripcion_nota`, `fecha`) VALUES
(1, 6, 'asdasd', '2018-01-22 18:48:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_pagos`
--

CREATE TABLE IF NOT EXISTS `ventas_pagos` (
  `ventas_pagos_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `general_forma_de_pago_id` int(10) unsigned NOT NULL,
  `monto` float NOT NULL,
  `referencia` varchar(45) DEFAULT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  `cobro_identificado` int(10) unsigned DEFAULT '0',
  `venta_id` int(10) unsigned NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`ventas_pagos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `ventas_pagos`
--

INSERT INTO `ventas_pagos` (`ventas_pagos_id`, `general_forma_de_pago_id`, `monto`, `referencia`, `observaciones`, `cobro_identificado`, `venta_id`, `fecha`) VALUES
(1, 1, 4950, '', NULL, 0, 1, '2017-10-16 16:39:14'),
(2, 2, 792, '123', NULL, 0, 1, '2017-10-16 16:39:14'),
(3, 3, 500, '1234', NULL, 0, 1, '2017-10-16 16:39:14'),
(4, 1, 2150, '', NULL, 0, 2, '2017-10-16 16:48:55'),
(5, 1, 1200, '', NULL, 0, 3, '2017-10-16 16:50:39'),
(6, 1, 600, '', NULL, 0, 4, '2017-10-16 16:56:38'),
(7, 1, 9750, '', NULL, 0, 5, '2017-10-18 13:19:04'),
(8, 1, 7925, '', NULL, 0, 6, '2017-11-06 22:32:23'),
(9, 1, 8750, '', NULL, 0, 7, '2018-02-01 04:18:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_productos`
--

CREATE TABLE IF NOT EXISTS `ventas_productos` (
  `ventas_productos_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `venta_id` int(10) unsigned NOT NULL,
  `producto_id` int(10) unsigned NOT NULL,
  `producto_sku` varchar(45) NOT NULL,
  `producto_name` varchar(45) NOT NULL,
  `cantidad` int(10) unsigned NOT NULL,
  `precio` float NOT NULL,
  `subtotal` float NOT NULL,
  `producto_imagen` varchar(45) NOT NULL,
  `iva` float NOT NULL,
  PRIMARY KEY (`ventas_productos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `ventas_productos`
--

INSERT INTO `ventas_productos` (`ventas_productos_id`, `venta_id`, `producto_id`, `producto_sku`, `producto_name`, `cantidad`, `precio`, `subtotal`, `producto_imagen`, `iva`) VALUES
(1, 1, 9, 'BUR-COM-E7H4', 'BURO', 1, 1650, 1650, 'http://globmint.com/uploads/productos/product', 1650),
(2, 1, 6, 'MES-CAS-C9G3', 'Mesa', 1, 1650, 1650, 'http://globmint.com/uploads/productos/product', 1650),
(3, 1, 8, 'REC-CAS-C3H8', 'CAMA', 1, 1650, 1650, 'https://globmint.com/img/imagen-no.png', 1650),
(4, 2, 9, 'BUR-COM-E7H4', 'BURO', 1, 1650, 1650, 'http://globmint.com/uploads/productos/product', 1650),
(5, 3, 12, 'KUM-CAS-CHO-I2D9', 'Kuman', 1, 1650, 1650, 'http://globmint.com/uploads/productos/product', 1650),
(6, 4, 11, 'HOL-CAS-CHO-SUE-B7H2', 'HOLANDA', 4, 1650, 6600, 'http://globmint.com/uploads/productos/product', 6600),
(7, 5, 11, 'HOL-CAS-CHO-SUE-B7H2', 'HOLANDA', 5, 1650, 8250, 'https://globmint.com/uploads/productos/produc', 8250),
(8, 6, 11, 'HOL-CAS-CHO-SUE-B7H2', 'HOLANDA', 6, 1237.5, 7425, 'http://globmint.com/uploads/productos/product', 7425),
(9, 7, 22, 'MEX-DIV-H6J7', 'Mexico', 1, 8250, 8250, 'https://globmint.com/uploads/productos/produc', 8250);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `versiones`
--

CREATE TABLE IF NOT EXISTS `versiones` (
  `version_id` int(11) NOT NULL AUTO_INCREMENT,
  `version_name` varchar(64) DEFAULT NULL,
  `version_abrev` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`version_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `versiones`
--

INSERT INTO `versiones` (`version_id`, `version_name`, `version_abrev`) VALUES
(2, '3-2-1', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente_email`
--
ALTER TABLE `cliente_email`
  ADD CONSTRAINT `cliente_email_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `cliente_telefono`
--
ALTER TABLE `cliente_telefono`
  ADD CONSTRAINT `cliente_telefono_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `cliente_telefono_ibfk_2` FOREIGN KEY (`phone_type_id`) REFERENCES `inv_phone_type` (`phone_type_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
