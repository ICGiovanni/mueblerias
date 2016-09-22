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
	id_producto INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(100) NOT NULL,
	sku VARCHAR(30) NOT NULL,
	descripcion TEXT NOT NULL,
	precio_utilitario FLOAT,
	precio_publico FLOAT,
	PRIMARY KEY (id_producto)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS productos_colores
(
	id_producto INT NOT NULL,
	color_id INT NOT NULL,
	FOREIGN KEY (id_producto) REFERENCES productos(id_producto),
	FOREIGN KEY (color_id) REFERENCES colores(color_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS productos_materiales
(
	id_producto INT NOT NULL,
	material_id INT NOT NULL,
	FOREIGN KEY (id_producto) REFERENCES productos(id_producto),
	FOREIGN KEY (material_id) REFERENCES materiales(material_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS productos_categorias
(
	id_producto INT NOT NULL,
	categoria_id INT NOT NULL,
	FOREIGN KEY (id_producto) REFERENCES productos(id_producto),
	FOREIGN KEY (categoria_id) REFERENCES categorias(categoria_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS imagenes_productos
(
	id_imagen INT NOT NULL AUTO_INCREMENT,
	id_producto INT NOT NULL,
	name VARCHAR(100),
	ruta VARCHAR(100),
	PRIMARY KEY (id_imagen),
	FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

