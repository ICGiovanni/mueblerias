-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-01-2017 a las 16:05:40
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pentaglobal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
`categoria_id` int(11) NOT NULL,
  `categoria_name` varchar(64) DEFAULT NULL,
  `categoria_abrev` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `categoria_name`, `categoria_abrev`) VALUES
(1, 'Recamaras', 'RE'),
(2, 'Salas', 'SAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
`id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidoP` varchar(100) NOT NULL DEFAULT 'N/A',
  `apellidoM` varchar(100) NOT NULL DEFAULT 'N/A',
  `razon_social` varchar(100) NOT NULL DEFAULT 'N/A',
  `rfc` varchar(13) NOT NULL DEFAULT 'N/A',
  `calle` varchar(100) NOT NULL DEFAULT 'N/A',
  `num_exterior` varchar(50) NOT NULL DEFAULT 'N/A',
  `num_interior` varchar(50) NOT NULL DEFAULT 'N/A',
  `colonia` varchar(100) NOT NULL DEFAULT 'N/A',
  `codigo_postal` varchar(10) NOT NULL DEFAULT 'N/A',
  `municipio` varchar(100) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellidoP`, `apellidoM`, `razon_social`, `rfc`, `calle`, `num_exterior`, `num_interior`, `colonia`, `codigo_postal`, `municipio`, `id_estado`, `rating`) VALUES
(2, 'Uriel Medina22', 'sdsdfdsds', 'dsfsdf', 'ALFREDO URIEL555', 'MEGA8611232F3', 'MANUEL COTERO2', '144-B2', '2', 'CARLOS HANK GONZALEZ2', '500262', 'TOLUCA2', 11, 0),
(5, 'prueba', 'prueba', 'prueba', '', '', '', '', '', '', '', '', 6, 0),
(6, 'asssasa', 'ffff', 'ffffff', '', '', '', '', '', '', '', '', 0, 0),
(7, 'asssasa', 'ffff', 'ffffff', '', '', '', '', '', '', '', '', 0, 0),
(8, 'asssasa', 'ffff', 'ffffff', '', '', '', '', '', '', '', '', 0, 0),
(9, 'wwwww', 'wwww', 'wwwww', '', '', '', '', '', '', '', '', 0, 0),
(10, 'wwwww', 'wwww', 'wwwww', '', '', '', '', '', '', '', '', 0, 0),
(11, 'wwwww', 'wwww', 'wwwww', '', '', '', '', '', '', '', '', 0, 0),
(12, 'wwwww', 'wwww', 'wwwww', '', '', '', '', '', '', '', '', 0, 0),
(13, 'wwwww', 'wwww', 'wwwww', '', '', '', '', '', '', '', '', 0, 0),
(14, 'wwwww', 'wwww', 'wwwww', '', '', '', '', '', '', '', '', 0, 0),
(15, 'sadsadsa', 'sdsasdsads', 'sadsads', 'asdsadsds', 'asdsadsad', 'sadsad', '', '', '', '', '', 0, 0),
(16, 'CLIENTE', 'CLIENTE', 'CLIENTE', '', '', '', '', '', '', '', '', 5, 0),
(17, 'prueba 2', 'prueba 2', 'prueba 2', '', '', '', '', '', '', '', '', 0, 0),
(18, 'pruebaffffff', 'pruebaffffprueba', 'pruebafff', '', '', '', '', '', '', '', '', 0, 0),
(19, '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(20, '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(21, '', '', '', '', '', '', '', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_email`
--

CREATE TABLE IF NOT EXISTS `cliente_email` (
`id_email` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `email` varchar(120) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente_email`
--

INSERT INTO `cliente_email` (`id_email`, `id_cliente`, `email`) VALUES
(1, 16, 'ASAS@SDSDS.COM'),
(2, 17, 'asasas@hhhas.com'),
(3, 18, 'ussdads@yahoo.com.mx'),
(4, 18, 'sasaas@sasdasd.com'),
(5, 18, 'asasa@sdsds.com'),
(6, 18, 'sasasa@jj.com'),
(7, 2, 'uuu@yyyaaa.com'),
(8, 2, 'uuu@yyyaaa.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_telefono`
--

CREATE TABLE IF NOT EXISTS `cliente_telefono` (
`id_telefono` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `phone_type_id` int(11) NOT NULL,
  `number` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente_telefono`
--

INSERT INTO `cliente_telefono` (`id_telefono`, `id_cliente`, `phone_type_id`, `number`) VALUES
(1, 7, 1, '44444'),
(2, 10, 1, '444444'),
(3, 10, 2, '66666'),
(6, 12, 1, '444444'),
(7, 12, 2, '66666'),
(8, 13, 1, '444444'),
(9, 13, 2, '66666'),
(10, 14, 1, '444444'),
(11, 14, 2, '66666'),
(16, 11, 1, '444444'),
(17, 11, 2, '66666'),
(18, 15, 1, '223233'),
(19, 16, 1, '722222'),
(20, 17, 1, '72727272'),
(24, 18, 1, '2233333');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE IF NOT EXISTS `colores` (
`color_id` int(11) NOT NULL,
  `color_name` varchar(64) DEFAULT NULL,
  `color_abrev` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`color_id`, `color_name`, `color_abrev`) VALUES
(0, '', ''),
(1, 'Amarillo', 'AMA'),
(2, 'Rojo', 'RO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
`id_estado` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

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
-- Estructura de tabla para la tabla `imagenes_productos`
--

CREATE TABLE IF NOT EXISTS `imagenes_productos` (
`imagen_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `imagen_name` varchar(100) DEFAULT NULL,
  `imagen_route` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_productos`
--

CREATE TABLE IF NOT EXISTS `inventario_productos` (
`inventario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario_productos`
--

INSERT INTO `inventario_productos` (`inventario_id`, `producto_id`, `sucursal_id`, `cantidad`) VALUES
(1, 11, 1, 1),
(2, 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_address`
--

CREATE TABLE IF NOT EXISTS `inv_address` (
`address_id` int(11) NOT NULL,
  `street` varchar(128) DEFAULT NULL,
  `number` varchar(45) DEFAULT NULL,
  `neighborhood` varchar(128) DEFAULT NULL,
  `municipality` varchar(128) DEFAULT NULL,
  `zip_code` varchar(6) DEFAULT NULL,
  `state` varchar(128) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_login`
--

CREATE TABLE IF NOT EXISTS `inv_login` (
`login_id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_id` int(4) DEFAULT NULL,
  `collaborator` tinyint(4) DEFAULT '0',
  `sucursal_id` tinyint(4) DEFAULT '0',
  `address_id` tinyint(4) DEFAULT '0',
  `salary` float DEFAULT NULL,
  `comision` float DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `status_id` tinyint(4) DEFAULT '2',
  `created_timestamp` int(11) DEFAULT NULL,
  `modify_timestamp` int(11) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `last_logout` int(11) DEFAULT NULL,
  `url_image` varchar(256) DEFAULT '<i class=''fa fa-user fa-3x''></i>'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inv_login`
--

INSERT INTO `inv_login` (`login_id`, `firstName`, `lastName`, `email`, `password`, `profile_id`, `collaborator`, `sucursal_id`, `address_id`, `salary`, `comision`, `birthdate`, `status_id`, `created_timestamp`, `modify_timestamp`, `last_login`, `last_logout`, `url_image`) VALUES
(1, 'Root', 'Globmint', 'root@globmint.com', '6E/nLHChQ9iTtyuqeuvAgledicZhEsipGnJWN+XTMCY=', 1, 0, 1, 1, NULL, NULL, NULL, 1, 1460155058, 1481150395, NULL, NULL, '<i class=''fa fa-user fa-3x''></i>'),
(26, 'Giovanni', 'Estrada', 'vagio12345@gmail.com', 'uno2tres', 1, 0, 1, 1, 0, 0, '2016-08-14', 2, 1471233443, 1471233443, NULL, NULL, '<i class=''fa fa-user fa-3x''></i>'),
(27, 'Pedrito', 'Bodeguero', 'pedrito@123.com', 'uno2tres', 1, 0, 1, 1, 0, 0, '2016-08-14', 2, 1471233602, 1471233602, NULL, NULL, '<i class=''fa fa-user fa-3x''></i>'),
(28, 'Usuario', 'Nuevo', 'correo@test.com', 'uno2tres', 1, 0, 1, 1, 0, 0, '2016-08-14', 2, 1471233988, 1471233988, NULL, NULL, '<i class=''fa fa-user fa-3x''></i>'),
(29, 'José ', '', '', '', 1, 1, 1, 1, 0, 0, '2016-08-15', 2, 1471306052, 1471306052, NULL, NULL, '<i class=''fa fa-user fa-3x''></i>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_login_phone_number`
--

CREATE TABLE IF NOT EXISTS `inv_login_phone_number` (
`login_phone_number_id` int(11) NOT NULL,
  `login_id` varchar(45) DEFAULT NULL,
  `phone_type_id` int(11) NOT NULL,
  `number` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_phone_type`
--

CREATE TABLE IF NOT EXISTS `inv_phone_type` (
`phone_type_id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inv_phone_type`
--

INSERT INTO `inv_phone_type` (`phone_type_id`, `type`) VALUES
(1, 'Celular'),
(2, 'Casa'),
(3, 'Oficina'),
(4, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_profile`
--

CREATE TABLE IF NOT EXISTS `inv_profile` (
`profile_id` int(11) NOT NULL,
  `profile_name` varchar(25) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `inv_profile`
--

INSERT INTO `inv_profile` (`profile_id`, `profile_name`) VALUES
(1, 'Administrador'),
(2, 'Distribuidor'),
(3, 'Root');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_profile_pages`
--

CREATE TABLE IF NOT EXISTS `inv_profile_pages` (
`idProfilePage` int(11) NOT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `page` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inv_profile_pages`
--

INSERT INTO `inv_profile_pages` (`idProfilePage`, `profile_id`, `page`) VALUES
(1, 1, 'login/profile.php'),
(2, 2, 'login/profile.php'),
(3, 1, 'usuarios/index.php'),
(4, 1, 'clientes/index.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_status`
--

CREATE TABLE IF NOT EXISTS `inv_status` (
`status_id` int(11) NOT NULL,
  `status_name` varchar(25) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

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
`sucursal_id` int(11) NOT NULL,
  `sucursal_name` varchar(64) COLLATE latin1_spanish_ci DEFAULT NULL,
  `sucursal_abrev` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `inv_sucursales`
--

INSERT INTO `inv_sucursales` (`sucursal_id`, `sucursal_name`, `sucursal_abrev`) VALUES
(1, 'ALLE74A1', 'ALLE74A1'),
(2, 'ALLE74B2', 'ALLE74B2'),
(3, 'ALLE69C3', 'ALLE69C3'),
(4, 'PASA40D4', 'PASA40D4'),
(5, 'BRAS94E5', 'BRAS94E5'),
(6, 'ECUA89F6', 'ECUA89F6'),
(7, 'ECUA91G7', 'ECUA91G7'),
(8, 'COMO18H8', 'COMO18H8'),
(9, 'REFO364I9', 'REFO364I9'),
(10, 'PERU14J10', 'PERU14J10'),
(11, 'BODE14K11', 'BODE14K11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE IF NOT EXISTS `materiales` (
`material_id` int(11) NOT NULL,
  `material_name` varchar(64) DEFAULT NULL,
  `material_abrev` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`material_id`, `material_name`, `material_abrev`) VALUES
(0, '', ''),
(1, 'Caoba', 'CA'),
(2, 'Pino', 'PIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_inventario`
--

CREATE TABLE IF NOT EXISTS `movimientos_inventario` (
`movimiento_id` int(11) NOT NULL,
  `usuario_id_salida` int(11) NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `sucursal_id_salida` int(11) NOT NULL,
  `nota_salida` text NOT NULL,
  `chofer` varchar(100) DEFAULT NULL,
  `estatus` varchar(30) DEFAULT NULL,
  `usuario_id_entrega` int(11) NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `sucursal_id_entrada` int(11) NOT NULL,
  `nota_entrega` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos_inventario`
--

INSERT INTO `movimientos_inventario` (`movimiento_id`, `usuario_id_salida`, `fecha_salida`, `sucursal_id_salida`, `nota_salida`, `chofer`, `estatus`, `usuario_id_entrega`, `fecha_entrega`, `sucursal_id_entrada`, `nota_entrega`) VALUES
(5, 0, '2016-11-11 07:38:50', 0, '', '', 'EP', 1, '2016-11-11 07:38:50', 1, ''),
(6, 0, '2016-11-11 07:40:20', 0, '', '', 'EP', 1, '2016-11-11 07:40:20', 1, '');

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
(1, 4, 100),
(1, 3, 100),
(2, 3, 1),
(3, 3, 1),
(4, 3, 1),
(5, 4, 1),
(6, 4, 1),
(7, 4, 1),
(8, 3, 1),
(9, 3, 1),
(1, 4, 1),
(2, 4, 1),
(3, 4, 1),
(4, 4, 1),
(5, 11, 1),
(6, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
`producto_id` int(11) NOT NULL,
  `producto_name` varchar(100) NOT NULL,
  `producto_sku` varchar(30) NOT NULL,
  `producto_description` text NOT NULL,
  `producto_description_corta` varchar(200) NOT NULL,
  `producto_price_purchase` float DEFAULT NULL,
  `producto_price_purchase_discount` float DEFAULT NULL,
  `producto_price_purchase_percent` float NOT NULL,
  `producto_price_public` float DEFAULT NULL,
  `producto_price_public_min` float DEFAULT NULL,
  `producto_price_public_discount` float DEFAULT NULL,
  `producto_price_min_public_percent` float NOT NULL,
  `color_id` int(11) NOT NULL DEFAULT '0',
  `material_id` int(11) NOT NULL DEFAULT '0',
  `proveedor_id` int(11) NOT NULL DEFAULT '0',
  `producto_conjunto` int(11) NOT NULL DEFAULT '0',
  `version_id` int(30) NOT NULL,
  `producto_medida` varchar(30) NOT NULL,
  `producto_type` enum('P','U','V') NOT NULL DEFAULT 'P',
  `producto_parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `producto_name`, `producto_sku`, `producto_description`, `producto_description_corta`, `producto_price_purchase`, `producto_price_purchase_discount`, `producto_price_purchase_percent`, `producto_price_public`, `producto_price_public_min`, `producto_price_public_discount`, `producto_price_min_public_percent`, `color_id`, `material_id`, `proveedor_id`, `producto_conjunto`, `version_id`, `producto_medida`, `producto_type`, `producto_parent`) VALUES
(1, 'RECAMARA VALENCIA', 'VAL-I9', 'VALENCIANA', 'valencia2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '', 'P', 0),
(2, 'VALENCIANA', 'VAL-RO-PIN-H9', '', '', 13000, 13000, 0, 15000, 15000, 15000, 0, 2, 2, 1, 0, 0, '', 'V', 1),
(3, 'MESA VALENCIA', 'VAL-RO-CA-B8', 'MESA VALENCIA', '', 2000, 1440, 0, 2500, 2500, 2500, 0, 2, 1, 1, 0, 0, 'prueba', 'V', 20),
(7, 'unico', 'UNI-RO-CA-G1', 'unic', '', 2000, 2000, 0, 4000, 4000, 4000, 0, 2, 1, 1, 0, 0, '', 'U', 0),
(8, 'unico', 'UNI-RO-CA-G1', 'unic', '', 2000, 1260, 0, 4000, 4000, 4000, 0, 2, 1, 1, 0, 0, '', 'U', 0),
(9, 'unico', 'UNI-RO-CA-G1', 'unic', '', 2000, 1440, 0, 4000, 4000, 4000, 0, 2, 1, 1, 0, 0, '', 'U', 0),
(10, 'Prueba', 'PRU-AMA-PIN-G5', '', '', 1000, 1000, 0, 2000, 2000, 2000, 0, 1, 2, 1, 0, 0, '', 'V', 1),
(11, 'Prueba2', 'PRU-AMA-PIN-D7', '', '', 1000, 855, 0, 10000, 90000, 8550, 0, 1, 2, 1, 1, 0, '', 'V', 1),
(13, 'prueba', 'PRU-PRO-B9D1', 'aaaa', 'aaaa', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '', 'P', 0),
(14, 'prueba', 'PRU-PRO-B9D1', 'aaaa', 'aaaa', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '', 'P', 0),
(15, 'prueba', 'PRU-PRO-B9D1', 'aaaa', 'aaaa', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '', 'P', 0),
(16, 'prueba', 'PRU-PRO-B9D1', 'aaaa', 'aaaa', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '', 'P', 0),
(17, 'prueba', 'PRU-PRO-B9D1', 'aaaa', 'aaaa', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '', 'P', 0),
(18, 'prueba', 'PRU-PRO-B9D1', 'aaaa', 'aaaa', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '', 'P', 0),
(19, 'prueba', 'PRU-PRO-B9D1', 'aaaa', 'aaaa', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '', 'P', 0),
(20, 'prueba', 'PRU-PRO-B9D1', 'aaaa', 'aaaa', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '', 'P', 0),
(21, 'Prueba precios', 'PRE-PRO-AMA-CA-J5I2', 'ssssss', 'sssssss', 1000, 1000, 65, 1650, 1237.5, 1650, 65, 1, 1, 1, 1, 0, '', 'U', 0),
(22, 'assaassassa', 'ASS-PRO-AMA-CA-B3H7', 'asdsadas', 'asdasdsad', 10000, 10000, 65, 16500, 12375, 16500, 25, 1, 1, 2, 0, 0, '', 'U', 0),
(23, 'prueba', 'PRU-PRO-C7E6', 'wwww', '', 100, 100, 65, 165, 123.75, 165, 25, 0, 0, 1, 0, 0, '222', 'U', 0),
(24, 'aaaa', 'AAA-PRO-AMA-CA-G1D6', 'aaaaa', '', 1000, 1000, 65, 1650, 1237.5, 1650, 25, 1, 1, 1, 0, 2, '', 'U', 0);

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
(2, 1),
(7, 1),
(8, 1),
(9, 1),
(3, 1),
(1, 1),
(13, 0),
(13, 1),
(14, 0),
(14, 1),
(15, 0),
(15, 1),
(16, 0),
(16, 1),
(17, 0),
(17, 1),
(18, 0),
(18, 1),
(19, 0),
(19, 1),
(22, 2),
(20, 1),
(21, 1),
(23, 2),
(24, 1);

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
(11, 3, 1),
(21, 22, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_descuentos`
--

CREATE TABLE IF NOT EXISTS `productos_descuentos` (
`descuento_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `producto_descuento` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_descuentos`
--

INSERT INTO `productos_descuentos` (`descuento_id`, `producto_id`, `producto_descuento`) VALUES
(9, 8, 30),
(10, 8, 10),
(11, 9, 0.2),
(12, 9, 0.1),
(13, 3, 0.2),
(14, 3, 0.1),
(31, 11, 0.1),
(32, 11, 0.05),
(33, 12, 0.1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_descuentos_publico`
--

CREATE TABLE IF NOT EXISTS `productos_descuentos_publico` (
`descuento_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `producto_descuento` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_descuentos_publico`
--

INSERT INTO `productos_descuentos_publico` (`descuento_id`, `producto_id`, `producto_descuento`) VALUES
(1, 10, 0.2),
(2, 10, 0.1),
(19, 11, 0.1),
(20, 11, 0.05),
(21, 12, 0.1),
(22, 12, 0.05);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
`proveedor_id` int(11) NOT NULL,
  `proveedor_nombre` varchar(100) DEFAULT NULL,
  `proveedor_direccion` varchar(250) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`proveedor_id`, `proveedor_nombre`, `proveedor_direccion`, `telefono`, `email`, `address_id`) VALUES
(1, 'proveedor 01', NULL, NULL, NULL, NULL),
(2, 'proveedor 02', NULL, NULL, NULL, NULL),
(3, 'proveedor 03', NULL, NULL, NULL, NULL),
(4, 'proveedor 04', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicidad`
--

CREATE TABLE IF NOT EXISTS `publicidad` (
`id_publicidad` int(11) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `contenido` longtext NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicidad`
--

INSERT INTO `publicidad` (`id_publicidad`, `nombre`, `contenido`, `fecha`) VALUES
(1, 'Prueba', '<img src="data:image/jpeg;base64,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" style="width: 1024px;">\n                            \n                        ', '2016-08-27 09:43:32');
INSERT INTO `publicidad` (`id_publicidad`, `nombre`, `contenido`, `fecha`) VALUES
(2, 'Prueba', '<img src="data:image/jpeg;base64,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" style="width: 1024px;"><br>\n                            \n                        ', '2016-09-03 06:23:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `versiones`
--

CREATE TABLE IF NOT EXISTS `versiones` (
`version_id` int(11) NOT NULL,
  `version_name` varchar(64) DEFAULT NULL,
  `version_abrev` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `versiones`
--

INSERT INTO `versiones` (`version_id`, `version_name`, `version_abrev`) VALUES
(2, 'sdsdsds', '3333');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
 ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
 ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `cliente_email`
--
ALTER TABLE `cliente_email`
 ADD PRIMARY KEY (`id_email`), ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `cliente_telefono`
--
ALTER TABLE `cliente_telefono`
 ADD PRIMARY KEY (`id_telefono`), ADD KEY `id_cliente` (`id_cliente`), ADD KEY `phone_type_id` (`phone_type_id`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
 ADD PRIMARY KEY (`color_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
 ADD PRIMARY KEY (`id_estado`), ADD UNIQUE KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
 ADD PRIMARY KEY (`imagen_id`);

--
-- Indices de la tabla `inventario_productos`
--
ALTER TABLE `inventario_productos`
 ADD PRIMARY KEY (`inventario_id`);

--
-- Indices de la tabla `inv_address`
--
ALTER TABLE `inv_address`
 ADD PRIMARY KEY (`address_id`);

--
-- Indices de la tabla `inv_login`
--
ALTER TABLE `inv_login`
 ADD PRIMARY KEY (`login_id`);

--
-- Indices de la tabla `inv_login_phone_number`
--
ALTER TABLE `inv_login_phone_number`
 ADD PRIMARY KEY (`login_phone_number_id`);

--
-- Indices de la tabla `inv_phone_type`
--
ALTER TABLE `inv_phone_type`
 ADD PRIMARY KEY (`phone_type_id`);

--
-- Indices de la tabla `inv_profile`
--
ALTER TABLE `inv_profile`
 ADD PRIMARY KEY (`profile_id`);

--
-- Indices de la tabla `inv_profile_pages`
--
ALTER TABLE `inv_profile_pages`
 ADD PRIMARY KEY (`idProfilePage`);

--
-- Indices de la tabla `inv_status`
--
ALTER TABLE `inv_status`
 ADD PRIMARY KEY (`status_id`);

--
-- Indices de la tabla `inv_sucursales`
--
ALTER TABLE `inv_sucursales`
 ADD PRIMARY KEY (`sucursal_id`);

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
 ADD PRIMARY KEY (`material_id`);

--
-- Indices de la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
 ADD PRIMARY KEY (`movimiento_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
 ADD PRIMARY KEY (`producto_id`);

--
-- Indices de la tabla `productos_descuentos`
--
ALTER TABLE `productos_descuentos`
 ADD PRIMARY KEY (`descuento_id`);

--
-- Indices de la tabla `productos_descuentos_publico`
--
ALTER TABLE `productos_descuentos_publico`
 ADD PRIMARY KEY (`descuento_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
 ADD PRIMARY KEY (`proveedor_id`);

--
-- Indices de la tabla `publicidad`
--
ALTER TABLE `publicidad`
 ADD PRIMARY KEY (`id_publicidad`);

--
-- Indices de la tabla `versiones`
--
ALTER TABLE `versiones`
 ADD PRIMARY KEY (`version_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `cliente_email`
--
ALTER TABLE `cliente_email`
MODIFY `id_email` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `cliente_telefono`
--
ALTER TABLE `cliente_telefono`
MODIFY `id_telefono` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
MODIFY `imagen_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `inventario_productos`
--
ALTER TABLE `inventario_productos`
MODIFY `inventario_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `inv_address`
--
ALTER TABLE `inv_address`
MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `inv_login`
--
ALTER TABLE `inv_login`
MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `inv_login_phone_number`
--
ALTER TABLE `inv_login_phone_number`
MODIFY `login_phone_number_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `inv_phone_type`
--
ALTER TABLE `inv_phone_type`
MODIFY `phone_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `inv_profile`
--
ALTER TABLE `inv_profile`
MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `inv_profile_pages`
--
ALTER TABLE `inv_profile_pages`
MODIFY `idProfilePage` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `inv_status`
--
ALTER TABLE `inv_status`
MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `inv_sucursales`
--
ALTER TABLE `inv_sucursales`
MODIFY `sucursal_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `materiales`
--
ALTER TABLE `materiales`
MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
MODIFY `movimiento_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `productos_descuentos`
--
ALTER TABLE `productos_descuentos`
MODIFY `descuento_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `productos_descuentos_publico`
--
ALTER TABLE `productos_descuentos_publico`
MODIFY `descuento_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
MODIFY `proveedor_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `publicidad`
--
ALTER TABLE `publicidad`
MODIFY `id_publicidad` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `versiones`
--
ALTER TABLE `versiones`
MODIFY `version_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
