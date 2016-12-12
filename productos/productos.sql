DROP TABLE IF EXISTS `colores`;
CREATE TABLE IF NOT EXISTS `colores` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(64) DEFAULT NULL,
  `color_abrev` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `colores`
  ADD PRIMARY KEY (`color_id`);

ALTER TABLE `colores`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT;


DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `categoria_id` int(11) NOT NULL,
  `categoria_name` varchar(64) DEFAULT NULL,
  `categoria_abrev` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT;


DROP TABLE IF EXISTS `materiales`;
CREATE TABLE IF NOT EXISTS `materiales` (
  `material_id` int(11) NOT NULL,
  `material_name` varchar(64) DEFAULT NULL,
  `material_abrev` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `materiales`
  ADD PRIMARY KEY (`material_id`);

ALTER TABLE `materiales`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT;

DROP TABLE IF EXISTS `versiones`;
CREATE TABLE IF NOT EXISTS `versiones` (
  `version_id` int(11) NOT NULL,
  `version_name` varchar(64) DEFAULT NULL,
  `version_abrev` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `versiones`
  ADD PRIMARY KEY (`version_id`);
  
ALTER TABLE `versiones`
  MODIFY `version_id` int(11) NOT NULL AUTO_INCREMENT;
  
  
CREATE TABLE IF NOT EXISTS productos
(
	producto_id INT NOT NULL AUTO_INCREMENT,
	producto_name VARCHAR(100) NOT NULL,
	producto_sku VARCHAR(30) NOT NULL,
	producto_description TEXT NOT NULL,
	producto_description_corta TEXT NOT NULL,
	producto_price_purchase FLOAT,
	producto_price_purchase_discount FLOAT,
	producto_price_purchase_percent FLOAT,
	producto_price_public FLOAT,
	producto_price_public_min FLOAT,
	producto_price_public_discount FLOAT,
	producto_price_min_public_percent FLOAT,
	color_id INT NOT NULL DEFAULT 0,
	material_id INT NOT NULL DEFAULT 0,
	proveedor_id INT NOT NULL DEFAULT 0,
	producto_conjunto INT NOT NULL DEFAULT 0,
	producto_version VARCHAR(30) NOT NULL,
	producto_medida VARCHAR(30) NOT NULL,
	producto_type ENUM('P','U','V') NOT NULL DEFAULT 'P',
	producto_parent INT NOT NULL DEFAULT 0,
	PRIMARY KEY (producto_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS productos_categorias
(
	producto_id INT NOT NULL,
	categoria_id INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS imagenes_productos
(
	imagen_id INT NOT NULL AUTO_INCREMENT,
	producto_id INT NOT NULL,
	imagen_name VARCHAR(100),
	imagen_route VARCHAR(100),
	PRIMARY KEY (imagen_id)	
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS productos_conjunto
(
	producto_id INT NOT NULL,
	producto_conjunto_id INT NOT NULL,
	cantidad INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS productos_descuentos
(
	descuento_id INT NOT NULL AUTO_INCREMENT,
	producto_id INT NOT NULL,
	producto_descuento FLOAT,
	PRIMARY KEY (descuento_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS productos_descuentos_publico
(
	descuento_id INT NOT NULL AUTO_INCREMENT,
	producto_id INT NOT NULL,
	producto_descuento FLOAT,
	PRIMARY KEY (descuento_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
