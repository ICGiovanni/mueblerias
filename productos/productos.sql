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


CREATE TABLE IF NOT EXISTS productos
(
	producto_id INT NOT NULL AUTO_INCREMENT,
	producto_name VARCHAR(100) NOT NULL,
	producto_sku VARCHAR(30) NOT NULL,
	producto_description TEXT NOT NULL,
	producto_price_utilitarian FLOAT,
	producto_price_public FLOAT,
	proveedor_id INT,
	PRIMARY KEY (producto_id),
	FOREIGN KEY (proveedor_id) REFERENCES proveedores(proveedor_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS productos_colores
(
	producto_id INT NOT NULL,
	color_id INT NOT NULL,
	FOREIGN KEY (producto_id) REFERENCES productos(producto_id),
	FOREIGN KEY (color_id) REFERENCES colores(color_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS productos_materiales
(
	producto_id INT NOT NULL,
	material_id INT NOT NULL,
	FOREIGN KEY (producto_id) REFERENCES productos(producto_id),
	FOREIGN KEY (material_id) REFERENCES materiales(material_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS productos_categorias
(
	producto_id INT NOT NULL,
	categoria_id INT NOT NULL,
	FOREIGN KEY (producto_id) REFERENCES productos(producto_id),
	FOREIGN KEY (categoria_id) REFERENCES categorias(categoria_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS imagenes_productos
(
	imagen_id INT NOT NULL AUTO_INCREMENT,
	producto_id INT NOT NULL,
	imagen_name VARCHAR(100),
	imagen_route VARCHAR(100),
	PRIMARY KEY (imagen_id),
	FOREIGN KEY (producto_id) REFERENCES productos(producto_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

